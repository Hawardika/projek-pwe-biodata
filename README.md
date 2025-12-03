<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

# Projek PWE – Aplikasi Biodata  
**Nama:** Ardika Fakhrizain Hawari  
**NIM:** 224443026  
**Kelas:** 2AEC2  

Aplikasi ini dibangun menggunakan Laravel sebagai bagian dari tugas mata kuliah *Pemrograman Web (PWE)*.  
Tujuannya adalah membuat sistem biodata personal yang dapat menampilkan profil, riwayat pendidikan, pengalaman kerja, keterampilan, dan foto profil secara dinamis.

Aplikasi mendukung **dark mode**, dynamic card untuk Education & Experience, serta tampilan profil menyerupai resume profesional.

---

# Tentang Laravel (Singkat)

Laravel adalah framework PHP dengan sintaks yang elegan dan modern. Framework ini menyediakan:

- Routing cepat  
- Dependency Injection  
- Session & Cache multiple driver  
- Eloquent ORM  
- Migration Schema  
- Queue & Job processing  
- Event Broadcasting  

Cocok untuk development aplikasi web berskala kecil hingga besar.

---

# Fitur Utama Aplikasi

- CRUD **Personal Data**
- CRUD **Education** (multi-entry, bisa tambah card sebanyak yang dibutuhkan)
- CRUD **Work Experience**
- Upload **foto profil**
- Skill tags otomatis (input skill dipisah koma)
- UI clean berbasis Bootstrap 5
- **Dark Mode** toggle (disimpan di localStorage)
- Tampilan biodata seperti resume / portfolio
- Semua data tersimpan di database MySQL

---

# Teknologi yang Digunakan

- Laravel 12  
- PHP 8.2+  
- MySQL / MariaDB  
- Composer  
- Node.js + Vite  
- Bootstrap 5  
- Blade Template Engine  

---

#  Cara Instalasi & Setup di Komputer Anda

Ikuti langkah berikut untuk menjalankan aplikasi di laptop Anda.

---

## 1. Clone Repository

```bash
git clone https://github.com/USERNAME/projek-pwe-biodata.git
```

### **2. Install Dependencies Backend (Laravel / Composer)**

```bash
composer install
```

---

### **3. Install Dependencies Frontend (Node / Vite)**

```bash
npm install
```

---

### **4. Setup File Environment (.env)**

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Lalu buka file `.env` dan sesuaikan konfigurasi database:

```text
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projek_pwe_biodata
DB_USERNAME=root
DB_PASSWORD=
```

---

### **5. Generate Application Key**

```bash
php artisan key:generate
```

---

### **6. Migrasi Database**

```bash
php artisan migrate
```

---

### **7. Setup Storage (untuk upload foto)**

```bash
php artisan storage:link
```

---

### **8. Menjalankan Backend (Laravel)**

```bash
php artisan serve
```

Akses backend melalui:

```
http://127.0.0.1:8000
```

---

### **9. Menjalankan Frontend (Vite)**

```bash
npm run dev
```

---

### **10. Akses Aplikasi**

Buka browser:

```
http://127.0.0.1:8000
```

---

##  Fitur Utama Aplikasi

* Edit biodata lengkap
* Upload foto profil
* Dynamic Work Experience
* Dynamic Education
* Dark mode
* Tampilan modern Bootstrap 5
* Data tersimpan ke MySQL
