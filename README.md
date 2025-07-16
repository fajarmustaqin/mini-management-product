# 🛍️ Mini Product Management App

Aplikasi web sederhana untuk manajemen produk

---

## 🚀 Fitur Utama

✅ CRUD Produk
✅ RESTful API
✅ AJAX Interaktif (Tanpa Reload)  
✅ Styling responsive dengan Bootstrap  
✅ Error handling & notifikasi interaktif  
✅ Dummy data siap pakai (Seeder)  
✅ API siap dites via Postman  

---

## 📦 Teknologi yang Digunakan

- Laravel 12
- MySQL
- jQuery & AJAX
- Bootstrap 5
- Postman (for testing)
- Sweetalert2

---

## 🖥️ Environment & Tools Development

- OS: Windows 11
- Localhost: [Laragon](https://laragon.org/) (PHP 8.3, MySQL 8.0, Apache)
- Database GUI: [HeidiSQL](https://www.heidisql.com/)
- API Testing: Postman

---



## ⚙️ Instalasi Project

1. **Clone project**
```bash
git clone https://github.com/fajarmustaqin/mini-management-product.git
cd mini-management-product
```

2. **Install dependency**
```bash
composer install
```

3. **Copy dan konfigurasi .env**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di `.env`**
```dotenv
DB_DATABASE=db_management_product
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrasi + Seeder (isi dummy data)**
```bash
php artisan migrate:fresh --seed
```

6. **Jalankan server**
```bash
php artisan serve
```

Akses: [http://localhost:8000](http://localhost:8000)

---

## 🧪 Tes API via Postman

1. Import file: [`Mini Manajemen Produk API.postman_collection`](./Mini Manajemen Produk API.postman_collection)
2. Ganti `{{base_url}}` menjadi `http://localhost:8000`

### Endpoint Tersedia:

| Method | Endpoint             | Keterangan          |
|--------|----------------------|---------------------|
| GET    | `/api/products`      | Ambil semua produk  |
| POST   | `/api/products`      | Tambah produk       |
| PUT    | `/api/products/{id}` | Update produk       |
| DELETE | `/api/products/{id}` | Hapus produk        |

---

## 🧹 Struktur Folder Penting

```
routes/
  └── api.php           # Endpoint API
resources/views/
  └── products.blade.php # Halaman frontend
app/Http/Controllers/
  └── ProductController.php
database/seeders/
  └── ProductSeeder.php
```