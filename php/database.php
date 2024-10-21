<?php
// connect to database; require in all files
class Database {
    public $connection;
    
    public function __construct() {
        $config = [
            "host" => "127.0.0.1",
            "dbname" => "Sunset_Resort",
            "port" => "3306",
            "user" => "root",
        ];
        $dsn = 'mysql:' . http_build_query( $config, '', ';');
        $this->connection = new PDO($dsn);
    }
    public function query($q) {
        $statement = $this->connection->prepare($q);
        $statement->execute();    
        return $statement;    
    }
}
