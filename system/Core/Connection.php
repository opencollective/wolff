<?php

namespace Core;

class Connection {

    protected static $instance;
    protected static $connection;
    

    /**
     * Connects with the database using the constants present in config.php
     */
    public function __construct(string $type) {
        $type = strtolower($type);

        try {
            self::$connection = new \PDO($type . ":host=" . SERVER . "; dbname=" . DB . "", USER, PASSWORD);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * Get a static instance
     * @param string $type the dbms
     * @return Connection the instance
     */
    public static function getInstance(string $type = 'mysql') {
        if (self::$instance == null) {
            self::$instance = new Connection($type);
        }

        return self::$instance;
    }


    /**
     * Proxy to native PDO methods
     * @param mixed $method the method name
     * @param mixed $args the method arguments
     * @return mixed the function result
     */
    public function __call($method, $args) {
        return call_user_func_array(array(self::$connection, $method), $args);
    }
    

    /**
     * Run a query
     * @param string $sql the query
     * @param mixed $args the arguments
     * @return array the query result
     */
    public function run(string $sql, $args = []) {
        if (!$args) {
            return self::$connection->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        $stmt = self::$connection->prepare($sql);
        $stmt->execute($args);

        return $stmt->fetch();
    }
    

    /**
     * Export a query to a csv
     * @param string $filename the filename
     * @param string $sql the query
     * @param mixed $args the arguments
     */
    public function toCsv(string $filename, string $sql, $args = []) {
        arrayToCsv(self::run($sql, $args), $filename);
    }

}