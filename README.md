# 📘 Volunteer Web Application — Laravel Project Setup Guide

## 📌 Project Specifications
- **Framework:** Laravel 12  
- **Frontend Assets:** Vite + Flowbite  
- **Backend:** Laravel  
- **Database:** MySQL (local)  
- **UI Framework:** Flowbite  
- **Data Seeder:** Faker (for generating dummy data)  

---

## ⚠️ Requirements
Before running this project, please ensure you have:

- XAMPP or any MySQL server  
- MySQL running locally  
- PHP 8.2+  
- Composer  
- Node.js + NPM  

---

# 🚀 How to Run the Project

## 1️⃣ Download the Project
Download the ZIP file from GitHub:

```

Code → Download ZIP

````

Extract the folder to your local machine.

---

## 2️⃣ Configure the `.env` File
Open the `.env` file inside the project and update these values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=volunteer
DB_USERNAME=root
DB_PASSWORD=
````

> The database name must match exactly (`volunteer`).

---

## 3️⃣ Start MySQL and Create the Database

1. Open **XAMPP** → start **MySQL**
2. Open **phpMyAdmin**
3. Create a database named:

```
volunteer
```

---

## 4️⃣ Install PHP Dependencies

Run:

```bash
composer install
```

---

## 5️⃣ Install Node.js Dependencies

Ensure `flowbite` exists in `package.json`:

```json
"flowbite": "^4.0.1"
```

Then install frontend dependencies:

```bash
npm install
```

---

## 6️⃣ Run Database Migrations

Create tables with:

```bash
php artisan migrate
```

After migration, verify these tables exist:

* companies
* events
* event_registrations
* users

---

## 7️⃣ Seed the Database (Generate Dummy Data)

Run:

```bash
php artisan db:seed
```

Verify that data has been inserted into the tables.

---

## 8️⃣ Start Laravel Development Server

Terminal 1:

```bash
php artisan serve
```

Access the application at:

```
http://127.0.0.1:8000
```

---

## 9️⃣ Start Vite Dev Server (Frontend Assets)

Terminal 2:

```bash
npm run dev
```

This compiles CSS, JavaScript, and enables Hot Module Reloading.

---

# 🎉 Application Ready!

Open your browser and visit:

```
http://127.0.0.1:8000
```

Your Laravel + Flowbite application is now running.

---

## 📝 Notes

* Ensure the `volunteer` database exists before running migrations.
* Restart `npm run dev` if assets fail to load.
* Do not forget to configure `.env` before running the app.

---
