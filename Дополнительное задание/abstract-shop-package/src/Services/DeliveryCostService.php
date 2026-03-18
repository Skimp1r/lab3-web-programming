<?php

namespace Bystrov\AbstractShop\Services;

use Illuminate\Support\Facades\Http;

class DeliveryCostService
{
    public function __construct(private array $cfg)
    {
    }

    /**
     * @return array{provider:string, distance_km:float, price:float}
     */
    public function estimate(string $from, string $to): array
    {
        $provider = (string) ($this->cfg['provider'] ?? 'osrm');
        $timeout = (int) ($this->cfg['timeout_seconds'] ?? 8);
        $pricePerKm = (float) ($this->cfg['price_per_km'] ?? 25.0);

        if ($provider === 'haversine') {
            // Формат координат: "lat,lon"
            [$lat1, $lon1] = $this->parseLatLon($from);
            [$lat2, $lon2] = $this->parseLatLon($to);
            $km = $this->haversineKm($lat1, $lon1, $lat2, $lon2);
            return ['provider' => 'haversine', 'distance_km' => $km, 'price' => round($km * $pricePerKm, 2)];
        }

        // Геокодинг адресов → координаты (OpenStreetMap Nominatim)
        [$lat1, $lon1] = $this->geocode($from, $timeout);
        [$lat2, $lon2] = $this->geocode($to, $timeout);

        if ($provider === 'openrouteservice') {
            $key = (string) ($this->cfg['openrouteservice_key'] ?? '');
            if (!$key) {
                $km = $this->haversineKm($lat1, $lon1, $lat2, $lon2);
                return ['provider' => 'openrouteservice(fallback)', 'distance_km' => $km, 'price' => round($km * $pricePerKm, 2)];
            }
            $json = Http::timeout($timeout)
                ->withHeaders(['Authorization' => $key, 'Content-Type' => 'application/json'])
                ->post('https://api.openrouteservice.org/v2/directions/driving-car', [
                    'coordinates' => [
                        [(float) $lon1, (float) $lat1],
                        [(float) $lon2, (float) $lat2],
                    ],
                ])->json();
            $meters = (float) ($json['features'][0]['properties']['summary']['distance'] ?? 0);
            $km = $meters > 0 ? $meters / 1000.0 : $this->haversineKm($lat1, $lon1, $lat2, $lon2);
            return ['provider' => 'openrouteservice', 'distance_km' => $km, 'price' => round($km * $pricePerKm, 2)];
        }

        // OSRM public demo server (без ключа)
        $url = sprintf(
            'https://router.project-osrm.org/route/v1/driving/%F,%F;%F,%F?overview=false',
            $lon1,
            $lat1,
            $lon2,
            $lat2
        );
        $json = Http::timeout($timeout)->get($url)->json();
        $meters = (float) ($json['routes'][0]['distance'] ?? 0);
        $km = $meters > 0 ? $meters / 1000.0 : $this->haversineKm($lat1, $lon1, $lat2, $lon2);
        return ['provider' => 'osrm', 'distance_km' => $km, 'price' => round($km * $pricePerKm, 2)];
    }

    private function geocode(string $q, int $timeout): array
    {
        $res = Http::timeout($timeout)
            ->withHeaders(['User-Agent' => 'abstract-shop-package/1.0'])
            ->get('https://nominatim.openstreetmap.org/search', [
                'format' => 'json',
                'limit' => 1,
                'q' => $q,
            ])->json();
        $lat = (float) ($res[0]['lat'] ?? 0);
        $lon = (float) ($res[0]['lon'] ?? 0);
        if ($lat === 0.0 && $lon === 0.0) {
            // Если не нашли, допустим, что пользователь ввёл "lat,lon"
            return $this->parseLatLon($q);
        }
        return [$lat, $lon];
    }

    private function parseLatLon(string $s): array
    {
        $parts = array_map('trim', explode(',', $s));
        if (count($parts) !== 2) return [0.0, 0.0];
        return [(float) str_replace(',', '.', $parts[0]), (float) str_replace(',', '.', $parts[1])];
    }

    private function haversineKm(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $r = 6371.0;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $r * $c;
    }
}

