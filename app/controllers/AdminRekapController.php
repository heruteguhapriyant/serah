<?php
// app/controllers/AdminRekapController.php

class AdminRekapController extends Controller {
    private RekapModel $model;

    // Folder penyimpanan relatif dari root public
    private const UPLOAD_DIR = __DIR__ . '/../../public/uploads/';
    private const MAX_SIZE   = 2 * 1024 * 1024; // 2MB
    private const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

    public function __construct() {
        $this->model = new RekapModel();
    }

    public function index(): void {
        $this->requireAdmin();
        $rekaps = $this->model->getAll();
        $this->view('admin/rekap/index', ['rekaps' => $rekaps]);
    }

    public function create(): void {
        $this->requireAdmin();
        $this->view('admin/rekap/form', ['rekap' => null, 'errors' => []]);
    }

    public function store(): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST);

        // Handle upload
        $fotoFile = null;
        if (!empty($_FILES['foto_file']['name'])) {
            $uploadResult = $this->handleUpload($_FILES['foto_file']);
            if (isset($uploadResult['error'])) {
                $errors['foto_file'] = $uploadResult['error'];
            } else {
                $fotoFile = $uploadResult['filename'];
            }
        }

        if ($errors) {
            // Hapus file yang sudah terlanjur diupload kalau ada error lain
            if ($fotoFile) @unlink(self::UPLOAD_DIR . $fotoFile);
            $this->view('admin/rekap/form', ['rekap' => $_POST, 'errors' => $errors]);
            return;
        }

        $data = $this->sanitize($_POST);
        $data['foto_file'] = $fotoFile; // null kalau tidak upload

        $this->model->create($data);
        $this->redirect('/admin/rekap');
    }

    public function edit(string $id): void {
        $this->requireAdmin();
        $rekap = $this->model->find((int)$id);
        if (!$rekap) $this->redirect('/admin/rekap');
        $this->view('admin/rekap/form', ['rekap' => $rekap, 'errors' => []]);
    }

    public function update(string $id): void {
        $this->requireAdmin();
        $rekap  = $this->model->find((int)$id);
        $errors = $this->validate($_POST);

        // Handle upload
        $fotoFile = $rekap['foto_file'] ?? null; // default: tetap pakai foto lama
        if (!empty($_FILES['foto_file']['name'])) {
            $uploadResult = $this->handleUpload($_FILES['foto_file']);
            if (isset($uploadResult['error'])) {
                $errors['foto_file'] = $uploadResult['error'];
            } else {
                // Hapus foto lama kalau ada
                if ($fotoFile && file_exists(self::UPLOAD_DIR . $fotoFile)) {
                    @unlink(self::UPLOAD_DIR . $fotoFile);
                }
                $fotoFile = $uploadResult['filename'];
            }
        }

        if ($errors) {
            $this->view('admin/rekap/form', ['rekap' => array_merge($_POST, ['id' => $id, 'foto_file' => $rekap['foto_file'] ?? null]), 'errors' => $errors]);
            return;
        }

        $data = $this->sanitize($_POST);
        $data['foto_file'] = $fotoFile;

        $this->model->update((int)$id, $data);
        $this->redirect('/admin/rekap');
    }

    public function delete(string $id): void {
        $this->requireAdmin();

        // Hapus foto dari server saat data dihapus
        $rekap = $this->model->find((int)$id);
        if ($rekap && !empty($rekap['foto_file'])) {
            $path = self::UPLOAD_DIR . $rekap['foto_file'];
            if (file_exists($path)) @unlink($path);
        }

        $this->model->delete((int)$id);
        $this->redirect('/admin/rekap');
    }

    // ---------------------------------------------------------------
    // Upload handler
    // ---------------------------------------------------------------
    private function handleUpload(array $file): array {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'Upload gagal (kode: ' . $file['error'] . ').'];
        }
        if ($file['size'] > self::MAX_SIZE) {
            return ['error' => 'Ukuran file melebihi 2MB.'];
        }

        // Cek MIME type dari isi file, bukan dari ekstensi
        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        if (!in_array($mimeType, self::ALLOWED_TYPES, true)) {
            return ['error' => 'Format file tidak didukung. Gunakan JPG, PNG, WebP, atau GIF.'];
        }

        // Buat nama file unik
        $ext      = match($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
            'image/gif'  => 'gif',
        };
        $filename = 'rekap_' . uniqid('', true) . '.' . $ext;

        // Buat folder jika belum ada
        if (!is_dir(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], self::UPLOAD_DIR . $filename)) {
            return ['error' => 'Gagal menyimpan file ke server.'];
        }

        return ['filename' => $filename];
    }

    // ---------------------------------------------------------------
    // Validasi & sanitasi
    // ---------------------------------------------------------------
    private function validate(array $data): array {
        $errors = [];
        if (empty($data['judul']))     $errors['judul']     = 'Judul wajib diisi.';
        if (empty($data['deskripsi'])) $errors['deskripsi'] = 'Deskripsi wajib diisi.';
        if (empty($data['tanggal']))   $errors['tanggal']   = 'Tanggal wajib diisi.';
        if (empty($data['pdf_url']))   $errors['pdf_url']   = 'URL PDF wajib diisi.';
        return $errors;
    }

    private function sanitize(array $data): array {
    return [
        'judul'     => htmlspecialchars(trim($data['judul'])),
        'deskripsi' => htmlspecialchars(trim($data['deskripsi'])),
        'tanggal'   => $data['tanggal'],
        'pdf_url'   => trim($data['pdf_url']),
    ];
    }
}