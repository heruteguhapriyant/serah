<?php
class AdminMediaPartnerController extends Controller {
    private MediaPartnerModel $model;

    public function __construct() {
        $this->model = new MediaPartnerModel();
    }

    public function index(): void {
        $this->requireAdmin();
        $partners = $this->model->getAll();
        $this->view('admin/mediapartner/index', ['partners' => $partners]);
    }

    public function create(): void {
        $this->requireAdmin();
        $this->view('admin/mediapartner/form', ['partner' => null, 'errors' => []]);
    }

    public function store(): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST);
        if ($errors) {
            $this->view('admin/mediapartner/form', ['partner' => $_POST, 'errors' => $errors]);
            return;
        }
        $data = $this->sanitize($_POST);
        $uploaded = $this->uploadLogo();
        if (!$uploaded) {
            $this->view('admin/mediapartner/form', [
                'partner' => $_POST,
                'errors'  => ['logo' => 'Logo wajib diupload.']
            ]);
            return;
        }
        $data['logo_url'] = $uploaded;
        $this->model->create($data);
        $this->redirect('/admin/mediapartner');
    }

    public function edit(string $id): void {
        $this->requireAdmin();
        $partner = $this->model->find((int)$id);
        if (!$partner) $this->redirect('/admin/mediapartner');
        $this->view('admin/mediapartner/form', ['partner' => $partner, 'errors' => []]);
    }

    public function update(string $id): void {
        $this->requireAdmin();
        $errors = $this->validate($_POST, false);
        if ($errors) {
            $this->view('admin/mediapartner/form', [
                'partner' => array_merge($_POST, ['id' => $id]),
                'errors'  => $errors
            ]);
            return;
        }
        $data = $this->sanitize($_POST);
        $uploaded = $this->uploadLogo();
        $data['logo_url'] = $uploaded ?? ($_POST['logo_url_lama'] ?? '');
        $this->model->update((int)$id, $data);
        $this->redirect('/admin/mediapartner');
    }

    public function delete(string $id): void {
        $this->requireAdmin();
        $this->model->delete((int)$id);
        $this->redirect('/admin/mediapartner');
    }

    private function uploadLogo(): ?string {
        if (empty($_FILES['logo']['name'])) return null;

        $file    = $_FILES['logo'];
        $maxSize = 2 * 1024 * 1024;
        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'];
        $ext     = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/svg+xml' => 'svg'];

        if ($file['error'] !== UPLOAD_ERR_OK) return null;
        if ($file['size'] > $maxSize) return null;

        $mime = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $allowed)) return null;

        $filename  = uniqid('partner_', true) . '.' . $ext[$mime];
        $uploadDir = APP_ROOT . '/public/uploads/mediapartner/';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0775, true);
        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) return null;

        return APP_URL . '/uploads/mediapartner/' . $filename;
    }

    private function validate(array $data, bool $logoRequired = true): array {
        $errors = [];
        if (empty($data['nama'])) $errors['nama'] = 'Nama wajib diisi.';
        if ($logoRequired && empty($_FILES['logo']['name'])) {
            $errors['logo'] = 'Logo wajib diupload.';
        }
        return $errors;
    }

    private function sanitize(array $data): array {
        return [
            'nama'     => htmlspecialchars(trim($data['nama'])),
            'url'      => trim($data['url'] ?? ''),
            'urutan'   => (int)($data['urutan'] ?? 0),
            'logo_url' => '',
        ];
    }
}