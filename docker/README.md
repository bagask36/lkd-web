# Docker Production

## Persiapan

1. Salin env production:
   ```bash
   cp .env.production.example .env
   ```
2. Edit `.env`: set `APP_KEY`, `DB_PASSWORD`, `APP_URL`.

3. Generate APP_KEY jika belum:
   ```bash
   php artisan key:generate --show
   ```

## Build & Jalankan

```bash
docker compose build --no-cache
docker compose up -d
```

## Migrasi & Cache (setelah container jalan)

```bash
# Migrasi database
docker compose exec app php artisan migrate --force

# Cache config, route, view (opsional)
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache
```

## Queue worker (jika pakai queue)

Jalankan worker di container terpisah atau gunakan supervisor di dalam image.

## Akses

- Aplikasi: http://localhost (atau port di `APP_PORT`)
- MySQL: localhost:3306 (user/password dari `.env`)
