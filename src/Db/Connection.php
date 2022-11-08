<?php

namespace Robert\Db;

class Connection
{
    protected static $instance;

    private static $dsn = 'mysql:host=learn_mysql;dbname=learning;charset=utf8mb4';

    private static $username = 'learning';

    private static $password = 'learning';

    private function __construct()
    {
        try {
            self::$instance = new \PDO(self::$dsn, self::$username, self::$password);
        } catch (\PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            new Connection();
        }

        return self::$instance;
    }




}
