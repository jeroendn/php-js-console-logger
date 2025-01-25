# PHP JavaScript console logger
A simple way to create JavaScript console logs via a PHP class.

This package has mostly been made as a joke and to get some experience setting up a package. Feel free to find any good use for it.

![Alt Text](https://kappa.jeroendn.nl/WUNi7/BucUneBu09.gif/raw)

## Installation
```shell
composer require jeroendn/php-js-console-logger
```

## How to use
```php
use jeroendn\PhpJsConsoleLogger\PhpJsConsoleLogger;

$logger = new PhpJsConsoleLogger();

/**
 * Setting required parameters
 */
$logger->setLog('Example');
// OR
$logger->setLogs(['Example1', 'Example2', 'Example3']);

/**
 * Setting optional parameters
 */
$logger
  ->setTimeout(5000)
  ->setInterval(500)
  ->setIterations(5)
  ->setIterationSpacer('-')

echo $logger->getHtml(); // Returns the generated JavaScript inside an HTML tag
// OR
echo $logger->getJs(): // Returns the generated JavaScript
```

## Development
### Run tests
```shell
docker exec -it php_php_js_console_logger ./vendor/bin/phpunit
```