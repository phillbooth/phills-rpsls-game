<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
 * Possible command lines:
 *
 * php artisan game:rpsls rock
 * php artisan game:rpsls paper
 * php artisan game:rpsls scissors
 * php artisan game:rpsls lizard
 * php artisan game:rpsls spock
 * php artisan game:rpsls typo
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
