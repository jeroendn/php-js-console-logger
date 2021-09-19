<?php

use jeroendn\phpJsConsoleLogger\phpJsConsoleLogger;

$logger = new phpJsConsoleLogger();

$logger = $logger->setLog('test');
$logger = $logger->setLogs(['test1', 'test2']);

//var_dump($logger->generateJs());
echo $logger->generateJs();
