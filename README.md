# 🚗 Car Rental System

A modern, full-featured car rental management system built with Laravel 12, featuring a responsive frontend with Tailwind CSS and Alpine.js.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4+-38B2AC.svg)
![Vite](https://img.shields.io/badge/Vite-6.2+-646CFF.svg)

## 📋 Table of Contents

- [Features](#-features)
- [Screenshots](#-screenshots)
- [Technology Stack](#-technology-stack)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Structure](#-database-structure)
- [Usage](#-usage)
- [API Endpoints](#-api-endpoints)
- [Admin Panel](#-admin-panel)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

### 🎯 Core Features
- **Car Management**: Add, edit, and delete rental cars with detailed information
- **Booking System**: Complete booking workflow with client information and payment calculation
- **User Authentication**: Secure login/registration system with Laravel Breeze
- **Admin Dashboard**: Comprehensive admin panel for managing all aspects of the system
- **Blog System**: Content management for car rental tips and news
- **Contact System**: Customer inquiry management with message tracking
- **Responsive Design**: Mobile-friendly interface built with Tailwind CSS

### 🔧 Admin Features
- **Car Inventory Management**: Full CRUD operations for rental vehicles
- **Client Management**: View and manage all booking clients
- **Booking Status Management**: Track and update booking statuses
- **Message Management**: Handle customer inquiries and support requests
- **Blog Content Management**: Create and manage blog posts
- **Dashboard Analytics**: Overview of system statistics and recent activities

### 👥 User Features
- **Browse Rental Cars**: View available vehicles with detailed information
- **Make Bookings**: Complete booking process with personal information
- **Contact Support**: Send messages to the rental company
- **Read Blog Posts**: Access helpful content and rental tips
- **Responsive Interface**: Seamless experience across all devices

## 🖼️ Screenshots

*[Screenshots would be added here showing the main pages, admin dashboard, and booking interface]*

## 🛠️ Technology Stack

### Backend
- **Laravel 12.x** - PHP web application framework
- **PHP 8.2+** - Server-side programming language
- **MySQL/SQLite** - Database management system
- **Laravel Breeze** - Authentication scaffolding

### Frontend
- **Tailwind CSS 3.4+** - Utility-first CSS framework
- **Alpine.js 3.4+** - Lightweight JavaScript framework
- **Vite 6.2+** - Build tool and development server
- **Axios** - HTTP client for API requests

### Development Tools
- **Laravel Pint** - PHP code style fixer
- **Pest** - PHP testing framework
- **Laravel Sail** - Docker development environment
- **Laravel Pail** - Log viewer

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or SQLite database

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd car-rental-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=car_rental_system
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

### Quick Development Setup
For a complete development environment with all services running:
```bash
composer run dev
```

This command will start:
- Laravel development server
- Queue listener
- Log viewer
- Vite development server

## ⚙️ Configuration

### Environment Variables
Key environment variables to configure:

```env
APP_NAME="Car Rental System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_rental_system
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### File Permissions
Ensure proper permissions for storage and cache directories:
```bash
chmod -R 775 storage bootstrap/cache
```

## 🗄️ Database Structure

### Core Tables

#### Users Table
- `id` - Primary key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `is_admin` - Admin status flag
- `email_verified_at` - Email verification timestamp
- `created_at`, `updated_at` - Timestamps

#### Cars Table
- `id` - Primary key
- `name` - Car name/brand
- `model` - Car model
- `rent_price` - Daily rental price (decimal)
- `description` - Car description
- `image_link` - Path to car image
- `owner` - Car owner information
- `created_at`, `updated_at` - Timestamps

#### Bookings Table
- `id` - Primary key
- `car_id` - Foreign key to cars table
- `client_name` - Client's full name
- `cnic` - Client's CNIC (15 characters)
- `gender` - Client's gender (male/female/other)
- `age` - Client's age
- `days` - Number of rental days
- `driving_license` - License availability (boolean)
- `total_amount` - Calculated total cost
- `status` - Booking status (pending/confirmed/cancelled)
- `created_at`, `updated_at` - Timestamps

#### Messages Table
- `id` - Primary key
- `sender_name` - Sender's name
- `sender_contact` - Sender's contact information
- `sender_gmail` - Sender's email
- `message` - Message content
- `created_at`, `updated_at` - Timestamps

#### Blogs Table
- `id` - Primary key
- `title` - Blog post title
- `main_pic` - Featured image filename
- `content` - Blog post content
- `written_by` - Author name (defaults to 'Admin')
- `created_at`, `updated_at` - Timestamps

## 📖 Usage

### For Administrators

1. **Access Admin Dashboard**
   - Login with admin credentials
   - Navigate to `/dashboard`

2. **Manage Cars**
   - Add new rental vehicles with images and pricing
   - Edit existing car information
   - Remove cars from inventory

3. **Handle Bookings**
   - View all client bookings
   - Update booking statuses
   - Manage client information

4. **Content Management**
   - Create and edit blog posts
   - Manage customer messages
   - Monitor system activity

### For Customers

1. **Browse Available Cars**
   - Visit the homepage to see featured vehicles
   - Navigate to `/Rentalcars` for complete inventory

2. **Make a Booking**
   - Select desired vehicle
   - Fill in personal information
   - Choose rental duration
   - Complete booking process

3. **Contact Support**
   - Use the contact form for inquiries
   - Send messages through the website

4. **Read Blog Content**
   - Access helpful rental tips and news
   - Stay updated with company information

## 🔌 API Endpoints

### Public Routes
```
GET  /                    - Homepage
GET  /Rentalcars         - Browse rental cars
GET  /FAQs              - Frequently asked questions
GET  /contact           - Contact page
GET  /about             - About us page
GET  /blogsPage         - Blog listing page
GET  /blogs/{id}        - Individual blog post
POST /bookings          - Create new booking
POST /send-message      - Send contact message
```

### Protected Routes (Admin)
```
GET    /dashboard              - Admin dashboard
GET    /cars                   - Car management
POST   /cars                   - Create new car
PUT    /cars/{car}            - Update car
DELETE /cars/{id}             - Delete car
GET    /clients               - Client management
DELETE /clients/{client}      - Delete client
GET    /messages              - Message management
GET    /messages/{message}    - View message
DELETE /messages/{message}    - Delete message
GET    /blogs                 - Blog management
POST   /blogs/store          - Create blog post
PUT    /blogs/{id}           - Update blog post
DELETE /blogs/{id}           - Delete blog post
```

## 🎛️ Admin Panel

### Dashboard Overview
- **Recent Bookings**: Latest client reservations
- **System Statistics**: Total cars, bookings, and messages
- **Quick Actions**: Direct links to management sections

### Car Management
- **Add New Car**: Form with image upload and pricing
- **Edit Cars**: Modify existing vehicle information
- **Delete Cars**: Remove vehicles from inventory
- **Image Management**: Handle car photos

### Client Management
- **View All Bookings**: Complete booking history
- **Client Details**: Personal information and preferences
- **Booking Status**: Track reservation states
- **Delete Records**: Remove client data

### Message Center
- **Inbox**: All customer inquiries
- **Message Details**: Full conversation history
- **Response Management**: Handle customer support
- **Archive**: Organize message history

### Blog Management
- **Create Posts**: Rich text editor for content
- **Image Upload**: Featured images for posts
- **Edit Content**: Update existing articles
- **Publish/Unpublish**: Control post visibility

## 🤝 Contributing

We welcome contributions to improve the Car Rental System! Please follow these steps:

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Make your changes**
4. **Run tests**
   ```bash
   composer run test
   ```
5. **Commit your changes**
   ```bash
   git commit -m 'Add amazing feature'
   ```
6. **Push to the branch**
   ```bash
   git push origin feature/amazing-feature
   ```
7. **Open a Pull Request**

### Development Guidelines
- Follow Laravel coding standards
- Write tests for new features
- Update documentation as needed
- Ensure responsive design compatibility
- Test across different browsers

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [FAQs page](/FAQs)
2. Review the Laravel documentation
3. Open an issue on GitHub
4. Contact the development team

## 🔄 Version History

- **v1.0.0** - Initial release with core car rental functionality
- **v1.1.0** - Added blog system and improved admin panel
- **v1.2.0** - Enhanced booking system and user interface
- **v1.3.0** - Added message management and contact system

---

**Built with ❤️ using Laravel and modern web technologies**
