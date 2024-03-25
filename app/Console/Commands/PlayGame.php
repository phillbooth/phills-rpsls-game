<?php

namespace App\Console\Commands;

use App\Games\RPSLSGame;
use Illuminate\Console\Command; // Make sure this matches your actual namespace

class PlayGame extends Command
{
    protected $signature = 'game:rpsls {choice}';

    protected $description = 'Play Rock Paper Scissors Lizard Spock game';

    private $game;

    // Inject the RPSLSGame class
    public function __construct(RPSLSGame $game)
    {
        parent::__construct();
        $this->game = $game;
    }

    public function handle()
    {
        $choice = $this->argument('choice');
        $computerChoice = $this->game->getRandomChoice();
        $result = $this->game->compareChoices($choice, $computerChoice);

        if (isset($result['error'])) {
            $this->error($result['error']);

            return;
        }

        $killMessage = $this->game->getKillMessage($choice, $computerChoice);
        $this->line('----------------------------------------');
        $this->info("Your choice: {$choice}");
        $this->info("Computer's choice: {$computerChoice}");

        if (! empty($killMessage)) {
            $this->line($killMessage);
        }

        $this->line("Result: {$result['result']}");
    }
}
