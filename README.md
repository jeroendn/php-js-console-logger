# php javascript console logger
A simple way to create javascript console logs via a php function.

This package has mostly been made as a joke and to get some experience setting up a package. Feel free to find any good use for it.

![Alt Text](https://jeroendn.nl/media/ConsoleRickRoll.gif)

## Installation
```bash
composer require jeroendn/php-js-console-logger
```

## How to use
```php
use jeroendn\phpJsConsoleLogger\phpJsConsoleLogger;

$logger = new phpJsConsoleLogger();

$logger = $logger->setLog('Example');
// OR
$logger = $logger->setLogs(['Example1', 'Example2', 'Example3']);

echo $logger->generateJs(); // Print the generated JS in your HTML
```
