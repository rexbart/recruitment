#!/bin/bash

set -e

composer install
vendor/bin/phpunit
vendor/bin/phpcs --standard=PSR2 src tests
