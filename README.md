# E-Commerce Project Summary

This document outlines the detailed features and implementations completed in the E-Commerce project, covering both the Admin Panel and the User Shop.

## 1. Authentication & User Management
- **System**: Standard Laravel Authentication (Login, Register, Password Reset).
- **Roles**:
  - **User**: Access to the frontend shop, cart, wishlist, and checkout.
  - **Admin**: Access to the backend dashboard to manage the store.
  - **Owner**: Super-admin with exclusive rights to manage other admins and users.

## 2. Admin Panel
The admin panel allows comprehensive management of the store's core data and settings.

### Product & Inventory Management
- **Brands**: Create, update, delete, and search for brands with image upload support.
- **Categories**: Manage product categories with images.
- **Products**:
  - Full CRUD operations.
  - Multiple image gallery support.
  - Attributes: Colors and Sizes.
  - Pricing: Regular and Sale prices.
  - Stock Management: Quantity and Stock Status.
- **Coupons**:
  - Create fixed or percentage-based coupons.
  - Set expiry dates and minimum cart values.

### Order Management
- **Orders**: View order lists, details (items, address, totals), and update order status (Delivered, Canceled, Processing).

### Content & Display Management
- **Slides (Home Slider)**: Manage homepage slider images, titles, and links with active/inactive status.
- **Settings**: Manage site contact information (Address, Email, Phone) and social media links displayed in the footer.

### User & Support Management
- **Users**:
  - View user list.
  - **Blocking System**: Block users to prevent login, with a specific reason.
  - **Owner Protection**: Prevents the Owner from being demoted or blocked.
- **Contacts**: View and reply to messages sent via the contact form.
- **Support Tickets**: Track and manage support tickets (Open/Closed status).
- **Task Board**: Internal to-do list for admins to track tasks (Todo, In Progress, Done).
- **Notifications**: System notifications for admins to stay updated on important events.

## 3. Frontend (User Shop)

### Browsing & Display
- **Home Page**: Features the slider, latest products, and featured categories.
- **Shop Page**: Lists all products with pagination.
- **Product Details**: Full product specifications, image gallery, related products, and color/size selection.

### Cart & Wishlist
- **Shopping Cart**:
  - Add items, update quantities, remove items.
  - Apply coupons with dynamic calculation of Subtotal, Discount, Tax, and Total.
- **Wishlist**: Save products for later, with the ability to move them to the cart.

### Checkout
- Multi-step checkout interface.
- **Addresses**: Select saved addresses or add a new one.
- **Payment Methods**: Cash on Delivery (COD), Card, PayPal.
- **Order Summary**: Final review of items and costs before placement.

### User Dashboard
- **Orders**: Track order history, cancel orders, or request item returns.
- **Addresses**: Manage shipping addresses (Create, Edit, Delete).
- **Account Details**: Update name and password.

## 4. UI/UX Improvements
- **Interactive Alerts**: Integrated **SweetAlert2** for beautiful success and error popups.
- **Smart Redirection**: Automatically redirects users after login based on their role (Admin to Dashboard, User to Home).
- **Search**: Header search bar for products and internal search in the admin panel.

## 5. Database Schema
Key tables implemented:
- `users`: Extended with `utype` (role) and `is_blocked` fields.
- `products`, `categories`, `brands`: Core store data.
- `product_images`, `product_attributes`: Product details.
- `orders`, `order_items`, `transactions`: Sales management.
- `coupons`: Discount system.
- `slides`: Homepage slider.
- `contacts`, `tickets`: Support and communication.
- `tasks`: Admin task management.
- `settings`: General site settings.
- `addresses`: User shipping addresses.

## 6. Key Technologies
- **Framework**: Laravel 11
- **Frontend**: Blade Templates, Bootstrap, Custom CSS
- **Database**: MySQL
- **Libraries**:
  - `surfsidemedia/shoppingcart` (Cart management)
  - `sweetalert2` (Notifications)
