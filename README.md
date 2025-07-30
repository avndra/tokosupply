# 🛒 Mini Toko Supply Project

Laravel 12 based simple store & supply management project. This is a **Phase 1 & 2 only mini project** with basic admin CRUD and API features.

## 📦 Features
- ✅ User Authentication (Login, Logout)
- ✅ Admin CRUD (Users, Products, Suppliers, Toko, City)
- ✅ Role Middleware (`admin`, `user`)
- ✅ Order & Purchase API
- ✅ Laravel Seeder Ready

## 🛠️ Stack
- Laravel 12
- Bootstrap 5 (Basic UI)
- MySQL
- Laravel Eloquent ORM

## 🚀 Installation
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
