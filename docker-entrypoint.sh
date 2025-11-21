#!/bin/bash

# Exit immediately if a command exits with a non-zero status
set -e

# Run Laravel migrations
php artisan migrate --force

# Start the PHP built-in server
php -S 0.0.0.0:8000 -t public
