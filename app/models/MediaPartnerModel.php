<?php
class MediaPartnerModel extends Model {
    protected string $table = 'media_partner';

    public function getAll(): array {
        return $this->query(
            "SELECT * FROM {$this->table} ORDER BY urutan ASC, created_at ASC"
        )->fetchAll();
    }

    public function create(array $data): bool {
        return $this->query(
            "INSERT INTO {$this->table} (nama, url, logo_url, urutan, created_at)
             VALUES (?, ?, ?, ?, NOW())",
            [$data['nama'], $data['url'], $data['logo_url'], $data['urutan']]
        )->rowCount() > 0;
    }

    public function update(int $id, array $data): bool {
        return $this->query(
            "UPDATE {$this->table} SET nama=?, url=?, logo_url=?, urutan=? WHERE id=?",
            [$data['nama'], $data['url'], $data['logo_url'], $data['urutan'], $id]
        )->rowCount() > 0;
    }
}