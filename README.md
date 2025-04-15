# 🌍🗺️📖Traveler Memory Maps

A Laravel web app that lets users map their travel memories, write notes, and upload photos. Built with Laravel, MySQL, and deployed on Microsoft Azure.

## 🛠 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yahuaiii0923/traveler-memory-map
cd traveler-memory-map

###2.Install Dependancies

# Install PHP packages (Laravel, authentication, etc.)
composer install

# Install Dependencies
npm install
npm run dev

cp .env.example .env

php artisan key:generate

###4.Set up the database
This project uses MySQL. Create a new database and update the .env file with your database credentials.
Replace {your_database_name}, {your_username}, and {your_password} with your own information.
DB_USERNAME and DB_PASSWORD are the credentials for your MySQL database, usually set as root and an empty password by default.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=traveler_map_db
DB_USERNAME=root
DB_PASSWORD=

###.Run the migrations
php artisan migrate

php artisan db:seed

###6.Serve the application
Run the following command to start the Laravel development server.

php artisan serve


## 👥 Authors

- **Siew Ya Huai* – [GitHub](https://github.com/yahuaiii0923)
- **Priyanka Achoki* – [GitHub](https://github.com/Priachoki)
```
