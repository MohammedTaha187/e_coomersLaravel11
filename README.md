# Surface E-Commerce Marketplace 🛒

A modern, high-performance e-commerce platform built with **Laravel 11**, **Blade**, and **Tailwind CSS**. This project provides a full-featured shopping experience with a robust administration panel for managing products, orders, and users.

---

## 🚀 Key Features

### 👤 Customer Experience
- **Product Discovery**: Browse by categories and brands with smooth navigation.
- **Dynamic Shopping Cart**: Real-time cart management using `Shoppingcart` package.
- **Wishlist**: Save favorite items for later.
- **Advanced Checkout**: Multi-step checkout process with address management.
- **Order Tracking**: Comprehensive order history and status tracking for users.
- **Responsive Design**: Fully optimized for mobile, tablet, and desktop views.

### 🛠 Administrative Tools
- **Rich Dashboard**: Real-time sales statistics and order overviews.
- **Product Management**: Full CRUD for products, images, categories, and brands.
- **Inventory Tracking**: Stock management (In Stock / Out of Stock) and quantity control.
- **Order Management**: Process, cancel, or mark orders as delivered.
- **Coupon System**: Create and manage discount coupons (Fixed or Percent).
- **User Management**: Monitor registered users and block/unblock accounts.
- **Support System**: Manage contact messages and support tickets.
- **Settings**: Centralized control for site branding, contact info, and social links.

---

## 🛠 Tech Stack

- **Backend**: PHP 8.4, Laravel 11
- **Frontend**: Blade, Tailwind CSS v3, Vite
- **Database**: MySQL / PostgreSQL
- **Packages**:
  - `surfsidemedia/shoppingcart`: For cart and wishlist logic.
  - `intervention/image-laravel`: For image processing.
  - `laravel/ui`: For authentication scaffolding.

---

## 📦 Installation & Setup

1. **Clone the Repository**
   ```bash
   git clone https://github.com/MohammedTaha187/e_coomersLaravel11.git
   cd e_coomersLaravel11
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   # Update your database credentials in .env
   php artisan key:generate
   ```

4. **Database Migration & Seeding**
   ```bash
   php artisan migrate --seed
   ```

5. **Run Development Server**
   ```bash
   npm run dev
   php artisan serve
   ```

---

## 🗺 Roadmap (Upcoming Features)

The following features are identified for future development:
- [ ] **Payment Integration**: Implement Stripe, PayPal, and local payment gateways.
- [ ] **Automated Emails**: Mailables for order confirmations and status updates.
- [ ] **SEO Suite**: Dynamic Meta tags and OpenGraph support for products.
- [ ] **Advanced Analytics**: Visual charts for revenue and visitor trends.
- [ ] **Social Login**: Google, Facebook, and Twitter authentication via Socialite.
- [ ] **PWA Support**: Offline capabilities and mobile "Add to Home Screen".

---

## 📄 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

Developed with ❤️ by [Mohammed Taha](https://github.com/MohammedTaha187)
