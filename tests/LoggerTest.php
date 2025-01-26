<?php

use jeroendn\PhpJsConsoleLogger\PhpJsConsoleLogger;
use PHPUnit\Framework\TestCase;

/**
 * Run tests by executing in "./vendor/bin/phpunit" in the root directory
 */
class LoggerTest extends TestCase
{
    private PhpJsConsoleLogger $logger;

    public function setUp(): void
    {
        $this->logger = new PhpJsConsoleLogger;
    }

    public function testPropertyLog(): void
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

    public function testPropertyLogs(): void
    {
        $this->testGetSetByProperty('Logs', [
                ['Example1', 'Example2', 'Example3'],
                ['Example1', '0', 0, 1234]
            ]
        );
    }

    public function testPropertyTimeOut(): void
    {
        $this->testGetSetByProperty('TimeOut', [
                0,
                100
            ]
        );
    }

    public function testPropertyInterval(): void
    {
        $this->testGetSetByProperty('Interval', [
                0,
                100
            ]
        );
    }

    public function testPropertyIterations(): void
    {
        $this->testGetSetByProperty('Iterations', [
                -1,
                0,
                10
            ]
        );
    }

    public function testPropertyIterationSpacer(): void
    {
        $this->testGetSetByProperty('IterationSpacer', [
                'Spacer',
                '-',
                ''
            ]
        );
    }

    private function testGetSetByProperty(string $propertyName, array $testData): void
    {
        $getPropertyName = 'get' . ucfirst($propertyName);
        $setPropertyName = 'set' . ucfirst($propertyName);

        foreach ($testData as $value) {
            $this->logger->$setPropertyName($value);
            $this->assertEquals($value, $this->logger->$getPropertyName());
        }
    }
}
