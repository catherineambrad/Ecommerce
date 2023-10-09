# Laravel Backend README

## Project Overview

This Laravel backend serves as the core of our e-commerce platform, handling server-side logic, data storage, and providing API endpoints for our React.js frontend. It includes features such as user authentication, product management, and order processing.

## Table of Contents

1. [Project Structure](#project-structure)
2. [Database Schema](#database-schema)
3. [API Routes](#api-routes)
4. [Getting Started](#getting-started)
    - [Installation](#installation)
    - [Configuration](#configuration)
5. [Contributing](#contributing)
6. [License](#license)
7. [Acknowledgments](#acknowledgments)

## Project Structure

### Folders and Files

-   `app/`: Contains the application's core logic and models.
-   `routes/`: Contains route definitions.
-   `database/`: Stores migrations and seeders for database management.
-   `storage/`: Image is Uploaded.
-   `actions/`: Actions to be executed when creating or updating database actions.

## Database Schema

### Tables

-   `users`: Stores user information.
-   `products`: Contains product details.
-   `categories`: Manages product categories.

### Relationships

-   Define the relationships between tables here.

## API Routes

List and briefly explain the API routes available in your Laravel backend. Include endpoints for user authentication, product listing, product details, order management, and any other significant features.

-   `POST /api/auth/register`: Register a new user.
-   `POST /api/auth/login`: Authenticate and log in a user.
-   `GET /api/products`: Retrieve a list of products.
-   `GET /api/products/{id}`: Retrieve product details by ID.
-   `POST /api/orders`: Create a new order.

## Getting Started

### Installation

1. Clone the repository:

    ```bash
    git clone ABDALLAH-ATGUIRI/e-commerce-laravel
    ```

2. Enter the Project directory

    ```
    cd e-commerce-laravel
    ```

3. Install PHP dependencies using Composer:

    ```
    composer install
    ```

### Configuration

1. Configure the .env file with your database credentials and other necessary environment variables.

2. Run database migrations and seed data if needed using:

    ```
    php artisan migrate --seed
    ```

3. Start the Laravel development server:

    ```
    php artisan serve
    ```


