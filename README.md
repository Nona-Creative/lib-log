# Nona Log for PHP

A simple library for logging. This library helps remove the boilerplate code required to connect to the remote logging infrustructure by suppling a factory for creating Monolog instances based on a global configuration.

## Installation
Install the latest version with: `php composer.phar require nona-creative/log`

## Basic usage

```php
<?php
use Nona\Log\Logger;

$log = Logger::getInstance('demo');
$log->info('Hello world log message');

```

## Advanced usage

```php
<?php
use Nona\Log\LogConfig;
use Nona\Log\Logger;

Logger::setGlobalConfig(new LogConfig('demo-app', 'udp://localhost:5000', 'localhost'));
$log = Logger::getInstance('demo');

$log->info('Hello world log message', ['hello' => 'world']);
```

## The LogConfig Object
Currently the `LogConfig` object is really basic and only requires 3 parameters.

`LogConfig::__construct($applicationName, $host = null, $systemName = null)`

When `$host` is blank, then logs will be output to stdout, which is great for development use. To log to a remote Logstash instance, supply `$host` with a url, eg: `udp://localhost:5000`.

If `$systemName` is left blank, then Monolog will do a lookup to get the local system name.


## More Information
As all this is is a factory to manage Monolog, for any logging related information, refer to [Monolog on GitHub](https://github.com/Seldaek/monolog)