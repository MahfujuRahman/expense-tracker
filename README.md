## Expense Tracker — Install & Run

This repository contains a small Laravel-based expense tracker application. The steps below show how to install dependencies, copy the example environment file, run migrations, and start the development server (PowerShell examples included).

## Requirements

- PHP 8.0+ with required extensions
- Composer
- Node.js 14+ and npm
- SQLite (recommended for quick local run) or MySQL/Postgres
- Git (optional)

## Quick start (recommended, PowerShell)

1. Open a PowerShell prompt and go to the project directory:

```powershell
cd "D:\Practice work\ComputerCity\TaskManager"
```

2. Copy the example environment file to create your local `.env`:

```powershell
Copy-Item .env.example .env
```

3. Install PHP dependencies with Composer:

```powershell
composer install
```

4. Generate the application key:

```powershell
php artisan key:generate
```

5. (SQLite only) create the SQLite file used by the project:

```powershell
if (!(Test-Path -Path .\database\database.sqlite)) { New-Item -Path .\database\database.sqlite -ItemType File }
```

6. Configure the database in `.env` if you need MySQL/Postgres. For SQLite ensure these values are set (relative path works):

```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

7. Run database migrations (and seeders if present):

```powershell
php artisan migrate --seed
```

8. Install front-end dependencies and build assets (Vite):

```powershell
npm install
npm run dev
```

9. Create the storage symbolic link (for user uploaded files):

```powershell
php artisan storage:link
```

10. Start the local development server:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

Open http://127.0.0.1:8000 in your browser.

## Running tests

On Windows PowerShell run the bundled PHPUnit binary:

```powershell
.\vendor\bin\phpunit.bat
```

Or when using Git Bash / WSL:

```bash
./vendor/bin/phpunit
```

## Common maintenance & troubleshooting

- Composer out of memory during install (PowerShell):

```powershell
$env:COMPOSER_MEMORY_LIMIT = '-1'; composer install
```

- If migrations fail, double-check `.env` DB_* values and that the DB file exists (for sqlite) or DB server is running (for mysql/postgres).
- If assets don't load, ensure `npm run dev` is running while you develop, or run `npm run build` for production.
- If you see permission errors when writing to `storage` or `bootstrap/cache`, make those directories writable by the webserver.

## Switching to MySQL (example)

1. Update `.env` with your MySQL settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

2. Create the database in MySQL and run migrations:

```powershell
php artisan migrate --seed
```

## Notes

- Do not commit your `.env` file. It contains sensitive credentials.
- If you edit route or config files, clear cached config and routes:

```powershell
php artisan config:clear; php artisan route:clear; php artisan cache:clear
```

## Additional help

If you run into issues not covered here, open an issue or inspect the Laravel logs at `storage/logs/laravel.log`.

---

This README provides the essential steps to get the project running locally. If you'd like, I can add a short section that documents common developer workflows (creating users, seeding sample data, or running the seeders used for demo accounts).
