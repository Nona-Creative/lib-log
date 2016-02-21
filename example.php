<?php

use Nona\Log\LogConfig;
use Nona\Log\Logger;

require_once './vendor/autoload.php';

Logger::setGlobalConfig(new LogConfig('test-app', 'udp://localhost:5000', 'localhost'));
$log = Logger::getInstance('test');

$log->info('message', ['hello' => 'world']);