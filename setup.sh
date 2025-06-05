#!/bin/sh
set -e

# install PHP and Composer if not present
if ! command -v php >/dev/null 2>&1; then
    sudo apt-get update
    sudo apt-get install -y php-cli php-mbstring php-xml composer
fi

composer install
vendor/bin/phpunit --configuration phpunit.xml.dist
