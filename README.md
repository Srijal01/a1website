# A.One National Technology Pvt. Ltd.

A dynamic company website and content management system for A.One National Technology Pvt. Ltd. The project presents the company's services, technology expertise, portfolio, blog, team, testimonials, and contact information through a public-facing website. An authenticated admin panel is included for managing website content.

## Features

### Public website

- Home and about pages
- Services listing and service detail pages
- Portfolio listing and project detail pages
- Technologies and technology expertise page
- Blog categories and blog post detail pages
- Contact form for visitor enquiries
- Dynamic pages managed through the admin panel

### Admin panel

The admin panel is available under `/admin` and is protected by authentication and admin authorization. Administrators can manage:

- Pages and website settings
- Services, portfolios, technologies, and team members
- Testimonials and clients
- Blog categories and blog posts
- Contact messages and reply status

## Technology stack

- PHP 8.2+
- Laravel 12
- SQLite by default, with support for other Laravel database drivers
- Blade templates
- Vite
- Tailwind CSS and Bootstrap 5
- Pest for testing

## Requirements

Make sure the following tools are installed:

- PHP 8.2 or newer
- Composer
- Node.js and npm

## Installation

Clone the repository and install the PHP and frontend dependencies:

```bash
git clone <repository-url>
cd a1website
composer install
npm install
```

Create the environment file and generate the application key:

```bash
copy .env.example .env
php artisan key:generate
```

The default configuration uses SQLite. Create the database file if it does not exist, then run the migrations and seed the initial website content:

```bash
php artisan migrate --seed
```

Build the frontend assets:

```bash
npm run build
```

## Running locally

Start the Laravel development server:

```bash
php artisan serve
```

For active frontend development, run Vite in a separate terminal:

```bash
npm run dev
```

The website is then available at `http://localhost:9999`.

You can also start the application, queue worker, and Vite together with:

```bash
composer run dev
```

## Useful commands

```bash
# Run the test suite
php artisan test --compact

# List registered routes
php artisan route:list

# Clear cached application data
php artisan optimize:clear

# Format PHP files with Laravel Pint
vendor/bin/pint
```

## Project structure

```text
app/                 Application controllers, models, and middleware
database/            Migrations, factories, and seeders
public/              Public entry point and uploaded assets
resources/views/     Public and admin Blade templates
resources/css/       Application styles
resources/js/        Frontend JavaScript entry points
routes/web.php       Public and admin web routes
```

## Content management

After installation, sign in through `/admin/login` with an administrator account configured by the project seeders. Keep production credentials private and update the seeded account before deploying the application.

## License

This project is proprietary software for A.One National Technology Pvt. Ltd. Unless explicitly permitted, do not redistribute or reuse its content and source code.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
