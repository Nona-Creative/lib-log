<?php

namespace Nona\Log;

use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LogstashFormatter;
use Monolog\Logger as MonologLogger;

/**
 * Logger factory for Monolog.
 *
 * @package Nona\Log
 */
class Logger {
    /** @var MonologLogger[] */
    private static $_instances = [];
    /** @var LogConfig */
    private static $_config;

    /**
     * Private __construct to prevent instantiation.
     */
    private function __construct()
    {
    }

    /**
     * Private __clone to prevent instantiation.
     */
    private function __clone()
    {
    }

    /**
     * Monolog logger registry. Get an instance of Monolog.
     *
     * @param string $name
     * @return MonologLogger
     */
    public static function getInstance($name = 'default') {

        if(!in_array($name, self::$_instances)) {
            self::$_instances[$name] = self::newLogger($name);
        }

        return self::$_instances[$name];
    }

    /**
     * Factory method to create a new monolog instance.
     *
     * @param $name
     * @return MonologLogger
     */
    private static function newLogger($name) {
        $config = self::getConfig();
        $log = new MonologLogger($name);

        if ($config->getHost() !== null) {
            $formatter = new LogstashFormatter(
                $config->getApplicationName(),
                $config->getSystemName(),
                null,
                '',
                LogstashFormatter::V1
            );

            $udpStream = stream_socket_client($config->getHost());
            $udpStreamHandler = new StreamHandler($udpStream);
            $udpStreamHandler->setFormatter($formatter);
            $log->pushHandler($udpStreamHandler);
        }

        return $log;
    }

    /**
     * Get the LogConfig, or return a default one if one was not set.
     *
     * @return LogConfig
     */
    private static function getConfig() {
        if (self::$_config === null) {
            return new LogConfig('default');
        } else {
            return self::$_config;
        }
    }

    /**
     * Set a default global config.
     *
     * @param LogConfig $config
     */
    public static function setGlobalConfig(LogConfig $config) {
        self::$_config = $config;
    }
}