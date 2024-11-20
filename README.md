# Laravel Vue SPA Monolithic Multitenant Project

This is a single-page application (SPA) built using Laravel (backend) and Vue.js (frontend) in a monolithic architecture. It is a multitenant project where a single application supports multiple databases, each dedicated to a tenant.

## Features

- **Multitenancy**: Separate database for each tenant.
- **Authentication**: Handled using Laravel Sanctum.
- **State Management**: Pinia is used for managing application state in Vue.js.
- **Development Tools**: Laravel Mix for asset bundling, Vue Router for SPA routing.

---

## Prerequisites

Ensure the following tools are installed on your system:

- PHP 8.2 or later
- Composer
- Node.js and npm
- MySQL

---

## Setup Instructions

1. **Clone the repository:**
   ```bash
   git clone git@github.com:prazzolgautam62/multitenancy.git
   cd multitenancy
   ```

2. **Install PHP dependencies**
   ```bash
    composer install
    ```
3. **Install JavaScript dependencies**
    ```bash
    npm install
    ```
4. **Environment setup:**
    - Copy the .env.example file to .env 
    ```bash
    cp .env.example .env
    ```
    - Configure the .env file with your database credentials and other necessary environment variables.

5. **Run migrations**
    ```bash
    php artisan migrate
    ```
6. **Generate the application key**
    ```bash
    php artisan key:generate
    ```

## Running the application

1. **Start the backend server**
    ```bash
    php artisan serve
    ```
2. **Start the frontend development server**
    ```bash
    npm run dev
    ```
The application will be available at http://localhost:8000
