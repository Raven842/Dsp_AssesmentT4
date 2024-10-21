<?php
// connect to database; require in all files
class Database {
    public $connection;
    public $config = [
        "host" => "127.0.0.1",
        "dbname" => "Sunset_Resort",
        "port" => "3306",
        "user" => "root",
    ];
    public function __construct() {
        $dsn = 'mysql:dbname=Sunset_Resort;host=127.0.0.1;port=3306;user=root';
        $this->connection = new PDO($dsn);
    }
    public function query($q) {
        $statement = $this->connection->prepare($q);
        $statement->execute();    
        return $statement;    
    }
}

$db = new Database();
