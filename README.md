# Store Example

This is a simple e-commerce store project built with Laravel, demonstrating core functionalities of an online shopping system.

## Features

- **User Authentication**: Secure user registration and login.
- **Product Management**: Add, update, and delete products with images and descriptions.
- **Categories & Filters**: Organize products into categories for easy navigation.
- **Shopping Cart**: Add and remove products from the cart.
- **Checkout Process**: Place orders and complete transactions.
- **Order Management**: Users can view order history and details.
- **Admin Panel**: Manage products, orders, and users.
- **Dynamic Pricing**: Display product prices with potential discounts.
- **Search & Pagination**: Find products easily with search functionality.
- **Responsive Design**: Optimized for different devices.

## Installation

1. Clone the repository:
   ```bash
   git clone <repository_url>
   cd store-example
   ```

2. Install dependencies:
   ```bash
   composer install
   npm install && npm run dev
   ```

3. Configure the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up the database:
   ```bash
   php artisan migrate --seed
   ```

5. Start the development server:
   ```bash
   php artisan serve
   ```

## Technologies Used

- Laravel
- MySQL
- Blade Templates
- Bootstrap/Tailwind (Frontend)
- JavaScript (for interactive features)

## License

This project is open-source and available for modification.

****

## Developed by Ahmed Gamal
