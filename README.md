# Web Absensi

Aplikasi web untuk manajemen absensi dosen dan mahasiswa. Fitur utama: kelola kelas, data mahasiswa, jadwal pertemuan, dan rekap absensi.

## Kebutuhan Sistem

- **PHP 8.1+**
- **Composer** (untuk install PHP package)
- **MySQL 5.7+** atau **MariaDB**
- **Node.js & npm** (opsional, untuk asset CSS/JS)

## Instalasi Cepat (5 menit)

### 1. Siapkan File Konfigurasi

```bash
cp .env.example .env
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Generate Key Aplikasi

```bash
php artisan key:generate
```

### 4. Atur Database (Edit file `.env`)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_absensi      # Nama database
DB_USERNAME=root             # Username MySQL
DB_PASSWORD=                 # Password MySQL (kosongkan jika tidak ada)
```

> ⚠️ **Buat database `web_absensi` di MySQL terlebih dahulu!**

### 5. Jalankan Migrasi & Seed Database

```bash
php artisan migrate
php artisan db:seed
```

Perintah di atas akan membuat semua tabel dan mengisi akun dosen awal.

### 6. Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser: **http://127.0.0.1:8000**

---

## Akun Login Awal

Setelah menjalankan `php artisan db:seed`, gunakan akun berikut:

| Email              | Password      |
| ------------------ | ------------- |
| `dosen@gmail.com`  | `password123` |
| `dosen2@gmail.com` | `password123` |

---

## Struktur Folder Penting

- `app/Models/` — Model database (User, Kelas, Mahasiswa, dll)
- `app/Http/Controllers/` — Logic aplikasi
- `resources/views/` — Tampilan (HTML/Blade)
- `routes/web.php` — URL routing
- `database/migrations/` — Struktur tabel database
- `database/seeders/` — Data awal aplikasi

---

## Build Asset (Opsional)

Jika Anda mengubah file CSS/JS:

```bash
npm install
npm run dev
```

---

## Upload ke GitHub

### 1. Setup Git Repository

```bash
git init
git add .
git commit -m "Inisialisasi Web Absensi"
```

### 2. Buat Repository di GitHub

- Buka [github.com](https://github.com)
- Klik **New Repository**
- Isi nama repo, pilih **Public** atau **Private**
- **Jangan** buat README atau .gitignore (kami sudah punya)

### 3. Connect ke Repository

```bash
git remote add origin https://github.com/USERNAME/NAMA-REPO.git
git branch -M main
git push -u origin main
```

Ganti `USERNAME` dan `NAMA-REPO` sesuai akun GitHub Anda.

---

## Troubleshooting

**Q: Error "SQLSTATE[HY000] [1045]"**  
A: Cek username/password MySQL di `.env`

**Q: Error "database doesn't exist"**  
A: Buat database `web_absensi` di MySQL, lalu jalankan `php artisan migrate`

**Q: Port 8000 sudah dipakai**  
A: Gunakan port lain: `php artisan serve --port=8001`

---

## Catatan untuk Pengumpulan

✅ `.gitignore` sudah mengabaikan:

- `vendor/` (folder PHP dependencies)
- `.env` (file konfigurasi private)
- `node_modules/` (folder npm dependencies)
- `storage/` (folder temporary files)

Jadi saat push ke GitHub, file-file sensitive tidak akan terupload.

---

**Butuh bantuan? Tanyakan ke dosen atau cek dokumentasi Laravel: https://laravel.com/docs**
