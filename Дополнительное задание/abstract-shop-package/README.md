## Лабораторная работа №3 — пакет под Composer (Laravel 9)

Пакет: `bystrov/abstract-shop`

Содержит:
- модели/миграции/фабрики/сидеры для абстрактного интернет‑магазина
- CRUD‑контроллеры + web‑маршруты (подключаются напрямую из пакета)
- Blade‑шаблоны для CRUD (публикуются в приложение)
- фасад `CurrencyRate` — получение курса валют
- фасад `DeliveryCost` — расчёт доставки A→B (2 geo‑провайдера + 1 мат. метод)

### Установка в Laravel‑проект (локально через path)

В `composer.json` приложения:

```json
{
  "repositories": [
    { "type": "path", "url": "../abstract-shop-package", "options": { "symlink": true } }
  ],
  "require": {
    "bystrov/abstract-shop": "*"
  }
}
```

Команды:

```bash
composer update
php artisan vendor:publish --tag=abstract-shop-config
php artisan vendor:publish --tag=abstract-shop-views
php artisan migrate
php artisan db:seed --class="Bystrov\\AbstractShop\\Database\\Seeders\\AbstractShopSeeder"
```

Маршруты доступны по префиксу из конфига `config/abstract-shop.php` (`route_prefix`).

