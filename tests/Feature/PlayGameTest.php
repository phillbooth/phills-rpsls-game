<?php

namespace Tests\Feature;

use App\Games\RPSLSGame;
use Mockery;
use Tests\TestCase;

class PlayGameTest extends TestCase
{
    /**
     * Test the play game command.
     *
     * @return void
     */
    public function testPlayGameCommand()
    {
        $mock = Mockery::mock(RPSLSGame::class);
        $mock->shouldReceive('getRandomChoice')->andReturn('rock');
        $mock->shouldReceive('compareChoices')->andReturn(['result' => 'Computer wins!']);
        $mock->shouldReceive('getKillMessage')->andReturn('');

        $this->app->instance(RPSLSGame::class, $mock);

        $choices = ['rock', 'paper', 'scissors', 'lizard', 'spock'];

        foreach ($choices as $choice) {
            $this->artisan("game:rpsls $choice")
                ->assertExitCode(0)
                ->expectsOutput("Your choice: $choice")
                ->expectsOutput("Computer's choice: rock")
                ->run();
        }
    }
}
