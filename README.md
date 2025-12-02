# E-Commerce Project Summary

This document outlines the features and implementations completed in the E-Commerce project.

## 1. Authentication & User Management
- **System**: Standard Laravel Authentication (Login, Register, Password Reset).
- **Roles**:
  - **Admin**: Access to the backend dashboard.
  - **User**: Access to the frontend shop, cart, and checkout.

## 2. Admin Panel
The admin panel allows management of the store's core data.

### Brands
- CRUD operations (Create, Read, Update, Delete)
- Image upload support

### Categories
- CRUD operations
- Image upload support

### Products
- CRUD operations
- Support for multiple images (Gallery)
- Attributes: Colors and Sizes (Many-to-Many relationship)
- Pricing: Regular and Sale prices
- Stock management (Quantity, Stock Status)

### Coupons
- CRUD operations
- Types: Fixed and Percent
- Expiry date and Cart Value validation

### Orders
- View list of orders

### Slides (Home Slider)
- CRUD operations
- Image upload with validation
- Search functionality
- Status management (Active/Inactive)

## 3. Frontend (User Shop)

### Home Page
- Landing page showcasing categories, products, and slides.

### Shop Page
- Lists all products
- Pagination support
- Individual Product Details Page:
  - Full product info
  - Image gallery
  - Related products

### Wishlist
- Add products to wishlist
- Move products from wishlist to cart
- Remove items

### Shopping Cart
- Add products with quantity
- Update item quantities
- Remove items
- Clear entire cart
- **Coupons**:
  - Apply and remove coupons
  - Validation (expiry date, minimum cart value)
- Dynamic totals calculation:
  - Subtotal, Discount, VAT, Total

### Checkout
- Multi-step checkout UI
- Shipping Address form (auto-filled for users with a saved default address)
- Order Summary display
- Payment Methods:
  - Cash on Delivery (COD)
  - Card
  - PayPal
- **Order Placement**:
  - Saves Order details
  - Saves Order Items
  - Records Transaction (defaulting to 'pending' for COD)
  - Clears Cart and Session data upon success

## 5. Advanced User Management & Security
### Role-Based Access Control (RBAC)
- **Roles**:
  - **User (USR)**: Standard customer access.
  - **Admin (ADM)**: Backend management access.
  - **Owner (OWN)**: Super-admin with exclusive rights to manage other admins and users.
- **Middleware**: Custom `AuthAdmin` and `AuthOwner` middleware to secure routes.
- **Protection**:
  - Owners cannot demote themselves (Self-demotion prevention).
  - User details (Name, Email, Mobile) are read-only in the admin panel to prevent accidental edits.

### User Blocking System
- **Functionality**:
  - Admins/Owners can block users with a specific reason.
  - Blocked users are immediately logged out and prevented from logging in.
  - Login attempt displays a custom error message with support contact info.
- **Database**:
  - `is_blocked` flag in `users` table.
  - `blocked_users` table tracks blocker ID, blocked user ID, and reason.
- **Views**:
  - Dedicated "Blocked Users" list with "Unblock" functionality.

## 6. UI/UX Improvements
- **Notifications**: Integrated **SweetAlert2** for beautiful, interactive success and error popups (replacing standard flash messages).
- **Dashboard Redirection**: Smart redirection after login based on user role (Admin/Owner -> Dashboard, User -> Home).

## 7. Database Schema

Key tables implemented:

- `users` (extended with `utype`, `is_blocked`)
- `blocked_users`
- `brands`, `categories`, `products`
- `product_images`
- `colors`, `sizes`, `product_color`, `product_size`
- `coupons`
- `orders`
- `order_items`
- `transactions`
- `addresses`
- `slides`

## 8. Key Technologies
- **Framework**: Laravel 11
- **Templating**: Blade
- **Cart Library**: `surfsidemedia/shoppingcart`
- **Database**: MySQL
- **Frontend**: Bootstrap / Custom CSS
- **Alerts**: SweetAlert2
