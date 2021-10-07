<?php
require_once 'vendor/autoload.php';

use jeroendn\PhpJsConsoleLogger\PhpJsConsoleLogger;

$examples = ['Example1', 'Example2', 'Example3'];
$rickRoll = [
    'We\'re no strangers to love',
    'You know the rules and so do I',
    'A full commitment\'s what I\'m thinking of',
    'You wouldn\'t get this from any other guy',
    'I just wanna tell you how I\'m feeling',
    'Gotta make you understand',
    'Never gonna give you up',
    'Never gonna let you down',
    'Never gonna run around and desert you',
    'Never gonna make you cry',
    'Never gonna say goodbye',
    'Never gonna tell a lie and hurt you',
    'We\'ve known each other for so long',
    'Your heart\'s been aching but you\'re too shy to say it',
    'Inside we both know what\'s been going on',
    'We know the game and we\'re gonna play it',
    'And if you ask me how I\'m feeling',
    'Don\'t tell me you\'re too blind to see',
    'Never gonna give you up',
    'Never gonna let you down',
    'Never gonna run around and desert you',
    'Never gonna make you cry',
    'Never gonna say goodbye',
    'Never gonna tell a lie and hurt you',
    'Never gonna give you up',
    'Never gonna let you down',
    'Never gonna run around and desert you',
    'Never gonna make you cry',
    'Never gonna say goodbye',
    'Never gonna tell a lie and hurt you',
    'Never gonna give, never gonna give',
    '(Give you up)',
    'We\'ve known each other for so long',
    'Your heart\'s been aching but you\'re too shy to say it',
    'Inside we both know what\'s been going on',
    'We know the game and we\'re gonna play it',
    'I just wanna tell you how I\'m feeling',
    'Gotta make you understand',
    'Never gonna give you up',
    'Never gonna let you down',
    'Never gonna run around and desert you',
    'Never gonna make you cry',
    'Never gonna say goodbye',
    'Never gonna tell a lie and hurt you',
    'Never gonna give you up',
    'Never gonna let you down',
    'Never gonna run around and desert you',
    'Never gonna make you cry',
    'Never gonna say goodbye',
    'Never gonna tell a lie and hurt you',
    'Never gonna give you up',
    'Never gonna let you down',
    'Never gonna run around and desert you',
    'Never gonna make you cry',
    'Never gonna say goodbye'
];

$logger = new PhpJsConsoleLogger();

$logger->setLog('Example');
$logger
    ->setLogs($examples)
    ->setTimeout()
    ->setInterval()
    ->setMaxIterations(10)
    ->setIterationSpacer('-');

echo $logger->generateJs();

/**
 * Display the variables set
 */
$properties = [
    'Log' => $logger->getLog(),
    'Logs' => $logger->getLogs(),
    'Interval' => $logger->getInterval(),
    'MaxIterations' => $logger->getMaxIterations(),
    'iterationSpacer' => $logger->getiterationSpacer()
];

foreach ($properties as $propertyName => $value) {
    echo '<strong>' . $propertyName . ':</strong> ';
    (is_array($value)) ? print_r($value) : print $value;
    echo '<br>';
}
