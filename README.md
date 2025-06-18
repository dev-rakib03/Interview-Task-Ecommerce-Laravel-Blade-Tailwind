documentation=======================================
Laravel E-Commerce Project Setup Guide
=======================================

Follow the steps below to get your Laravel e-commerce project up and running locally.

-------------------------------
1. Clone or Download the Project
-------------------------------
- Clone the repository:
  git clone <your-repo-url>

OR

- Download the ZIP and extract it to your preferred directory.

-----------------------------
2. Create the .env File
-----------------------------
- Duplicate the `.env.example` file and rename it to `.env`.

-----------------------------
3. Install PHP Dependencies
-----------------------------
- Run the following command in the project root:
  composer install

-----------------------------
4. Install Node Dependencies
-----------------------------
- Run the following command:
  npm install

------------------------------------------------
5. Generate App Key & Create Storage Symlink
------------------------------------------------
- Generate the application key:
  php artisan key:generate

- Create the storage symlink:
  php artisan storage:link

-----------------------------
6. Set Up Database Connection
-----------------------------
- Open the `.env` file.
- Update the following lines with your local DB credentials:

  DB_CONNECTION=mysql  
  DB_HOST=127.0.0.1  
  DB_PORT=3306  
  DB_DATABASE=your_database_name  
  DB_USERNAME=your_database_user  
  DB_PASSWORD=your_database_password  

-----------------------------
7. Run Migrations
-----------------------------
- Run the following command to migrate tables:
  php artisan migrate

----------------------------------------------------
8. Start the Development Servers (Backend & Frontend)
----------------------------------------------------
- Start Laravel server:
  php artisan serve

- In a new terminal, run Vite dev server:
  npm run dev

-----------------------------
9. Admin Panel
-----------------------------
- Category Management:
  http://localhost:8080/admin/categories

- Product Management:
  http://localhost:8080/admin/products

-----------------------------
10. Frontend Routes
-----------------------------
- Home Page:
  http://localhost:8080/

- Shop Page:
  http://localhost:8080/shop

-----------------------------
Done!
-----------------------------
You are now ready to use the Laravel e-commerce system.
