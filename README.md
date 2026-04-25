# Laravel Product Management Demo

This is a demo Laravel application built as an interview assignment. It includes authentication, user roles, and an admin panel for managing products and categories.

## 🚀 Features

### 👤 Customer (Frontend User)
- User registration  
- Sends email notification on registration  
- Login & Logout functionality  

### 🔐 Admin (Backend User)
- Admin login  
- Redirect to product list after login  

### 🛠 Admin Panel Modules

#### Category Management
- Add, Edit, Delete, List categories  
- Fields: Name, Status  
- Soft delete enabled  

#### Product Management
- Add, Edit, Delete, List products  
- Fields: Name, Price, Description, Status, Image, Category  
- Rich text editor for description  
- Product linked with category  
- Soft delete enabled  

---

## 🧰 Tech Stack
- Laravel  
- MySQL  
- Blade Templates  
- Bootstrap (CSS Framework)  
- RESTful CRUD Operations  

---

## ⚙️ Installation Instructions

1. Clone the repository
git clone <your-repo-url>
cd <repo-folder>

2. Install dependencies
composer install

3. Update Environment Configuration
- Copy .env.example to .env
cp .env.example .env
- Set your database credentials in .env

4. Generate application key
php artisan key:generate

5. Run migrations
php artisan migrate

6. (Optional) Run seeder
php artisan db:seed

Note: If seeder is not created, you can create manually:
php artisan make:seeder UsersTableSeeder

7. Run the application
php artisan serve

---

## 🔑 Admin Login Credentials

- Email: admin@test.com  
- Password: 123456  

---

## 📝 Notes
- This project is developed for demo purposes only.  
- Not intended for production use.
