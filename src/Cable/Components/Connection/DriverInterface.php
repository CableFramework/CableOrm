<?php

namespace Cable\Database\Connection;

/**
 * Interface DriverInterface
 * @package Cable\Database\Connection
 */
interface DriverInterface
{

    /**
     * @param array $configs
     * @return mixed
     */
    public function build(array $configs);

    /**
     * @return mixed
     */
    public function executor();
}
