<?php
// app/models/AdminModel.php

class AdminModel extends Model {

    public function findByUsername(string $username): ?array {
        $stmt = $this->db->prepare(
            'SELECT * FROM admins WHERE username = ? LIMIT 1'
        );
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function updatePassword(int $id, string $hashedPassword): void {
        $stmt = $this->db->prepare(
            'UPDATE admins SET password = ? WHERE id = ?'
        );
        $stmt->execute([$hashedPassword, $id]);
    }

    public function updateUsername(int $id, string $username): bool {
        $stmt = $this->db->prepare(
            'SELECT id FROM admins WHERE username = ? AND id != ? LIMIT 1'
        );
        $stmt->execute([$username, $id]);
        if ($stmt->fetch()) return false;

        $stmt = $this->db->prepare(
            'UPDATE admins SET username = ? WHERE id = ?'
        );
        $stmt->execute([$username, $id]);
        return true;
    }
}