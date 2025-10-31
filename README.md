# LPPM IDE LPKIA - Sistem Manajemen Penelitian & Pengabdian

<div align="center">

![LPPM IDE LPKIA](https://img.shields.io/badge/LPPM-IDE%20LPKIA-blue?style=for-the-badge&logo=laravel&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-8.x-red?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-7.4+-8892BF.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-8.x-F05340.svg)](https://laravel.com)

**Sistem Informasi Modern untuk Mengelola Penelitian, Pengabdian Masyarakat, dan Konten Website LPPM IDE LPKIA Bandung**

[Dokumentasi](#dokumentasi) • [Demo](#demo) • [Instalasi](#instalasi) • [Kontribusi](#kontribusi)

---

</div>

## Tentang Proyek

**LPPM IDE LPKIA** adalah sistem manajemen terintegrasi yang dirancang khusus untuk mengelola kegiatan penelitian dan pengabdian masyarakat di Institut Digital Ekonomi LPKIA Bandung. Sistem ini menyediakan platform komprehensif untuk mengelola data dosen, penelitian, pengabdian masyarakat, dan konten website dengan interface yang user-friendly dan modern.

### Tujuan Utama
- Digitalisasi proses manajemen penelitian dan pengabdian
- Transparansi data dan informasi akademik
- Efisiensi administrasi dan pelaporan
- Aksesibilitas informasi bagi stakeholder

---

## Fitur Unggulan

### Dashboard Admin
- Analytics Dashboard - Statistik real-time kegiatan penelitian & pengabdian
- User Management - Kelola akun admin dan dosen
- Report Generator - Laporan otomatis dalam format Excel/PDF
- Role-based Access - Sistem keamanan berbasis peran

### Manajemen Dosen
- Profil Lengkap - Data pribadi, akademik, dan profesional
- Kualifikasi Akademik - Riwayat pendidikan dan sertifikasi
- Kompetensi - Keahlian dan bidang expertise
- Tracking Performance - Monitoring produktivitas dosen

### Manajemen Penelitian
- Proposal Tracking - Dari pengajuan hingga publikasi
- Dana Research - Monitoring anggaran dan pembiayaan
- Tim Peneliti - Kolaborasi multi-dosen
- Progress Monitoring - Status dan milestone penelitian

### Manajemen Pengabdian
- Community Service - Program pengabdian masyarakat
- Lokasi Program - Tracking lokasi dan dampak
- Penerima Manfaat - Jumlah dan kategori masyarakat
- Impact Assessment - Evaluasi dampak program

### Content Management System
- Dynamic Pages - Halaman website yang dapat diedit
- Article System - Blog dan berita terintegrasi
- Media Manager - Upload dan manajemen gambar
- WYSIWYG Editor - Editor konten modern

### Sistem Keamanan
- Authentication - Login aman untuk admin dan dosen
- Authorization - Kontrol akses berbasis permission
- Audit Trail - Log aktivitas sistem
- Data Protection - Enkripsi data sensitif

---

## Screenshots & Demo

<div align="center">

### Homepage
![Homepage](https://via.placeholder.com/800x400/4F46E5/FFFFFF?text=LPPM+Homepage)

### Admin Dashboard
![Dashboard](https://via.placeholder.com/800x400/059669/FFFFFF?text=Admin+Dashboard)

### Data Dosen
![Dosen Management](https://via.placeholder.com/800x400/DC2626/FFFFFF?text=Dosen+Management)

### Penelitian
![Research](https://via.placeholder.com/800x400/7C3AED/FFFFFF?text=Research+Management)

---

</div>

## Tech Stack

<div align="center">

### Backend
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

### Frontend
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

### Tools & Libraries
![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)
![NPM](https://img.shields.io/badge/NPM-%23CB3837.svg?style=for-the-badge&logo=npm&logoColor=white)
![Git](https://img.shields.io/badge/Git-F05032?style=for-the-badge&logo=git&logoColor=white)

</div>

---

## Instalasi & Setup

### Prerequisites
- PHP: 7.4 atau lebih tinggi
- Composer: Dependency manager untuk PHP
- MySQL: 8.0 atau MariaDB
- Node.js: 14+ (untuk asset compilation)
- Git: Version control

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/bacoti/lppm-php-downgrade-.git
   cd lppm-php-downgrade-
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   ```bash
   # Edit file .env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=lppm_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Database Migration & Seeding**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build Assets**
   ```bash
   npm run dev
   # atau untuk production
   npm run build
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

### Akses Aplikasi
- Frontend: `http://localhost:8000`
- Admin Panel: `http://localhost:8000/admin/login`

---

## Dokumentasi

### User Roles
- Admin: Full access ke semua fitur
- Dosen: Input data penelitian dan pengabdian
- Public: Akses informasi publik

### API Documentation
API endpoints tersedia untuk integrasi dengan sistem eksternal.

### Troubleshooting
Lihat file `TROUBLESHOOTING-CONTENT-FORM.md` untuk panduan troubleshooting.

---

## Kontribusi

Kami sangat menghargai kontribusi dari komunitas!

### Cara Berkontribusi:
1. Fork repository ini
2. Buat branch untuk fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Development Guidelines
- Ikuti PSR-12 coding standards
- Gunakan meaningful commit messages
- Test kode sebelum submit PR
- Update dokumentasi jika diperlukan

---

## Lisensi

Distributed under the MIT License. See `LICENSE` for more information.

---

## Tim Developer

<div align="center">

**LPPM IDE LPKIA Development Team**

Developed with ❤️ by LPPM IDE LPKIA Team

---

*Untuk informasi lebih lanjut, hubungi: [lppm@lpkia.ac.id](mailto:lppm@lpkia.ac.id)*

</div>

---

<div align="center">

Star this repo if you find it useful!

[![GitHub stars](https://img.shields.io/github/stars/bacoti/lppm-php-downgrade-.svg?style=social&label=Star)](https://github.com/bacoti/lppm-php-downgrade-/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/bacoti/lppm-php-downgrade-.svg?style=social&label=Fork)](https://github.com/bacoti/lppm-php-downgrade-/network)

</div>
