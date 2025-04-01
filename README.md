# Laravel Roll Game

RollGame is a small web application built with Laravel 12 where users can register and receive a unique game link.
The game is centered around a ROLL button that generates a random number between 1 and 1000. If the number is even — the user wins!

## Getting Started

### Install Dependencies
```
composer install
npm install && npm run build
```

### Set Up Environment
Copy the `.env` file and generate the application key:
```
cp .env.example .env
php artisan key:generate
```

## Serve the Application
```
npm run dev
```
or
```
php artisan serve
```
