# Railway Deployment Guide

This app deploys to Railway using the existing `Dockerfile` plus `railway.toml` and `start-railway.sh`.

## 1. Push the repo

The code is already pushed to `https://github.com/daphnejane015-alt/tvet2`.

## 2. Create the Railway project

1. Go to https://railway.app and sign in with GitHub.
2. Click **New Project → Deploy from GitHub repo**.
3. Select `daphnejane015-alt/tvet2`.
4. Railway detects the `Dockerfile` automatically (see `railway.toml`).

## 3. Add a PostgreSQL database

1. In the same project, click **+ New → Database → PostgreSQL**.
2. Open the Postgres service → **Variables** tab.
3. In your web service → **Variables**, add a reference variable:
   - `DATABASE_URL` = `${{Postgres.DATABASE_URL}}`

   `start-railway.sh` parses `DATABASE_URL` into `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` automatically. Alternatively, you can set the `DB_*` variables manually.

## 4. Set environment variables

In the web service → **Variables**, set:

| Variable | Value |
|---|---|
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_NAME` | `AceTVET` |
| `APP_URL` | `https://<your-railway-domain>` (set after first deploy, or use the generated `*.up.railway.app` domain) |
| `LOG_CHANNEL` | `stderr` |
| `LOG_LEVEL` | `error` |
| `SESSION_DRIVER` | `file` |
| `CACHE_DRIVER` | `file` |
| `QUEUE_CONNECTION` | `sync` |
| `MAIL_MAILER` | `smtp` |
| `MAIL_HOST` | `smtp.gmail.com` |
| `MAIL_PORT` | `587` |
| `MAIL_USERNAME` | your Gmail |
| `MAIL_PASSWORD` | Gmail app password |
| `MAIL_ENCRYPTION` | `tls` |
| `MAIL_FROM_ADDRESS` | your Gmail |
| `MAIL_FROM_NAME` | `AceTVET` |

`APP_KEY` is generated automatically on first boot if not set — but it is better to generate one (`php artisan key:generate --show`) and set it as a variable so sessions survive redeploys.

## 5. Deploy

Railway builds the Docker image and runs `start-railway.sh`, which:

- writes `.env` from environment variables
- runs `php artisan migrate --force` and `db:seed`
- caches config/routes
- serves on `$PORT` (Railway injects this automatically)

First build takes several minutes (composer + npm build inside Docker).

## 6. Custom domain (optional)

Service → **Settings → Networking → Custom Domain** to attach your own domain.

## Troubleshooting

- **Deploy fails at healthcheck**: check logs; migrations may fail if `DATABASE_URL` isn't referenced correctly.
- **500 errors**: make sure `APP_KEY` is set and `APP_DEBUG=false` in production.
- **Images/storage**: files uploaded to `storage/app/public` are ephemeral on Railway's container filesystem. For persistent uploads, add an S3-compatible bucket (e.g. Cloudflare R2) or Railway Volume later.
