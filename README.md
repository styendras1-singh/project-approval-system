# 🚀 Project Approval Workflow System

## 📌 Overview
This is a Laravel-based Project Approval Workflow System where users can submit projects and admins can review, approve, or reject them with proper workflow and notifications.

---

## 🚀 Features
- 🔐 User Authentication (Laravel Breeze)
- 👤 Role-Based Access Control (Admin / User)
- 📁 Project Submission with File Upload
- ✅ Admin Approval / ❌ Rejection Workflow
- 📧 Email Notifications (Queued Jobs)
- 📊 Dashboard with Statistics (Pending, Approved, Rejected)
- 🔍 Filter & Sort (Status, Date, User)
- 📝 Audit Logs for tracking actions

---

## 🛠 Tech Stack
- Laravel 12
- PHP 8.2
- MySQL
- Blade (UI)
- XAMPP

---
## 👤 Admin Login

Email: admin@gmail.com  
Password: Admin@123456
Configure Database in .env

DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

Run Migration & Seeder

php artisan migrate --seed

Run Server
php artisan serve
php artisan key:generate

