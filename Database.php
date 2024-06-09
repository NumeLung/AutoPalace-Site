<?php

class Database
{
    public $connection;

    public function __construct() {
        $this->connection = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);
        if (!$this->connection) {
            die('Грешка при свързване с базата данни: ' . mysqli_connect_error());
        }
    }

    public function select($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        if ($params) {
            // Create a type string for bind_param (e.g., "i" for integer, "s" for string)
            $types = str_repeat('s', count($params)); // Assuming all params are strings for simplicity
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $stmt->close();
        return $data;
    }

    public function __destruct() {
        mysqli_close($this->connection);
    }
}
