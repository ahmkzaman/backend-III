<?php

namespace Core;

use PDO;
use PDOException;

abstract class Model
{
    protected static PDO $db;

    protected string $table;

    public function __construct()
    {
        if (!isset(self::$db)) {
            $this->connect();
        }
    }

    protected function connect(): void
    {
        $host = 'localhost';
        $dbname = 'your_database';
        $username = 'root';
        $password = '';

        try {
            self::$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    public function all(): array
    {
        $stmt = self::$db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array|false
    {
        $stmt = self::$db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function where(string $column, mixed $value): array
    {
        $stmt = self::$db->prepare("SELECT * FROM {$this->table} WHERE $column = ?");
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
