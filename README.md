# 🛍️ Mini Product Management App

Aplikasi web sederhana berbasis Laravel 12 + jQuery untuk manajemen produk — dibuat sebagai studi kasus rekruitasi Beeru.

---

## 🚀 Fitur Utama

✅ CRUD Produk (Nama Produk, SKU, Harga, Stok)  
✅ RESTful API dengan Laravel 12  
✅ AJAX Interaktif (Tanpa Reload)  
✅ Styling responsive dengan Bootstrap  
✅ Error handling & notifikasi interaktif  
✅ Dummy data siap pakai (Seeder)  
✅ API siap dites via Postman  

---

## 📦 Teknologi yang Digunakan

- Laravel 12 (REST API)
- MySQL / MariaDB
- jQuery & AJAX
- Bootstrap 5
- Postman (for testing)

---

## ⚙️ Instalasi Project

1. **Clone project**
```bash
git clone https://github.com/username/mini-management-product.git
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
DB_DATABASE=beeru_db
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

1. Import file: [`Beeru_Mini_Product_API.postman_collection.json`](./Beeru_Mini_Product_API.postman_collection.json)
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

---

## 📬 Kontak

Untuk keperluan rekrutmen, file ini disiapkan oleh:  
**Nama:** [Isi Nama Kamu]  
**Email:** [email@example.com]

---

## ✅ Status

Project ini telah selesai dan siap diuji sesuai instruksi studi kasus rekruitasi Beeru.