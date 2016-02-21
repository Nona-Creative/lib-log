<?php

namespace Nona\Log;

/**
 * Log config for easy configuration of centralized logging.
 */
class LogConfig {
    private $_applicationName;
    private $_systemName;
    private $_host;

    /**
     * Create a new log config instance. If host is null, it will output the logs locally instead of sending it to
     * the supplied host. Leaving $systemName null can result in increased latency due to needing to do a reverse DNS
     * lookup when instantiating the logger.
     *
     * @param $applicationName
     * @param $host
     * @param $systemName
     */
    public function __construct($applicationName, $host = null, $systemName = null)
    {
        $this->_applicationName = $applicationName;
        $this->_host = $host;
        $this->_systemName = $systemName;
    }

    /**
     * Application name.
     *
     * @return string
     */
    public function getApplicationName()
    {
        return $this->_applicationName;
    }

    /**
     * Get the system name.
     *
     * @return string
     */
    public function getSystemName()
    {
        return $this->_systemName;
    }

    /**
     * Get the remote host to log to.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }


}