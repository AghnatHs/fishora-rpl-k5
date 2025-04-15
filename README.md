# Fishora - RPL K5 P2

## Fishora - Marketplace Ikan Hias 

### Anggota Kelompok

Kelompok 5 P2:

-   Quina Rizky Dae Yuena Siregar : G6401231013
-   Fauzan Arif Tricahya : G6401231040
-   Aghnat Hasya Sayyidina : G6401231074
-   Husni Abdillah : G6401231097

### Requirements

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### Installation

```bash
# Clone the repository
git clone https://github.com/AghnatHs/fishora-rpl-k5.git

cd fishora-rpl-k5

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run dev

# Copy .env and set your config
cp .env.example .env
# set DB, set Admin Seeder credentials in .env yourself

# Generate app key
php artisan key:generate

# Configure your DB in .env then run:
php artisan migrate

# Seed the db
php artisan db:seed

# Run in development
php artisan serve
npm run dev

http://127.0.0.1:8000/