Quick dev notes for the Expense Tracker additions

- DB: I switched `.env` to use sqlite at `database/database.sqlite` for easy local testing.
- Seeded user: test@example.com / password
- To run locally (PowerShell):

```powershell
New-Item -ItemType File -Path .\database\database.sqlite -Force
php artisan migrate --seed
php -S localhost:8000 -t public
```

Visit http://localhost:8000, login at /login, then go to Dashboard and Expenses.

Next recommended improvements:
- Add registration or use Laravel Breeze.
- Add pagination and tests.
