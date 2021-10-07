<?php

use jeroendn\PhpJsConsoleLogger\PhpJsConsoleLogger;
use PHPUnit\Framework\TestCase;

/**
 * Run tests by executing in root: ./vendor/bin/phpunit
 */
class LoggerTest extends TestCase
{
  private PhpJsConsoleLogger $logger;

  public function setUp(): void
  {
    $this->logger = new PhpJsConsoleLogger;
  }

  public function testPropertyLog()
  {
    $this->testGetSetByProperty('Log', [
        'Example',
        '0',
        0,
        1234,
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
      ]
    );
  }

  public function testPropertyLogs()
  {
    $this->testGetSetByProperty('Logs', [
        ['Example1', 'Example2', 'Example3'],
        ['Example1', '0', 0, 1234]
      ]
    );
  }

  private function testGetSetByProperty(string $propertyName, array $testData)
  {
    $getPropertyName = 'get' . ucfirst($propertyName);
    $setPropertyName = 'set' . ucfirst($propertyName);

    foreach ($testData as $value) {
      $this->logger->$setPropertyName($value);
      $this->assertEquals($value, $this->logger->$getPropertyName());
    }
  }
}