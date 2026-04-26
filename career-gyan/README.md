# 🎓 Career Gyan

A comprehensive career guidance platform built with Laravel, helping students explore colleges, career paths, competitive exams, skill development, and more.

## 🚀 Quick Setup (After Cloning)

### Prerequisites
- **PHP 8.2+**
- **Composer** (PHP dependency manager)
- **Node.js & npm** (optional, for frontend assets)

### Step-by-step Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Copy environment file
cp .env.example .env
# On Windows (Command Prompt):
# copy .env.example .env

# 3. Generate application key
php artisan key:generate

# 4. Create SQLite database and run migrations + seeders
php artisan migrate --seed

# 5. Start the development server
php artisan serve
```

> **Note:** This project uses SQLite, so no MySQL/PostgreSQL setup is needed. The database file will be auto-created at `database/database.sqlite`.

### 🔧 If You Get Database Errors

If you see errors like `no such column` or `no such table`, it means the database is outdated or corrupted. Run:

```bash
# Reset the entire database (WARNING: deletes all data)
php artisan migrate:fresh --seed
```

This will:
1. Drop all existing tables
2. Re-run all migrations from scratch
3. Seed the database with sample data

## 📁 Project Structure

```
career-gyan/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database schema definitions
│   └── seeders/             # Sample data seeders
├── resources/views/         # Blade templates
├── routes/web.php           # Application routes
└── public/                  # Public assets
```

## 🌐 Features

- 🏫 Explore colleges across multiple fields (Engineering, Medical, Commerce, Arts, etc.)
- 📝 Career aptitude test with recommendations
- 📚 Competitive exam information
- 🛠️ Skill development resources
- 🏏 Sports career guidance
- 🌱 Agriculture & Small-scale business ideas
- 💡 Non-traditional career paths

## 🔑 Default Login

- **Email:** test@example.com
- **Password:** password

## License

This project is open-sourced software.
