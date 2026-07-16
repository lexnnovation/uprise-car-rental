#!/usr/bin/env bash
# =============================================================
# Uprise Travel — Hostinger SSH Deploy Script
# Run this ON THE SERVER after git clone/pull
# Usage: bash deploy.sh
# =============================================================

set -e

echo "==> Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "==> Generating app key (skip if already set in .env)..."
php artisan key:generate --force

echo "==> Running database migrations + seed..."
php artisan migrate --seed --force

echo "==> Caching config / routes / views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Removing storage symlink if present..."
# Public media is served via /media/{path} through MediaController, not the
# public/storage symlink — some hosts' .htaccess rewrite rules skip Laravel
# entirely for paths that resolve to a real file via the symlink, and the
# path itself can also get blocked at the edge/CDN level. Remove any stale
# symlink so nothing shortcuts around the app.
if [ -L "public/storage" ]; then
    rm "public/storage"
    echo "    Removed."
fi

echo "==> Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "==> Done! Site is live."
