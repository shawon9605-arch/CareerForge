# CareerForge Laravel Conversion (partial)

This folder contains the Laravel equivalents of the whole `student/` section:
- `student/homepage.php`
- `student/login.php`
- `student/register.php`
- `student/dashboard.php`
- `student/profile.php`
- `student/save_profile.php`
- `student/jobs.php`
- `student/community.php`
- `student/post.php`
- `student/comment.php`
- `student/cv.php`
- `student/view_profile.php`

## How to use

1. Create a Laravel project (Laravel 10/11+):
   - Install PHP + Composer
   - `composer create-project laravel/laravel careerforge-laravel`

2. Copy these folders into your Laravel project (merge with existing):
   - `routes/web.php` → merge routes into your Laravel `routes/web.php`
   - `app/Http/Controllers/Student/*` → into `app/Http/Controllers/Student/`
   - `resources/views/student/*.blade.php` → into `resources/views/student/`
   - `public/assets/style.css` → into `public/assets/style.css`
   - (Optional) `database/migrations/*.php` → into `database/migrations/`

   Also copy these image assets from your current PHP project into Laravel `public/`:
   - `assets/user.png` → `public/assets/user.png`
   - `student/homepages.jpg` → `public/homepages.jpg`

3. Configure DB in `.env` (same DB you used in PHP):
   - `DB_DATABASE=careerforge`
   - `DB_USERNAME=root`
   - `DB_PASSWORD=`

4. Ensure the session contains `email` (same as your PHP `$_SESSION['email']`).

5. Visit:
   - `GET /` (redirects to `/student/homepage`)
   - `GET /student/homepage`
   - `GET /student/login`
   - `GET /student/register`
   - `GET /student/dashboard`
   - `GET /student/profile`
   - `GET /student/jobs`
   - `GET /student/community`
   - `GET /student/cv`
   - `GET /student/view-profile?email=someone@example.com`

6. Posting a comment:
   - Form submits to `POST /student/comment`
   - Redirects back to `/student/community`

## One-command setup (Option B)

If you want to reuse your existing `careerforge` database (Option B), run:

- `powershell -ExecutionPolicy Bypass -File laravel-conversion/scripts/setup_option_b.ps1 -CopyUploads -RunMigrations`

### Troubleshooting

**1) VS Code says "language not supported" / Run button doesn’t work**

Laravel/PHP must be run from a **Terminal (PowerShell)**, not via the editor Run button.

**2) `php -v` or `composer -V` fails**

This usually means PHP/Composer is not installed or not in PATH. You can still run the automation scripts by passing explicit paths:

- With `php.exe` path (example):
   - `powershell -ExecutionPolicy Bypass -File laravel-conversion/scripts/setup_option_b.ps1 -PhpExe "C:\\path\\to\\php.exe" -CopyUploads -RunMigrations`

- With Composer path:
   - If you have `composer.bat`/`composer.exe`, pass that path via `-ComposerExe`.
   - If you have `composer.phar`, pass that path via `-ComposerExe` (the script will run it using youcd myappr `-PhpExe`).

**3) XAMPP / port conflicts (MySQL already using 3306)**

If MySQL is not on `3306` (or another MySQL service is already using it), run with:
- `-DbHost "127.0.0.1" -DbPort 3307`

If you have XAMPP installed but MySQL won’t start, check if Windows service **MySQL80** is using `3306`.
You can either:
- Stop **MySQL80** (run Terminal as Administrator): `net stop MySQL80`
- Or change XAMPP MariaDB port to `3307` (then use `-DbPort 3307` / set `DB_PORT=3307`).

This will:
- Create a new Laravel project in `../careerforge-laravel` (relative to this repo)
- Copy routes/controllers/views/assets
- Copy `user.png`, `homepages.jpg`, and optional `uploads/`
- Update `.env` DB settings for MySQL
- Copy migrations but skip `create_students_table` (so it won’t conflict with your existing DB)

## Notes
- The migrations here include `students`, `posts`, and `comments` so a fresh Laravel DB can be created with `php artisan migrate`.
- If you already have an existing DB from your PHP project, you can skip the `students` migration and keep only missing tables.
- Your current `database.sql` doesn’t include the `comments` / `posts` tables.
- Login/Register use `md5()` exactly like your PHP code (same behavior).
