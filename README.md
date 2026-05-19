# CareerForge

CareerForge is a student job-readiness platform (profile + skills + dashboard + community).

## Project Location

The main Laravel app lives here:

```
CareerForge/careerforge-laravel/
```

## Prerequisites

- PHP 8.1+ + Composer
- Node.js + npm
- MySQL (XAMPP is fine)

## Quick Start

From the repo root:

```bash
cd CareerForge/careerforge-laravel
composer install
npm install
copy .env.example .env
php artisan key:generate
```

### Database

Edit `CareerForge/careerforge-laravel/.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=careerforge
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations:

```bash
php artisan migrate
```

## Run

Terminal 1:

```bash
cd CareerForge/careerforge-laravel
php artisan serve --host=127.0.0.1 --port=8000
```

Terminal 2 (optional, for Vite assets):

```bash
cd CareerForge/careerforge-laravel
npm run dev
```

Open:

- http://127.0.0.1:8000/student/login
- http://127.0.0.1:8000/student/register
- http://127.0.0.1:8000/student/community

## Notes

- Community posts/comments are stored in the database (`posts`, `comments`).
- The `student/` folder in the repo root is the old PHP version (don’t use it when running Laravel).