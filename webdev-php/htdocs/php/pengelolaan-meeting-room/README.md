# Pengelolaan Meeting Room

Sistem informasi manajemen pemesanan ruangan meeting berbasis web dengan PHP dan MySQL.

## Teknologi

| Komponen | Teknologi |
|----------|-----------|
| Backend | PHP (mysqli procedural) |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, Vanilla JavaScript |
| Ikon | [Font Awesome 6.5.0](https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css) |

## Struktur Direktori

```
pengelolaan-meeting-room/
├── index.php                 # Dashboard utama
├── login.php                 # Halaman login
├── logout.php                # Handler logout
├── auth_check.php            # Guard autentikasi session
├── koneksi.php               # Konfigurasi koneksi database
├── sqlscript.txt             # Skrip SQL schema + seed data
│
├── building/                 # Modul Gedung (CRUD)
│   ├── index.php             # Daftar gedung
│   ├── tambah_gedung.php     # Form tambah gedung
│   ├── edit_gedung.php       # Form edit gedung
│   └── hapus_gedung.php      # Hapus gedung
│
├── rooms/                    # Modul Ruangan (CRUD + Manage Fasilitas)
│   ├── index.php             # Daftar ruangan + modal AJAX fasilitas
│   ├── tambah_ruangan.php    # Form tambah ruangan
│   ├── edit_ruangan.php      # Form edit ruangan
│   ├── hapus_ruangan.php     # Hapus ruangan (beserta booking terkait)
│   └── facility.php          # Endpoint AJAX manajemen fasilitas ruangan
│
├── facility/                 # Modul Fasilitas (CRUD)
│   ├── index.php             # Daftar fasilitas
│   ├── tambah_facility.php   # Form tambah fasilitas
│   ├── edit_facility.php     # Form edit fasilitas
│   └── hapus_facility.php    # Hapus fasilitas
│
├── booking/                  # Modul Booking (CRUD + Detail)
│   ├── index.php             # Daftar booking
│   ├── tambahbooking.php     # Form tambah booking
│   ├── tambah_aksi.php       # Handler tambah booking
│   ├── edit.php              # Form edit booking
│   ├── update.php            # Handler edit booking
│   ├── hapus.php             # Hapus booking
│   └── detail.php            # Detail booking (join 3 tabel)
│
└── style/                    # Stylesheet
    ├── base.css              # Layout global, sidebar, tabel, badge
    ├── form.css              # Elemen form dan tombol
    ├── rooms.css             # Modal fasilitas ruangan
    └── booking.css           # Form booking dan detail card
```

## Database

### Konfigurasi

| Pengaturan | Nilai |
|------------|-------|
| Host | `webdev-php-mysql` |
| Username | `root` |
| Password | `root` |
| Database | `meeting_room_booking` |
| Charset | `utf8mb4` |

### Skema Tabel

```
building  1──< many  room
room      1──< many  room_facility  >──many  facility
room      1──< many  booking
user      (standalone)
```

| Tabel | Keterangan |
|-------|------------|
| `building` | Data gedung (nama, alamat, jumlah lantai) |
| `room` | Data ruangan (nama, lantai, kapasitas, status) |
| `facility` | Master fasilitas (nama, deskripsi) |
| `room_facility` | Relasi many-to-many ruangan ↔ fasilitas |
| `booking` | Data pemesanan ruangan (judul, organizer, tanggal, waktu, peserta, status) |
| `user` | Data pengguna untuk autentikasi |

### SQL Inisialisasi

Jalankan skrip di `sqlscript.txt` untuk membuat database beserta sample data.

## Fitur

### Autentikasi

- Login dengan session-based authentication
- Password di-hash menggunakan bcrypt (`password_verify`)
- `auth_check.php` melindungi semua halaman yang memerlukan login
- Default user: **admin**

### Dashboard

Menampilkan 7 kartu statistik:
- Total Gedung
- Total Ruangan
- Ruangan Tersedia
- Total Booking
- Scheduled / Completed / Cancelled
- Tabel daftar booking terbaru

### Modul Gedung

| Operasi | File | Deskripsi |
|---------|------|-----------|
| Create | `tambah_gedung.php` | Tambah gedung baru |
| Read | `index.php` | Lihat daftar gedung |
| Update | `edit_gedung.php` | Edit data gedung |
| Delete | `hapus_gedung.php` | Hapus gedung |

### Modul Ruangan

| Operasi | File | Deskripsi |
|---------|------|-----------|
| Create | `tambah_ruangan.php` | Tambah ruangan baru |
| Read | `index.php` | Lihat daftar ruangan beserta jumlah fasilitas |
| Update | `edit_ruangan.php` | Edit data ruangan |
| Delete | `hapus_ruangan.php` | Hapus ruangan (booking terkait dihapus terlebih dahulu) |
| Manage Facility | `facility.php` | AJAX modal untuk menambah/hapus fasilitas pada ruangan |

### Modul Fasilitas

| Operasi | File | Deskripsi |
|---------|------|-----------|
| Create | `tambah_facility.php` | Tambah fasilitas baru |
| Read | `index.php` | Lihat daftar fasilitas |
| Update | `edit_facility.php` | Edit data fasilitas |
| Delete | `hapus_facility.php` | Hapus fasilitas |

### Modul Booking

| Operasi | File | Deskripsi |
|---------|------|-----------|
| Create | `tambahbooking.php` + `tambah_aksi.php` | Form dan handler tambah booking |
| Read (List) | `index.php` | Daftar semua booking |
| Read (Detail) | `detail.php` | Detail booking (join 3 tabel: booking, room, building) |
| Update | `edit.php` + `update.php` | Form dan handler edit booking |
| Delete | `hapus.php` | Hapus booking |

## Persiapan

1. Jalankan MySQL/MariaDB
2. Import `sqlscript.txt` ke database
3. Edit `koneksi.php` sesuai konfigurasi database Anda
4. Jalankan aplikasi di web server (Apache/XAMPP/Docker)
5. Akses `login.php` dan login dengan akun **admin**

## Lisensi

Proyek ini dibuat untuk keperluan akademik (kuliah).
