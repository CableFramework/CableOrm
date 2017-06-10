<?php

namespace Cable\Database\Connection;

/**
 * Class Executor
 * @package Cable\Database\Connection
 */
abstract class Executor
{

    /**
     * @var \PDO|\mysqli
     */
    protected $instance;

    /**
     * @return \mysqli|\PDO
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param \mysqli|\PDO $instance
     * @return Executor
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;
        return $this;
    }
}
