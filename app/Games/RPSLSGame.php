<?php

namespace App\Games;

class RPSLSGame
{
    private $options = ['rock', 'paper', 'scissors', 'lizard', 'spock'];

    public function getOptions()
    {
        return $this->options;
    }

    public function getRandomChoice()
    {
        return $this->options[array_rand($this->options)];
    }

    public function compareChoices($userChoice, $computerChoice)
    {
        if (! in_array($userChoice, $this->options)) {
            return ['error' => 'Invalid choice. Please choose from: '.implode(', ', $this->options)];
        }

        if ($userChoice === $computerChoice) {
            return ['result' => 'It\'s a tie!'];
        }

        $rules = [
            'rock' => ['scissors', 'lizard'],
            'paper' => ['rock', 'spock'],
            'scissors' => ['paper', 'lizard'],
            'lizard' => ['spock', 'paper'],
            'spock' => ['scissors', 'rock'],
        ];

        if (in_array($computerChoice, $rules[$userChoice])) {
            return ['result' => 'You win!'];
        } else {
            return ['result' => 'Computer wins!'];
        }
    }

    public function getKillMessage($userChoice, $computerChoice)
    {
        $kills = [
            'rock' => ['scissors' => 'Rock crushes scissors', 'lizard' => 'Rock crushes lizard'],
            'paper' => ['rock' => 'Paper covers rock', 'spock' => 'Paper disproves Spock'],
            'scissors' => ['paper' => 'Scissors cut paper', 'lizard' => 'Scissors decapitate lizard'],
            'lizard' => ['spock' => 'Lizard poisons Spock', 'paper' => 'Lizard eats paper'],
            'spock' => ['scissors' => 'Spock smashes scissors', 'rock' => 'Spock vaporizes rock'],
        ];

        return $kills[$userChoice][$computerChoice] ?? '';
    }
}
