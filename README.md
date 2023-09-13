# Haresturant

This is a restaurant website created by Hafidz Muhammad Rizky XI RPL using PHP and Bootstrap.

## Features

- Responsive design
- Shopping cart
- User registration and login
- Admin panel

## Installation

1. Clone the repository.
2. Import the `database.sql` file to your MySQL server.
3. Update the database credentials in `config.php`.
4. Run the website on your local server.

## Usage

1. Register as a user or login to your account.
2. Browse the menu and add items to your cart.
3. Checkout and complete your order.

## Why use session in cart?

Session and cookies are both used to store data on the client side, but session data is stored on the server side, while cookies are stored on the client side [^1^][1]. Session data is more secure because it cannot be accessed or modified by the user [^2^][2]. In addition, session data is easier to integrate into your application because it is automatically managed by PHP [^2^][2]. 

In the context of a shopping cart, session data is used to store information about the items that have been added to the cart [^3^][3]. This information is then used to calculate the total cost of the order and to display a summary of the order to the user [^3^][3]. By using session data, you can ensure that the user cannot modify the contents of their cart outside of the current development scope [^3^][3].

