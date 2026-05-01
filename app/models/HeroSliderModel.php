<?php
class HeroSliderModel extends Model {
    protected string $table = 'hero_slider';

    public function getAll(): array {
        return $this->query(
            "SELECT * FROM {$this->table} ORDER BY urutan ASC, created_at ASC"
        )->fetchAll();
    }

    public function create(array $data): bool {
        return $this->query(
            "INSERT INTO {$this->table} (foto_url, urutan, created_at) VALUES (?, ?, NOW())",
            [$data['foto_url'], $data['urutan']]
        )->rowCount() > 0;
    }

    public function update(int $id, array $data): bool {
        return $this->query(
            "UPDATE {$this->table} SET foto_url=?, urutan=? WHERE id=?",
            [$data['foto_url'], $data['urutan'], $id]
        )->rowCount() > 0;
    }
}