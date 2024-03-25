<?php

namespace Tests\Unit;

use App\Games\RPSLSGame;
use PHPUnit\Framework\TestCase;

class RPSLSGameTest extends TestCase
{
    private $game;

    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new RPSLSGame();
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function testGameOptions()
    {
        $expectedOptions = ['rock', 'paper', 'scissors', 'lizard', 'spock'];
        $this->assertEquals($expectedOptions, $this->game->getOptions());
    }

    public static function choiceProvider()
    {
        return [
            ['rock', 'scissors', 'You win!'],
            ['rock', 'lizard', 'You win!'],
            ['paper', 'rock', 'You win!'],
            ['paper', 'spock', 'You win!'],
            ['scissors', 'paper', 'You win!'],
            ['scissors', 'lizard', 'You win!'],
            ['lizard', 'spock', 'You win!'],
            ['lizard', 'paper', 'You win!'],
            ['spock', 'scissors', 'You win!'],
            ['spock', 'rock', 'You win!'],
            ['rock', 'paper', 'Computer wins!'],
            ['rock', 'spock', 'Computer wins!'],
            ['paper', 'scissors', 'Computer wins!'],
            ['paper', 'lizard', 'Computer wins!'],
            ['scissors', 'rock', 'Computer wins!'],
            ['scissors', 'spock', 'Computer wins!'],
            ['lizard', 'rock', 'Computer wins!'],
            ['lizard', 'scissors', 'Computer wins!'],
            ['spock', 'paper', 'Computer wins!'],
            ['spock', 'lizard', 'Computer wins!'],
            ['rock', 'rock', 'It\'s a tie!'],
            ['paper', 'paper', 'It\'s a tie!'],
            ['scissors', 'scissors', 'It\'s a tie!'],
            ['lizard', 'lizard', 'It\'s a tie!'],
            ['spock', 'spock', 'It\'s a tie!'],
        ];
    }

    /**
     * @dataProvider choiceProvider
     */
    public function testCompareChoices($userChoice, $computerChoice, $expectedResult)
    {
        $result = $this->game->compareChoices($userChoice, $computerChoice);
        $this->assertEquals($expectedResult, $result['result'] ?? null);
    }

    public function testInvalidChoice()
    {
        $userChoice = 'water';
        $computerChoice = 'rock';
        $result = $this->game->compareChoices($userChoice, $computerChoice);
        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Invalid choice. Please choose from: rock, paper, scissors, lizard, spock', $result['error']);
    }
}
