# e-Library

## Deskripsi
**e-Library** adalah aplikasi perpustakaan digital berbasis web yang memudahkan pengguna untuk mengelola koleksi buku, melakukan peminjaman, serta menandai buku favorit.

## Fitur Utama
- Autentikasi pengguna (register, login, verifikasi email)
- Dashboard statistik peminjaman dan aktivitas
- Manajemen buku (tambah, edit, hapus, lihat detail)
- Peminjaman dan pengembalian buku
- Daftar buku favorit
- Pencarian dan filter buku berdasarkan genre
- Tampilan modern dan responsif

## Instruksi Instalasi
1. **Clone repository**
   ```bash
   git clone <repo-url>
   cd e-library
   ```
2. **Install dependency PHP & Laravel**
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   # Atur koneksi database di file .env
   php artisan migrate --seed
   ```
3. **Install dependency frontend**
   ```bash
   npm install
   npm run build
   npm run dev
   ```
4. **Jalankan server**
   ```bash
   php artisan serve
   ```
5. **Akses aplikasi**
   Buka browser ke `http://localhost:8000`

## Struktur Folder Proyek
```
e-library/
├── app/                # Kode backend Laravel (controller, model, provider)
├── bootstrap/          # Bootstrap file Laravel
├── config/             # Konfigurasi aplikasi
├── database/           # Migrasi, seeder, factory
├── public/             # Entry point aplikasi & aset publik
├── resources/
│   ├── css/            # File CSS
│   ├── js/             # File JavaScript
│   └── views/          # Blade template (UI)
├── routes/             # Routing aplikasi
├── storage/            # File yang diupload, cache, logs
├── tests/              # Testing
├── artisan             # CLI Laravel
├── composer.json       # Dependency PHP
├── package.json        # Dependency JS
└── README.md           # Dokumentasi
```

## Alur Login hingga ke Dashboard
1. Pengguna membuka halaman utama dan memilih **Login**.
   <img width="1901" height="938" alt="image" src="https://github.com/user-attachments/assets/ef116d38-0363-4e41-bde6-7c4e4af9115c" />

3. Masukkan email & password, lalu klik **Masuk**.
4. Jika login berhasil, pengguna diarahkan ke halaman **Dashboard** yang menampilkan statistik, aktivitas, dan menu navigasi utama.

## Alur CRUD Buku
### Menambah Buku
1. Klik tombol **Tambah** di dashboard atau halaman buku.
2. Isi form data buku (judul, penulis, cover, genre, tahun, dll).
3. Klik **Simpan**. Buku akan muncul di daftar buku.

### Mengedit Buku
1. Pada kartu buku, klik ikon **pensil/edit**.
2. Ubah data yang diinginkan pada form edit.
3. Klik **Simpan** untuk memperbarui data buku.

### Menghapus Buku
1. Pada kartu buku, klik ikon **hapus (X)**.
2. Konfirmasi penghapusan pada dialog yang muncul.
3. Buku akan dihapus dari daftar.

---
Untuk pertanyaan lebih lanjut, silakan hubungi pengembang. 
