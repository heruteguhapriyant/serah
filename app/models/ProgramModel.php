<?php
class ProgramModel extends Model {
    protected string $table = 'programs';

    public function getActive(): array {
        return $this->query(
            "SELECT * FROM {$this->table} ORDER BY tanggal DESC"
        )->fetchAll();
    }

    public function create(array $data): bool {
        return $this->query(
            "INSERT INTO {$this->table} (judul, deskripsi, isi, tanggal, foto_url, created_at)
             VALUES (?, ?, ?, ?, ?, NOW())",
            [$data['judul'], $data['deskripsi'], $data['isi'], $data['tanggal'], $data['foto_url']]
        )->rowCount() > 0;
    }

    public function update(int $id, array $data): bool {
        return $this->query(
            "UPDATE {$this->table}
             SET judul=?, deskripsi=?, isi=?, tanggal=?, foto_url=?, updated_at=NOW()
             WHERE id=?",
            [$data['judul'], $data['deskripsi'], $data['isi'], $data['tanggal'], $data['foto_url'], $id]
        )->rowCount() > 0;
    }
}