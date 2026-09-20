# Donation & Charity Tracker

A Laravel 12 web application to manage donors, record donations, group them into financial categories, print receipts, and generate reports — built as a college case-study project.

## Tech Stack

- **Backend:** PHP, Laravel 12, MySQL
- **Frontend:** Blade, Bootstrap 5, Bootstrap Icons, Chart.js (CDN)
- **Auth:** Laravel session auth with role-based middleware (Admin / Staff)

## Features

- Donor management (add, edit, delete, search, donation history)
- Cause management with progress bar (raised vs target amount)
- Donation recording with auto-generated receipt numbers (`REC-2026-0001`, resets yearly)
- Printable donation receipts (browser print, dedicated print stylesheet)
- Reports: donor-wise, cause-wise, mode-wise, category-wise, date-wise (all with date filters)
- Dashboard with live stats (totals, monthly chart, top causes, mode/category summary)
- Two roles: **Admin** (full access + staff management) and **Staff** (day-to-day recording)
- Public sign-up (creates Staff accounts only; Admin role is assigned only from the Staff Users page)

## Login In 
### Admin 
email - admin@example.com
pass - password 

### Staff 
email - staff@example.com
pass - password


## Setup Instructions

### 1. Create the Laravel project

```bash
composer create-project laravel/laravel donation-tracker
cd donation-tracker
```

### 2. Copy in the project files

Copy the `app/`, `database/`, `resources/views/`, `routes/web.php`, `bootstrap/app.php`, and `public/css/` files from this codebase into the matching paths in your new project (overwrite where filenames match).

### 3. Configure the database

Create a MySQL database:

```sql
CREATE DATABASE donation_tracker;
```

Copy `.env.example` to `.env` and set:
DB_DATABASE=donation_tracker
DB_USERNAME=root
DB_PASSWORD=your_mysql_password



### 4. Install dependencies and generate the app key

```bash
composer install
php artisan key:generate
```

### 5. Register the role middleware

In `bootstrap/app.php`, make sure this is present inside `withMiddleware()`:

```php
$middleware->alias([
    'role' => \App\Http\Middleware\RoleMiddleware::class,
]);
```

### 6. Register the custom pagination view

In `app/Providers/AppServiceProvider.php`:

```php
use Illuminate\Pagination\Paginator;

public function boot(): void
{
    Paginator::defaultView('vendor.pagination.bootstrap-5');
}
```

### 7. Run migrations and seed demo data

```bash
php artisan migrate
php artisan db:seed
```

This creates:
- 2 users (1 Admin, 1 Staff)
- 5 donors
- 3 causes
- 8 donations

**Demo credentials** (development only):
- Admin: `admin@example.com` / `password`
- Staff: `staff@example.com` / `password`

### 8. Start the server

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` — you'll be redirected to `/login`.

## Resetting Demo Data

To wipe everything and reseed fresh demo data:

```bash
php artisan migrate:fresh --seed
```
.

