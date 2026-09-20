# KindTrack

> Tracking Giving • Brighter Tomorrows

KindTrack is a Laravel 12 web application developed as a college case-study project for managing donors, donations, charitable causes, receipts, and reports.

## Tech Stack

- **Backend:** PHP, Laravel 12
- **Frontend:** Blade, Bootstrap 5, Bootstrap Icons
- **Database:** MySQL
- **Charts:** Chart.js

## Features

- Donor management with search and donation history
- Cause management with donation progress tracking
- Donation recording with automatic receipt numbers
- Printable donation receipts
- Donor and cause image support
- Dashboard with donation statistics and charts
- Donor-wise, cause-wise, mode-wise and date-wise reports
- Admin and Staff role-based access
- Staff account management
- Public Staff registration
- User profile management

## Roles

### Admin

- Manage donors, causes and donations
- View dashboard and reports
- Manage staff accounts
- Full system access

### Staff

- Manage donors
- Record donations
- Manage causes
- View reports and receipts

## Installation

### 1. Clone the Repository

Clone the project from GitHub and open the project folder:

    git clone <your-repository-url>
    cd donation-charity-tracker

### 2. Install Dependencies

Install Laravel's PHP dependencies:

    composer install

### 3. Create Environment File

Create the `.env` file from the example file:

    copy .env.example .env

Generate the Laravel application key:

    php artisan key:generate

### 4. Create MySQL Database

Open MySQL and create the database:

    CREATE DATABASE donation_tracker;

### 5. Configure Database

Open the `.env` file and configure your MySQL connection:

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=donation_tracker
    DB_USERNAME=root
    DB_PASSWORD=your_mysql_password

Replace `your_mysql_password` with your local MySQL password.



### 8. Run Migrations and Seed Demo Data

Run the database migrations:

    php artisan migrate

Then seed the demo data:

    php artisan db:seed

This creates demo users, donors, causes, and donations.

### 9. Start the Application

Start the Laravel development server:

    php artisan serve

Open the application in your browser:

    http://127.0.0.1:8000

## Demo Login

### Admin

- **Email:** admin@example.com
- **Password:** password

### Staff

- **Email:** staff@example.com
- **Password:** password


## Reset Demo Data

To remove the existing database tables and recreate the demo data:

    php artisan migrate:fresh --seed

> Use this command only in a development environment because it deletes existing database data.

## Project Purpose

KindTrack was developed as an academic project to demonstrate Laravel MVC, MySQL database integration, CRUD operations, authentication, role-based authorization, form validation, reporting, receipt generation, and dashboard development.
