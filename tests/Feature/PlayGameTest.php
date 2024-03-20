<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayGameTest extends TestCase
{
    /**
     * Test the PlayGame command with all possible choices.
     *
     * @return void
     */
    public function testPlayGameCommand()
    {
        // Define all possible choices
        $choices = ['rock', 'paper', 'scissors', 'lizard', 'spock'];

        // Loop through each choice and run the command
        foreach ($choices as $choice) {
            $output = $this->artisan("game:rpsls $choice");

            // Assert that the command ran successfully
            $output->assertExitCode(0);
        }
    }
}
