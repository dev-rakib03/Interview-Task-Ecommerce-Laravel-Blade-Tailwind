# Laravel E-Commerce Project Setup Guide

Follow these CLI-based steps to set up your Laravel e-commerce project locally.

---

## 1. Clone or Download the Project

```sh
# Clone the repository
gh repo clone dev-rakib03/Interview-Task-Ecommerce-Laravel-Blade-Tailwind

# OR download and extract the ZIP (manual step)
```

---

## 2. Create the `.env` File

```sh
cp .env.example .env
```

---

## 3. Install PHP Dependencies

```sh
composer install
```

---

## 4. Install Node Dependencies

```sh
npm install
```

---

## 5. Generate App Key & Create Storage Symlink

```sh
php artisan key:generate
php artisan storage:link
```

---

## 6. Set Up Database Connection

Edit your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

---

## 7. Run Migrations

```sh
php artisan migrate
```

---

## 8. Start the Development Servers (Backend & Frontend)

```sh
# Start Laravel backend server
php artisan serve

# In a new terminal, start Vite dev server
npm run dev
```

---

## 9. Admin Panel

- Category Management: [http://localhost:8080/admin/categories](http://localhost:8000/admin/categories)
- Product Management: [http://localhost:8080/admin/products](http://localhost:8000/admin/products)

---

## 10. Frontend Routes

- Home Page: [http://localhost:8080/](http://localhost:8000/)
- Shop Page: [http://localhost:8080/shop](http://localhost:8000/shop)

---

**Done!**  
You are now ready to use the Laravel e-commerce system.
