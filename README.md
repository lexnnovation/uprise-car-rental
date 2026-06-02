# Uprise Travel

Professional car & driver hire across Ghana — Accra, Cape Coast, Kumasi, Mole, Tamale, Bolgatanga, Wa, and cross-border to Togo & Benin.

## Tech Stack

- **Laravel 12** — backend framework
- **Blade** — templating
- **Tailwind CSS v4** — styling
- **Alpine.js** — lightweight frontend interactivity
- **Vite** — asset bundling
- **Spatie Media Library** — image handling
- **MySQL** (production) / SQLite (local dev)

## Local Development

```bash
# 1. Clone and install
git clone git@github.com:lexnnovation/uprise-car-rental.git
cd uprise-car-rental
composer install
npm install

# 2. Environment
cp .env.example .env
php artisan key:generate

# 3. Database
php artisan migrate --seed

# 4. Start servers
php artisan serve   # or use Laravel Herd
npm run dev
```

Admin panel: `/bo` — default login `admin@uprise.test` / `password` (change after first login)

## Production Deploy (Hostinger SSH)

```bash
git clone git@github.com:lexnnovation/uprise-car-rental.git public_html
cd public_html
cp .env.production.example .env
nano .env   # set APP_URL, DB_*, MAIL_*
bash deploy.sh
```

See `.env.production.example` for all required environment variables.

## Key URLs

| Route       | Description            |
| ----------- | ---------------------- |
| `/`         | Homepage               |
| `/services` | Services listing       |
| `/fleet`    | Fleet listing          |
| `/about`    | About page             |
| `/contact`  | Contact & booking form |
| `/faq`      | FAQ                    |
| `/bo`       | Admin panel            |

## Structure

```
app/
  Models/         — Service, Vehicle, VehicleCategory, Testimonial, Enquiry
  Http/Controllers/
resources/
  views/pages/    — All frontend Blade templates
  css/app.css     — Tailwind + custom design tokens
  js/app.js       — Alpine.js + animations
public/build/     — Compiled assets (committed for shared hosting)
```
