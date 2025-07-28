# Sistem Manajemen Tugas Proyek
# Deskripsi
Sistem Manajemen Tugas Proyek ini adalah sebuah sistem berbasis web yang dikembangkan menggunakan framework Laravel dan tampilan Blade dengan Tailwind CSS. 
Sistem ini dirancang untuk membantu pengguna dalam :
- mengatur proyek-proyek yang sedang mereka kerjakan, 
- menyusun daftar tugas (task list) untuk tiap proyek, 
- menambahkan dan mengelola anggota tim dalam proyek,
- memantau progres proyek secara visual melalui progress bar. 
Sistem ini tidak memiliki peran admin, sehingga seluruh pengguna dapat :
- mendaftar dan login, 
- membuat proyek pribadi mereka sendiri, 
- menambah anggota tim berdasarkan alamat email, 
- menandai tugas sebagai selesai,
- melihat statistik proyek dan tugas di dashboard. 
Aplikasi ini cocok digunakan untuk : 
- tim kecil, 
- mahasiswa,
- freelancer yang ingin mengatur pekerjaan secara terstruktur, sederhana, dan efisien.

# Fitur Utama
- Autentikasi pengguna (login & register)
- CRUD proyek (buat, edit, hapus)
- Manajemen anggota tim via email
- Manajemen daftar tugas per proyek
- Progress bar otomatis berdasarkan tugas yang selesai
- Dashboard statistik (total proyek, tugas, progress)

# Cara Instalasi
1. Clone Repository
```bash
git clone https://github.com/anjelelga/manajemen-tugas-proyek.git
cd manajemen-tugas-proyek

2. Install Dependensi
```bash
composer install
npm install && npm run build

3. Setup Environment
```bash 
cp .env.example .env
php artisan key:generate

4. Buat Database dan Migrasi
Edit file .env untuk menyesuaikan koneksi database, lalu jalankan: 
```bash
php artisan migrate

5. Jalankan Server
```bash 
php artisan serve