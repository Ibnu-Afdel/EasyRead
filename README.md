# ReadEasy - Digital Library Management System

ReadEasy is a modern digital library management system built with Laravel and Livewire. It allows users to browse, read, and manage books from the Gutenberg Project API, with features for librarians and administrators to manage the collection.

## Features

- 📚 Browse books from Gutenberg Project API
- 🔍 search functionality
- 👥 User role management (Owner, Admin, Librarian, User)
- 📖 Read books online in multiple formats
- 💾 Download books in various formats
- 📱 Responsive design with Tailwind CSS
- 🔐 Authentication and authorization
- 📊 User reading history tracking

## Tech Stack

- **Backend**: Laravel 10.x
- **Frontend**: Livewire, Tailwind CSS
- **Database**: PostgreSQL
- **Authentication**: Laravel Sanctum
- **Deployment**: Heroku


## Setup Instructions

1. Clone the repository:
```bash
git clone https://github.com/yourusername/easyread.git
cd easyread
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=readeasy
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Run migrations and seeders:
```bash
php artisan migrate --seed
```

6. Start the development server:
```bash
php artisan serve
npm run dev
```


## User Roles

- **Owner**: Full system access
- **Admin**: Book management and user oversight
- **Librarian**: Book management and user assistance
- **User**: Basic book access and personal library

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Project Gutenberg](https://www.gutenberg.org/) for the book database
- [Laravel](https://laravel.com/) for the amazing framework
- [Livewire](https://livewire.laravel.com/) for the dynamic UI components
- [Tailwind CSS](https://tailwindcss.com/) for the styling
