<?php

namespace Cable\Database;

use Cable\Config\Config;
use Cable\Database\Connection\DriverInterface;
use Cable\Database\Exceptions\ConnectionConfigException;
use Cable\Database\Exceptions\DriverException;

/**
 * Class Connection
 * @package Cable\Database
 */
class Connection
{

    /**
     * @var Config
     */
    private $config;


    /**
     * @example 'driver_name' => 'callback'
     *
     * @var  array
     */
    private static $driverList = [
        'pdo' => 'preparePdoDriver',
        'mysqli' => 'prepareMysqliDriver'
    ];

    /**
     * Connection constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $on
     * @return mixed
     * @throws DriverException
     * @throws ConnectionConfigException
     */
    public function connect($on = 'default')
    {
        if (false === ($config = $this->config->get('database.' . $on, false))) {
            throw new ConnectionConfigException(
                sprintf('%s connection config could not found', $on)
            );
        }

        // lets check we have all configurations to connect database
        $this->checkConfiguration($config, $on);

        $driver = !isset($config['driver']) ? 'pdo' : $config['driver'];
        $driverInstance = $this->callDriver($driver);

        return $driverInstance->build($config);
    }

    /**
     * @param array $config
     * @param $connection
     * @throws ConnectionConfigException
     */
    private function checkConfiguration(array &$config, $connection)
    {
        if (!isset($config['username'], $config['password'])) {
            throw new ConnectionConfigException(
                sprintf(
                    '
                We need to username and password configurations for 
                connect your sql database, please check on: %s',
                    $connection
                )
            );
        }

        $config['grammer'] = !isset($config['grammer']) ?
            'mysql' :
            $config['grammer'];
    }

    /**
     * @param string $driverName
     * @return DriverInterface
     * @throws ConnectionConfigException
     * @throws DriverException
     */
    private function callDriver($driverName)
    {
        if (!isset(static::$driverList[$driverName])) {
            throw new ConnectionConfigException(
                sprintf(
                    '%s connection driver could not found',
                    $driverName
                )
            );
        }

        $driver = static::$driverList[$driverName];

        if (is_string($driver)) {
            $driver = $this->$driver();
        } else {
            $driver = $driver();
        }


        if (!$driver instanceof DriverInterface) {
            throw new DriverException(
                sprintf(
                    '%s driver instance is not as expected',
                    $driverName
                )
            );
        }

        return $driver;
    }
}
