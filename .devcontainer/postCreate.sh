#!/usr/bin/env bash

# Install dependencies using Composer in case they are missing
if [ ! -f composer.lock ]; then
    composer install
fi

# Install ChromeDriver matching the installed Chrome version
vendor/bin/testbench dusk:chrome-driver --detect