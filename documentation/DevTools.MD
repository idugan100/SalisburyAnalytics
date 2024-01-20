## Running Linter (Pint)
`./vendor/bin/pint`  
The current standard for a pr to be merged is that the code passes all linting checks

## Running Static Anaysis (PHPStan)
`./vendor/bin/phpstan --memory-limit=2G`  
The current standard for a pr to be merged is zero errors on level 6

## Running Test Suite (PHPUnit)
`php artisan test`  
The current standard for a pr to be merged is all tests passing

## Create Usage Log (Artisan)
`php artisan create-usage-log`  
On production this is run daily via cron, but will need to be run manually on a local enviroment