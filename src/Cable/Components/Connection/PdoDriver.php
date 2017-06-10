<?php

namespace Cable\Database\Connection;


class PdoDriver implements DriverInterface
{

    /**
     * @var \PDO
     */
    private static $pdo;

    /**
     * @param array $configs
     * @return mixed
     */
    public function build(array $configs)
    {

    }

    /**
     * @return mixed
     */
    public function executor()
    {
        // TODO: Implement executor() method.
    }
}
