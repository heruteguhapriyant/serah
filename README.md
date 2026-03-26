# 🎭 Serah - Forum Literasi Seni & Pertunjukan

**Serah** adalah sebuah forum literasi seni dan pertunjukan yang menjadi ruang temu publik untuk membaca karya, mendiskusikan gagasan, serta menyaksikan pertunjukan sebagai bentuk refleksi kebudayaan.

Project ini dikembangkan sebagai aplikasi web berbasis **PHP dengan arsitektur MVC**, yang bertujuan menghadirkan platform digital untuk mendukung aktivitas literasi dan apresiasi seni.

Project ini juga merupakan colab dari Remaja, pelajar, mahasiswa, komunitas seni, masyarakat umum yang tertarik pada literasi dan pertunjukan.

**Supported by: Bakti Budaya Djarum Foundation**

---

## ✨ Fitur Utama

* 📖 Publikasi karya (artikel / tulisan dalam bentuk pdf)
* 💬 Diskusi dan pertukaran gagasan
* 🎭 Informasi dan dokumentasi pertunjukan
* 🧑‍💻 Struktur MVC dari nol (tanpa framework)

---

## 🛠️ Teknologi

* PHP Native (MVC)
* HTML, CSS, JavaScript
* MySQL
* Git & GitHub

---

# SERAH — Forum Literasi Seni & Pertunjukan
## Panduan Setup & Instalasi

---

## Struktur Folder

```
serah/
├── app/
│   ├── controllers/        ← Logic tiap halaman
│   ├── models/             ← Akses database
│   └── views/
│       ├── public/         ← Tampilan untuk publik
│       ├── admin/          ← Tampilan panel admin
│       └── layouts/        ← Header/footer bersama
├── core/                   ← Database, Router, Controller, Model base
├── config/
│   ├── app.php             ← Konfigurasi utama & kredensial admin
│   └── database.php        ← Konfigurasi MySQL
├── public/                 ← Folder yang diakses browser (document root)
│   ├── index.php           ← Front controller (entry point)
│   ├── .htaccess           ← URL rewriting
│   ├── css/
│   │   ├── style.css       ← CSS publik
│   │   └── admin.css       ← CSS admin
│   └── js/
├── routes/web.php          ← Definisi semua route
├── storage/                ← File storage (opsional)
└── database.sql            ← Schema & sample data MySQL
```

---

## Langkah Instalasi

### 1. Konfigurasi Database
Buka file `config/database.php` dan sesuaikan:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'serah_db');
define('DB_USER', 'root');
define('DB_PASS', '');
```

### 2. Buat Database
Import file `database.sql` ke MySQL/MariaDB:
```bash
mysql -u root -p < database.sql
```
Atau buka di phpMyAdmin → Import → pilih `database.sql`.

### 3. Konfigurasi APP_URL
Buka `config/app.php`, sesuaikan `APP_URL` dengan URL lokal Anda:
```php
// Jika folder project ada di htdocs/serah:
define('APP_URL', 'http://localhost/serah/public');

// Jika di root server:
define('APP_URL', 'http://localhost');
```

### 4. Aktifkan mod_rewrite (Apache)
Pastikan `mod_rewrite` aktif di Apache. Di XAMPP:
- Buka `httpd.conf`
- Pastikan `LoadModule rewrite_module` tidak dikomentari
- Pastikan `AllowOverride All` aktif untuk folder project

### 5. Ubah Kredensial Admin (Penting!)
Buka `config/app.php` dan ganti:
```php
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'serah2024'); // ← ganti ini!
```

---

## Akses Website

| URL | Keterangan |
|-----|-----------|
| `http://localhost/serah/public/` | Halaman publik (Beranda) |
| `http://localhost/serah/public/program` | Halaman Program |
| `http://localhost/serah/public/rekap` | Halaman Rekap Kegiatan |
| `http://localhost/serah/public/admin/login` | Login Admin |
| `http://localhost/serah/public/admin` | Dashboard Admin |
| `http://localhost/serah/public/admin/program` | Kelola Program |
| `http://localhost/serah/public/admin/rekap` | Kelola Rekap |

---

## Cara Kerja Rekap Kegiatan

1. **Admin** login → buka menu *Rekap Kegiatan* → klik *Tambah Rekap*
2. Isi form: Judul, Deskripsi, Tanggal, URL PDF (dari Google Drive), URL Foto (opsional)
3. Pastikan file PDF di Google Drive sudah di-set **"Anyone with the link can view"**
4. **User publik** membuka halaman `/rekap` → melihat daftar kartu rekap
5. Klik kartu → muncul **popup konfirmasi** → klik *Ya, Buka PDF* → PDF terbuka di tab baru

---

## Fitur

### Publik
- Beranda dengan hero, daftar program, dan rekap terbaru
- Halaman Program lengkap (semua program)
- Halaman Rekap Kegiatan (semua rekap dengan popup konfirmasi PDF)

### Admin
- Login/logout dengan session
- Dashboard dengan statistik dan aksi cepat
- CRUD Program (Tambah, Edit, Hapus)
- CRUD Rekap Kegiatan (Tambah, Edit, Hapus) dengan input URL PDF Google Drive
- Validasi form server-side

---

## Catatan Teknis
- **PHP**: 8.0+
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Server**: Apache dengan mod_rewrite
- Tidak memerlukan Composer atau framework apapun
- Password admin disimpan sebagai plain text di config — untuk produksi, disarankan menggunakan `password_hash()` dan `password_verify()`


## 🎯 Tujuan Project

* Membangun platform literasi seni berbasis web
* Mengimplementasikan konsep MVC tanpa framework
* Menjadi bagian dari portofolio pengembangan web


---

## 👤 Author

[Heru Teguh Apriyanto]

---
