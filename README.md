# Business Listing Platform

A full-stack **Business Listing & Local Directory Platform** built with Laravel, MySQL, Tailwind CSS and JavaScript.

The platform allows users to discover businesses, browse categories and locations, view business details, reviews, services, products and other business information through a responsive directory interface.

## 🚀 Features

### Public Directory

* Business listing directory
* Business detail pages
* Category-based browsing
* Subcategory pages
* Country, State, City and Area hierarchy
* Business search and filtering
* Business services
* Business products
* Business photos/gallery
* Business opening hours
* Customer reviews
* Review reporting
* Contact and enquiry functionality
* Responsive design

### 👤 User Dashboard

* User registration and login
* User profile management
* Business management
* Add and edit businesses
* View business details
* Business notifications
* Booking management
* Profile photo support

### 🛠️ Admin Dashboard

* Admin dashboard
* Business management
* Category management
* Subcategory management
* Country management
* State management
* City management
* Area management
* Business reviews management
* Review reports
* Product management
* Product image management
* Booking management
* Enquiry management
* Offer management
* Home slider management
* Website settings
* User/profile management
* Notifications

## 🏗️ Application Modules

```text
Public Directory
├── Home
├── Businesses
├── Categories
├── Subcategories
├── Locations
├── Business Details
├── Services
├── Products
├── Reviews
├── Bookings
└── Contact / Enquiries

User Dashboard
├── Dashboard
├── Profile
├── My Businesses
├── Business Management
├── Bookings
└── Notifications

Admin Dashboard
├── Dashboard
├── Businesses
├── Categories
├── Subcategories
├── Countries
├── States
├── Cities
├── Areas
├── Reviews
├── Products
├── Bookings
├── Enquiries
├── Offers
├── Home Sliders
├── Notifications
└── Website Settings
```

## 💻 Tech Stack

| Technology   | Usage                     |
| ------------ | ------------------------- |
| PHP          | Backend development       |
| Laravel      | Full-stack web framework  |
| MySQL        | Database                  |
| Blade        | Server-side templating    |
| Tailwind CSS | UI styling                |
| JavaScript   | Frontend interactions     |
| Vite         | Asset bundling            |
| HTML5        | Page structure            |
| CSS3         | Custom responsive styling |

## 🧩 Laravel Architecture

The application follows Laravel's MVC architecture with:

* Controllers
* Eloquent Models
* Blade Views
* Database Migrations
* Seeders
* Middleware
* Routes
* Service Provider
* Authentication
* Admin/User access control

## 📂 Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
└── Providers/

database/
├── migrations/
└── seeders/

resources/
├── css/
├── js/
└── views/

routes/
└── web.php

public/
├── assets/
├── images/
└── uploads/
```

## 🔐 Authentication & Access Control

The application includes separate access areas for:

* Public visitors
* Registered users
* Administrators

Middleware is used to protect dashboard and administrative functionality.

## 🗄️ Database

The application uses MySQL with Laravel migrations for managing database structure.

Major database modules include:

* Users
* Businesses
* Categories
* Subcategories
* Countries
* States
* Cities
* Areas
* Business Hours
* Business Photos
* Business Services
* Business Reviews
* Products
* Product Images
* Bookings
* Enquiries
* Offers
* Notifications
* Website Settings

## 📱 Responsive Design

The interface is designed to work across:

* Desktop
* Laptop
* Tablet
* Mobile devices

Custom responsive CSS is used together with the project's UI components.

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/Dilshad1232/business-listing-laravel.git
```

### 2. Open the project

```bash
cd business-listing-laravel
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Install frontend dependencies

```bash
npm install
```

### 5. Create environment file

```bash
cp .env.example .env
```

On Windows, you can also copy `.env.example` to `.env` manually.

### 6. Generate application key

```bash
php artisan key:generate
```

### 7. Configure MySQL

Update the database credentials inside `.env`:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 8. Run migrations

```bash
php artisan migrate
```

### 9. Start the Laravel server

```bash
php artisan serve
```

### 10. Start the frontend development server

```bash
npm run dev
```

## 🔒 Security

Sensitive environment files such as `.env` are excluded from version control.

Do not commit:

```text
.env
/vendor
/node_modules
```

## 📸 Screenshots

Screenshots can be added here to showcase:

* Homepage
* Business directory
* Business detail page
* Category pages
* User dashboard
* Admin dashboard
* Business management
* Reviews
* Bookings

## 👨‍💻 Developer

**Dilshad Alam**

Full Stack Developer

Specializing in:

* PHP
* Laravel
* MySQL
* JavaScript
* REST APIs
* Responsive Web Development

### Portfolio

https://dilshadportfoliocom.netlify.app/

### GitHub

https://github.com/Dilshad1232

## 📌 Project Highlights

This project demonstrates practical full-stack development using Laravel and includes:

* MVC architecture
* Database-driven directory system
* Authentication and authorization
* Admin dashboard
* User dashboard
* CRUD operations
* Relational database design
* Business management
* Location hierarchy
* Reviews and reporting
* Bookings
* Product management
* Responsive frontend
* RESTful application structure

## 📄 License

This project is intended for portfolio and demonstration purposes.
