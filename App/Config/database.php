<?php
namespace App\Config;
use PDO;
class database {
    private static $instance = null;
    private $pdo;
    private function __construct() {
        try {
            $this->pdo = new PDO("pgsql:host=localhost;port=5432;dbname=fruits", "postgres", "etrichi");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            throw new \Exception("Connection failed: " . $e->getMessage());
        }
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->pdo;
    }
}