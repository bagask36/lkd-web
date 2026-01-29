# Docker Production

## Persiapan

1. Salin env production:
   ```bash
   cp .env.production.example .env
   ```
2. Edit `.env`: set `APP_KEY`, `DB_PASSWORD`, `APP_URL`, dan **APP_PORT**.
   - Wajib set port yang belum dipakai, mis. `APP_PORT=8081` (80/81=NPM, 8080=portofolio)

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

- Aplikasi: http://localhost:8081 (atau port di `APP_PORT`)
- MySQL: localhost:3307 (user/password dari `.env`)

## Troubleshooting

**"Bind for 0.0.0.0:80 failed: port is already allocated"**
- Di server, edit `.env`: pastikan ada `APP_PORT=8081` (bukan 80). Port 8080 mungkin sudah dipakai portofolio.
- Lalu: `docker compose down` → `docker compose up -d`.
