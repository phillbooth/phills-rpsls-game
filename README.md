##UPDATE


### New Command


```bash
php artisan test
```

```bash
php artisan test --testsuite=Feature
```

```bash
php artisan test --testsuite=Unit
```

### New Files Added:

1. **app\Games\RPSLSGame.php:** This file contains the `RPSLSGame` class, which encapsulates the game logic for Rock Paper Scissors Lizard Spock.
   
2. **app\Contracts\GameInterface.php:** This file defines the `GameInterface` interface, providing a contract for game logic classes to implement.

3. **tests\Unit\RPSLSGameTest.php:** This file contains unit tests for the `RPSLSGame` class to ensure its functionality.

4. **tests\Feature\PlayGameTest.php:** This file contains functional tests for the PlayGame command, ensuring its integration with the game logic and accurate command line interactions.

5. **.env.testing:** This file contains environment variables specific to testing.

### Changes:

1. **app\Console\Commands\PlayGame.php:**
   - In the `handle` method, the game logic was previously embedded. Now, it interacts with the `RPSLSGame` class to handle game-related operations.

2. **app\Providers\AppServiceProvider.php:**
   - In the `register` method, there might be changes related to dependency injection bindings, especially if `RPSLSGame` or `GameInterface` are bound to the service container.

3. **config\app.php:**
   - The `providers` array might have been updated to include the service provider for the `AppServiceProvider`, reflecting the changes made in the `register` method.


### Added Laravel Pint

Added as an alternative to "PHP Coding Standards Fixer"



```bash
.\vendor\bin\pint 
```

```bash
.\vendor\bin\pint --preset laravel
```

```bash
.\vendor\bin\pint --preset psr12
```

------------------------------------------------------------------------------------

### Details:

### Command Lines:


```bash
php artisan game:rpsls rock
```

```bash
php artisan game:rpsls paper
```

```bash
php artisan game:rpsls scissors
```

```bash
php artisan game:rpsls lizard
```

```bash
php artisan game:rpsls spock
```

```bash
php artisan game:rpsls typo
```


### Test Command Line:
To run tests for the game, execute the following command:

php artisan test

### Added Files:

app\Console\Commands\PlayGame.php: This file contains the implementation of the Rock Paper Scissors Lizard Spock game logic, including handling user input and determining game outcomes.

### Test File Update:

tests\Feature\PlayGameTest.php: This file was updated to provide test cases for the command line functionality, ensuring that the game operates as expected.

### Configuration Update:

The routes file routes\console.php was updated to register the command line options and link them to the appropriate class methods for execution.