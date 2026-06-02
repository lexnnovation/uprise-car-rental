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

echo "==> Linking storage..."
# Use manual symlink — exec() is disabled on some shared hosts
if [ ! -L "public/storage" ]; then
    ln -s "$(pwd)/storage/app/public" "$(pwd)/public/storage"
    echo "    Storage symlink created."
else
    echo "    Storage symlink already exists."
fi

echo "==> Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "==> Done! Site is live."
