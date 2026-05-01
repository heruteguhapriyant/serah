<?php
class AdminHeroSliderController extends Controller {
    private HeroSliderModel $model;

    public function __construct() {
        $this->model = new HeroSliderModel();
    }

    public function index(): void {
        $this->requireAdmin();
        $slides = $this->model->getAll();
        $this->view('admin/heroslider/index', ['slides' => $slides]);
    }

    public function create(): void {
        $this->requireAdmin();
        $this->view('admin/heroslider/form', ['slide' => null, 'errors' => []]);
    }

    public function store(): void {
        $this->requireAdmin();
        $uploaded = $this->uploadFoto();
        if (!$uploaded) {
            $this->view('admin/heroslider/form', [
                'slide'  => $_POST,
                'errors' => ['foto' => 'Foto wajib diupload. Format: JPG, PNG, WebP. Maks. 5MB.']
            ]);
            return;
        }
        $this->model->create([
            'foto_url' => $uploaded,
            'urutan'   => (int)($_POST['urutan'] ?? 0),
        ]);
        $this->redirect('/admin/heroslider');
    }

    public function edit(string $id): void {
        $this->requireAdmin();
        $slide = $this->model->find((int)$id);
        if (!$slide) $this->redirect('/admin/heroslider');
        $this->view('admin/heroslider/form', ['slide' => $slide, 'errors' => []]);
    }

    public function update(string $id): void {
        $this->requireAdmin();
        $uploaded = $this->uploadFoto();
        $fotoUrl  = $uploaded ?? ($_POST['foto_url_lama'] ?? '');
        if (empty($fotoUrl)) {
            $this->view('admin/heroslider/form', [
                'slide'  => array_merge($_POST, ['id' => $id]),
                'errors' => ['foto' => 'Foto tidak boleh kosong.']
            ]);
            return;
        }
        $this->model->update((int)$id, [
            'foto_url' => $fotoUrl,
            'urutan'   => (int)($_POST['urutan'] ?? 0),
        ]);
        $this->redirect('/admin/heroslider');
    }

    public function delete(string $id): void {
        $this->requireAdmin();
        $this->model->delete((int)$id);
        $this->redirect('/admin/heroslider');
    }

    private function uploadFoto(): ?string {
        if (empty($_FILES['foto']['name'])) return null;

        $file    = $_FILES['foto'];
        $maxSize = 5 * 1024 * 1024;
        $allowed = ['image/jpeg', 'image/png', 'image/webp'];
        $ext     = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxSize) return null;

        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $allowed)) return null;

        $filename  = uniqid('slide_', true) . '.' . $ext[$mime];
        $uploadDir = APP_ROOT . '/public/uploads/slider/';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0775, true);
        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) return null;

        return APP_URL . '/uploads/slider/' . $filename;
    }
}