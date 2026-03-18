<?php

namespace Bystrov\AbstractShop\Services;

use Illuminate\Support\Facades\Http;

class CurrencyRateService
{
    public function __construct(private array $cfg)
    {
    }

    public function rate(string $to, ?string $from = null): float
    {
        $from = $from ?: (string) ($this->cfg['base'] ?? 'RUB');
        $to = strtoupper($to);
        $from = strtoupper($from);

        if ($from === $to) return 1.0;

        $provider = (string) ($this->cfg['provider'] ?? 'exchangerate_host');
        if ($provider === 'mock') return 1.0;

        $timeout = (int) ($this->cfg['timeout_seconds'] ?? 5);

        if ($provider === 'cbr') {
            // Упрощённо: CBR отдаёт курсы к RUB. Для лабораторной достаточно.
            $xml = Http::timeout($timeout)->get('https://www.cbr.ru/scripts/XML_daily.asp')->body();
            if (!$xml) return 1.0;
            $rateToRub = $this->cbrRateToRub($xml, $to);
            $rateFromRub = $this->cbrRateToRub($xml, $from);
            if ($rateToRub <= 0 || $rateFromRub <= 0) return 1.0;
            // from->to = (from->RUB) / (to->RUB)
            return $rateFromRub / $rateToRub;
        }

        // exchangerate.host — free, без ключа
        $res = Http::timeout($timeout)->get('https://api.exchangerate.host/latest', [
            'base' => $from,
            'symbols' => $to,
        ])->json();
        $v = $res['rates'][$to] ?? null;
        return is_numeric($v) ? (float) $v : 1.0;
    }

    public function rates(array $to, ?string $from = null): array
    {
        $out = [];
        foreach ($to as $code) {
            $out[$code] = $this->rate((string) $code, $from);
        }
        return $out;
    }

    private function cbrRateToRub(string $xml, string $code): float
    {
        $code = strtoupper($code);
        if ($code === 'RUB') return 1.0;
        $dom = new \DOMDocument();
        @$dom->loadXML($xml);
        foreach ($dom->getElementsByTagName('Valute') as $valute) {
            $charCode = $valute->getElementsByTagName('CharCode')->item(0)?->nodeValue;
            if (strtoupper((string) $charCode) !== $code) continue;
            $nominal = (int) ($valute->getElementsByTagName('Nominal')->item(0)?->nodeValue ?? 1);
            $value = (string) ($valute->getElementsByTagName('Value')->item(0)?->nodeValue ?? '0');
            $value = (float) str_replace(',', '.', $value);
            if ($nominal <= 0) $nominal = 1;
            return $value / $nominal;
        }
        return 0.0;
    }
}

