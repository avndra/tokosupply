# Mini Toko Supply
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

---

Laravel 12 based simple store & supply management project. This is a **Phase 1 & 2 only mini project** with basic admin CRUD and API features.

## Features
- User Authentication (Login, Logout)
- Admin CRUD (Users, Products, Suppliers, Toko, City)
- Role Middleware (`admin`, `user`)
- Order & Purchase API
- Laravel Seeder

## Stack
- Laravel 12
- Bootstrap 5 (Basic UI)
- MySQL
- Laravel Eloquent ORM

## Installation
```bash
git clone https://github.com/avndra/tokosupply.git
cd tokosupply
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

## 🔑 Default Users (Seeder)
- **Admin:**
  - Email: `admin@example.com`
  - Password: `password`
- **User:**
  - Email: `suryo@example.com` / `iqbal@example.com`
  - Password: `password`

## 📡 API Usage (Postman/Thunder Client)

### 1. Login (Ambil Token)
- **POST** `/api/login`
- **Body:**
  ```json
  { "email": "admin@example.com", "password": "password" }
  ```
- **Response:**
  ```json
  { "token": "1|xxxxxx", "user": { ... } }
  ```

### 2. Set Bearer Token di Header
- **Header:**
  - `Authorization: Bearer {token}`
  - `Content-Type: application/json`

### 3. Endpoint API Penting
- **GET /api/orders** (user): List order user
- **POST /api/orders** (user): Checkout
- **GET /api/orders/{id}** (user): Detail order
- **GET /api/admin/orders** (admin): Semua order
- **PATCH /api/orders/{id}/status** (admin): Ubah status order
- **POST /api/logout**: Logout

### 4. Contoh Checkout
```json
{
  "items": [
    { "product_id": 1 },
    { "product_id": 2 }
  ]
}
```

### 5. Troubleshooting
- **401 Unauthorized:**
  - Pastikan token benar & dikirim di header Authorization.
  - Token hanya berlaku untuk user yang login.
- **419 Page Expired:**
  - Pastikan pakai endpoint `/api/...`, bukan `/web.php`.
  - Jangan kirim CSRF token di header.
- **Call to undefined method createToken():**
  - Pastikan model User pakai trait `HasApiTokens`.
- **Logout error:**
  - Token sudah expired/terhapus, login ulang untuk dapat token baru.

### 6. Debug Token
Tambahkan endpoint test di `routes/api.php`:
```php
Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
```
Cek token dengan GET `/api/me`.

---

**Selamat mencoba API! Jika ada error, cek README ini atau paste error di GitHub Issue.**
