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
