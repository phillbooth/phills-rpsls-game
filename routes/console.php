<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\PlayGame; // Update the class name here

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
Artisan::command('game:rpsls {choice}', function ($choice) {
    $command = new PlayGame(); // Update the class name here
    $command->setLaravel($this->getApplication());

    $command->handle($choice);
})->describe('Play Rock Paper Scissors Lizard Spock game');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();





