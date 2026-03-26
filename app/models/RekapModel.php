<?php
// app/models/RekapModel.php

class RekapModel extends Model {
    protected string $table = 'rekap_kegiatan';

    public function getAll(): array {
        return $this->query(
            "SELECT * FROM {$this->table} ORDER BY tanggal DESC"
        )->fetchAll();
    }

    public function create(array $data): bool {
        return $this->query(
            "INSERT INTO {$this->table} (judul, deskripsi, tanggal, foto_url, pdf_url, created_at)
             VALUES (?, ?, ?, ?, ?, NOW())",
            [$data['judul'], $data['deskripsi'], $data['tanggal'], $data['foto_url'], $data['pdf_url']]
        )->rowCount() > 0;
    }

    public function update(int $id, array $data): bool {
        return $this->query(
            "UPDATE {$this->table} SET judul=?, deskripsi=?, tanggal=?, foto_url=?, pdf_url=?, updated_at=NOW()
             WHERE id=?",
            [$data['judul'], $data['deskripsi'], $data['tanggal'], $data['foto_url'], $data['pdf_url'], $id]
        )->rowCount() > 0;
    }
}
