<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * PlayGame Command
 *
 * This command allows users to play the Rock Paper Scissors Lizard Spock game against the computer.
 */
class PlayGame extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'game:rpsls {choice}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Play Rock Paper Scissors Lizard Spock game';

    /**
     * The available options for the game.
     *
     * @var array
     */
    protected $options = ['rock', 'paper', 'scissors', 'lizard', 'spock'];

    /**
     * Write a string to the output.
     *
     * @param string $string The string to write
     * @param string|null $style The style of the string
     * @param int|null $verbosity The verbosity level
     * @return void
     */
    protected function writeln($string, $style = null, $verbosity = null)
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $styled = $style ? "<$style>$string</$style>" : $string;
        $output->writeln($styled, $this->parseVerbosity($verbosity));
    }

    /**
     * Handle the command execution.
     *
     * @param string $choice The user's choice
     * @return void
     */
    public function handle($choice)
    {
        $computerChoice = $this->options[rand(0, count($this->options) - 1)];
    
        $result = $this->compareChoices($choice, $computerChoice);
        if($result){
            // Determine the correct kill message
            $killMessage = $this->getKillMessage($choice, $computerChoice);
            $this->writeln("----------------------------------------");
            // Output the choices and result with different colors
            $this->writeln("Your choice: {$choice}", 'fg=yellow');
            $this->writeln("Computer's choice: {$computerChoice}", 'fg=blue');
            
            if (!empty($killMessage)) {
                $this->writeln($killMessage, null);
            }
        
            // Determine the color for the result based on the outcome
            $color = $result === 'You win!' ? 'fg=green' : ($result === 'It\'s a tie!' ? 'fg=magenta' : 'fg=red');
            $this->writeln("Result: {$result}", $color);
        }
    }
    
    /**
     * Compare the user's choice and the computer's choice to determine the result.
     *
     * @param string $userChoice The user's choice
     * @param string $computerChoice The computer's choice
     * @return string The result of the game
     */
    private function compareChoices($userChoice, $computerChoice)
    {
        // Define the rules of the game
        $rules = [
            'rock' => ['scissors', 'lizard'],
            'paper' => ['rock', 'spock'],
            'scissors' => ['paper', 'lizard'],
            'lizard' => ['spock', 'paper'],
            'spock' => ['scissors', 'rock'],
        ];

        if (!in_array($userChoice, array_keys($rules))) {

            $output = new \Symfony\Component\Console\Output\ConsoleOutput();
            
            $this->writeln("----------------------------------------");
            $output->writeln("I do not understand are you trying to cheat?");
            $output->writeln("");
            $output->writeln('Invalid choice. Please choose from: ' . implode(', ', $this->options));
            $output->writeln("");
            $output->writeln('Please use one of the following...');
            $output->writeln("");

            foreach ($this->options as $option) {
                $output->writeln("php artisan game:rpsls $option");
            }
       
            return null;
        }

            // Determine the result based on the rules
            if ($userChoice === $computerChoice) {
                return 'It\'s a tie!';
            } elseif (in_array($computerChoice, $rules[$userChoice])) {
                return 'You win!';
            } else {
                return 'Computer wins!';
            }
        
    }

    /**
     * Get the kill message based on the user's and computer's choices.
     *
     * @param string $userChoice The user's choice
     * @param string $computerChoice The computer's choice
     * @return string The kill message
     */
    private function getKillMessage($userChoice, $computerChoice)
    {
        // Define the kills
        $kills = [
            'rock' => [
                'scissors' => 'Rock crushes scissors',
                'lizard' => 'Rock crushes lizard',
            ],
            'paper' => [
                'rock' => 'Paper covers rock',
                'spock' => 'Paper disproves Spock',
            ],
            'scissors' => [
                'paper' => 'Scissors cut paper',
                'lizard' => 'Scissors decapitate lizard',
            ],
            'lizard' => [
                'spock' => 'Lizard poisons Spock',
                'paper' => 'Lizard eats paper',
            ],
            'spock' => [
                'scissors' => 'Spock smashes scissors',
                'rock' => 'Spock vaporizes rock',
            ],
        ];
    
        // Determine the kill message
        return $kills[$userChoice][$computerChoice] ?? '';
    }
    
}
