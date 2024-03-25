<?php

namespace App\Contracts;

interface GameInterface
{
    public function getOptions();

    public function compareChoices($userChoice, $computerChoice);

    public function getKillMessage($userChoice, $computerChoice);
}
