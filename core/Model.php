<?php
// core/Model.php

class Model {
    protected PDO $db;
    protected string $table = '';

    public function __construct() {
        $this->db = Database::getInstance();
    }

    protected function query(string $sql, array $params = []): PDOStatement {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function all(string $order = 'created_at DESC'): array {
        return $this->query("SELECT * FROM {$this->table} ORDER BY $order")->fetchAll();
    }

    public function find(int $id): array|false {
        return $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }

    public function delete(int $id): bool {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id])->rowCount() > 0;
    }

    public function lastInsertId(): string {
        return $this->db->lastInsertId();
    }
}
