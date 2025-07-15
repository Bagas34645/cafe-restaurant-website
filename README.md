# Cafe Restaurant Website

A complete Laravel-based website for marketing and promoting cafe/restaurant businesses with comprehensive admin management features.

## Features

### Public Pages

-   **Home**: Welcome page with featured products, gallery preview, and customer testimonials
-   **About**: Information about the restaurant, mission, and team
-   **Gallery**: Photo gallery showcasing the restaurant ambiance and food
-   **Menu/Products**: Complete menu with categories, prices, and descriptions
-   **Customer Reviews**: Customer testimonials and review submission form
-   **Contact**: Contact form, restaurant information, and FAQ section

### Admin Management Features

-   **Dashboard**: Overview of all data with statistics and quick actions
-   **Gallery Management**: Full CRUD operations for gallery items
-   **Product Management**: Full CRUD operations for menu items
-   **Review Management**: Approve/disapprove customer reviews
-   **Contact Management**: View and manage customer messages

### Key Functionalities

-   ✅ CRUD operations for Gallery and Products
-   ✅ Customer review submission and admin approval system
-   ✅ Contact form with admin message management
-   ✅ Image upload and management
-   ✅ Responsive design with Bootstrap 5
-   ✅ Professional admin panel interface
-   ✅ Data pagination and filtering
-   ✅ Sample data seeding

## Installation

1. **Clone the repository**

    ```bash
    git clone <repository-url>
    cd cafe-restaurant-website
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database configuration**
   Update your `.env` file with database credentials:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=cafe_restaurant
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Database migration and seeding**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

6. **Storage symlink**

    ```bash
    php artisan storage:link
    ```

7. **Start the development server**
    ```bash
    php artisan serve
    ```

## Usage

### Public Website

-   Visit `http://localhost:8000` to see the main website
-   Navigate through different pages using the main menu
-   Submit reviews through the Reviews page
-   Send messages through the Contact page

### Admin Panel

-   Access admin panel at `http://localhost:8000/admin`
-   Manage gallery items, products, reviews, and contact messages
-   View dashboard statistics and recent activities

## Project Structure

```
app/
├── Http/Controllers/
│   ├── AdminController.php      # Admin dashboard
│   ├── ContactController.php    # Contact management
│   ├── GalleryController.php    # Gallery CRUD
│   ├── HomeController.php       # Home and About pages
│   ├── ProductController.php    # Product CRUD
│   └── ReviewController.php     # Review management
├── Models/
│   ├── Contact.php             # Contact messages
│   ├── Gallery.php             # Gallery items
│   ├── Product.php             # Menu products
│   └── Review.php              # Customer reviews
database/
├── migrations/                 # Database schema
└── seeders/                   # Sample data
resources/
├── views/
│   ├── layouts/               # Base layouts
│   ├── admin/                 # Admin panel views
│   ├── gallery/               # Gallery pages
│   ├── products/              # Product pages
│   ├── reviews/               # Review pages
│   └── contact/               # Contact pages
routes/
└── web.php                    # Application routes
```

## Database Schema

### Tables

-   **galleries**: Store gallery images with title, description, and status
-   **products**: Store menu items with name, description, price, category, and availability
-   **reviews**: Store customer reviews with rating, comment, and approval status
-   **contacts**: Store contact form submissions with read status

### Key Fields

-   Image storage uses Laravel's storage system
-   Boolean fields for status management (active/inactive, approved/pending, read/unread)
-   Timestamps for all records

## Technologies Used

-   **Backend**: Laravel 12.x
-   **Frontend**: Bootstrap 5, Font Awesome, vanilla JavaScript
-   **Database**: MySQL/SQLite
-   **File Storage**: Laravel Storage (public disk)
-   **Styling**: Custom CSS with Bootstrap components

## Sample Data

The application comes with sample data including:

-   6 gallery items with placeholder image paths
-   12 menu items across different categories (Appetizer, Main Course, Pasta, Dessert, Beverage)
-   8 customer reviews (some approved, some pending)

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
