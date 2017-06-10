<?php

namespace Cable\Database\Connection;

/**
 * Interface ExecutorInterface
 * @package Cable\Database\Connection
 */
interface ExecutorInterface
{

    /**
     * @param string $query
     * @return ExecutorInterface
     */
    public function prepare($query);

    /**
     * @param string $query
     * @return mixed
     */
    public function query($query);

    /**
     * @param mixed $prepare
     * @param array $args
     * @return mixed
     */
    public function execute($prepare,array $args = []);
}
