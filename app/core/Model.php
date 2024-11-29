<?php
require_once 'config.php';

class Model {
    protected $conn;

    public function __construct() {
        global $servername, $username, $password, $dbname;
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("La conexión falló: " . $this->conn->connect_error);
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);

        if ($params) {
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
        }

        if ($stmt->execute()) {
            return $stmt->get_result();
        } else {
            return false;
        }
    }
}