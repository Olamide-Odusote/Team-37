# OmniCart - Implementation Checklist

## Business Identity
- [x] **Business Name**: OmniCart
- [x] **Vision & Scope**: Tech-focused e-commerce platform selling computers, laptops, peripherals, networking equipment, and accessories
- [x] **Branding**: Blue/white colour scheme (#0055C0), consistent fonts (Poppins), professional layout
- [x] **Product Line**: 5+ categories with 5+ products each:
  - Computers
  - Laptops
  - Peripherals
  - Networking Equipment
  - Accessories
- [x] **Target Audience**: Students, professionals, tech enthusiasts, businesses

---

## Core Pages & Features

### Public Pages
- [x] **Home Page** - Product categories display, hero section
- [x] **About Us Page** - Business vision and information
- [x] **Contact Page** - Contact form, business details, form submission to admin
- [x] **Products Page** - Product listing with:
  - [x] Product search by name
  - [x] Filter by category
  - [x] Filter by price range (£0-£10, £10-£25, £25-£50, £50-£100, £100+)
  - [x] Stock availability display
  - [x] Disable "Add to Basket" when out of stock
  - [x] Product images, prices, descriptions
- [x] **Product Detail Page** - Full product info, stock status, ratings
- [x] **Category Pages** - Display products filtered by category
- [x] **Basket Page** - View current items, adjust quantities, remove items
- [x] **Checkout Page** - Payment form, address collection, currency selection (GBP/USD)
- [x] **Order Success Page** - Confirmation with order details and links to orders/shopping
- [x] **Previous Orders Page** - View order history, status, items
- [x] **Order Detail Page** - View single order, items, return requests
- [x] **Account/Profile Page** - User information, links to orders and profile settings
- [ ] **Admin Orders Page** - View all orders, filter, mark shipped
- [x] **Admin Inventory Dashboard** - Stock levels, restock modal, delete inventory

---

## Authentication & User Management

### Customer Features
- [x] **Sign Up** - Create customer account with email/password
- [x] **Sign In** - Log in with email/password
- [x] **Password Change** - Change password after login
- [x] **Password Reset** - Reset forgotten password (route defined, form pending)
- [x] **Profile Management** - View/update personal information
- [x] **Two-stage Auth**: Customer and Admin authentication guards

### Admin Features
- [x] **Admin Sign Up** - Create admin account
- [x] **Admin Sign In** - Admin login with separate guard
- [x] **Admin Password Change** - Change password after login
- [x] **Customer Data Access** - Admins can view customer details

---

## Shopping Features

### Basket Management
- [x] Add items to basket
- [x] Remove items from basket
- [x] Adjust quantity (increment/decrement)
- [x] Stock validation (prevent adding beyond available inventory)
- [x] View basket with all items and subtotal
- [x] Clear basket on order placement

### Checkout
- [x] Display order summary
- [x] Collect payment details (card number, CVV, expiry, cardholder name)
- [x] Collect shipping address (street, city, postal code, country)
- [x] Currency selection (GBP/USD with dynamic conversion)
- [x] Client-side validation of all fields
- [x] Store masked card number (show last 4 digits only)
- [x] Calculate and display order total
- [ ] Support multiple payment methods (currently card only)

### Orders
- [x] Create orders with FinalOrder + OrderItem records
- [x] Save customer address and payment info with orders
- [x] Clear basket after successful order
- [x] Send order confirmation email
- [x] View previous orders with status
- [x] View individual order details
- [x] Track order status (pending, shipped, delivered, returned)

---

## Product & Inventory Management

### Product Display
- [x] Product images displayed on all product pages
- [x] Price display with currency formatting
- [x] Descriptions shown on product pages
- [x] Stock level display (units available or "Out of stock")
- [x] Stock status validation prevents overselling
- [x] Product categories with clickable navigation

### Inventory System
- [x] Inventory records linked to products
- [x] Stock quantity tracking
- [x] Stock threshold configuration
- [x] Automatic decrement on order placement
- [x] Inventory logs for all stock changes
- [x] Admin can restock items via dashboard

### Admin Inventory Dashboard
- [x] View all product inventory
- [x] Display stock levels and thresholds
- [x] Stock alerts (low stock highlighting)
- [x] Restock modal with quantity input
- [x] Delete inventory entries
- [x] View inventory logs
- [ ] Edit inventory entries (partially implemented)
- [ ] Generate real-time reports (stub implemented)
- [ ] Export reports as CSV/PDF

---

## Return Management

### Customer Features
- [x] Request return for purchased items
- [x] Provide return reason
- [x] View return status on orders page
- [ ] Track return progress

### Admin Features
- [x] View return requests
- [ ] Approve/reject returns
- [ ] Process refunds
- [ ] Update return status

---

## Product Reviews & Ratings

### Features
- [ ] Add product reviews (model exists, UI pending)
- [ ] Rate products (1-5 stars)
- [ ] Display average rating on product page
- [ ] Display individual reviews
- [ ] Admin moderation of reviews

---

## Email & Notifications

### Implemented
- [x] Order confirmation email sent after purchase
- [x] Email configuration (from address: omnicart37@gmail.com)
- [x] Order details included in email
- [ ] Low stock alerts via email
- [ ] Return status notifications
- [ ] Shipment tracking emails

---

## Data Security & Validation

### Implemented
- [x] CSRF protection on all forms
- [x] Input validation on checkout form
- [x] Card number masking (only last 4 digits stored)
- [x] Password hashing on user creation
- [x] Auth middleware on protected routes
- [x] Admin-only routes protected with auth:admin guard
- [ ] Rate limiting on authentication
- [ ] Input sanitization for XSS prevention
- [ ] SQL injection prevention (using ORM)
- [ ] HTTPS enforcement (pending deployment)

---

## Admin Features

- [x] Admin authentication system
- [x] Admin inventory dashboard
- [x] Restock functionality with logging
- [x] Delete inventory entries
- [x] View customer orders
- [ ] Update order status (route exists, UI pending)
- [ ] Process shipments
- [ ] View customer details
- [ ] View inventory logs
- [ ] Generate reports
- [ ] Customer management UI

---

## Database Schema

- [x] Users table (customer login)
- [x] Admins table (admin login with legacy naming)
- [x] Customers table (customer profiles)
- [x] Products table
- [x] ProductCategories table (5+ categories)
- [x] Inventories table (stock tracking)
- [x] InventoryLogs table (stock change history)
- [x] Baskets table (customer shopping carts)
- [x] BasketProducts table (items in baskets)
- [x] FinalOrders table (completed orders)
- [x] OrderItems table (items in orders)
- [x] CustomerAddresses table (shipping addresses)
- [x] CustomerPayments table (payment info)
- [x] ReturnRequests table (returns)
- [x] Feedback table (product reviews - not yet used)

---

## Testing & Deployment

- [ ] Unit tests for models
- [ ] Feature tests for checkout flow
- [ ] Feature tests for inventory management
- [ ] Feature tests for authentication
- [ ] Integration tests for order processing
- [ ] Automated test suite
- [ ] CI/CD pipeline setup
- [ ] Production hosting setup
- [ ] HTTPS/SSL configuration
- [ ] Database backups
- [ ] Monitoring & uptime alerts
- [ ] Performance optimization
- [ ] Load testing

---

## Bonus Features

### Customer Chat Bot
- [ ] Product search chatbot
- [ ] Stock availability queries
- [ ] Order tracking via chat
- [ ] FAQ responses
- [ ] Human escalation support

### Additional Enhancements
- [ ] Wishlist functionality
- [ ] Product recommendations
- [ ] Customer reviews/testimonials
- [ ] Order tracking with real-time updates
- [ ] Gift cards
- [ ] Bulk order functionality
- [ ] Multi-language support
- [ ] Mobile app

---

## Known Issues & Improvements Needed

1. **Orders Page**: Currently shows empty initially; needs order data seeding for demo
2. **Admin Reports**: Stub implementation; needs CSV/PDF export functionality
3. **Product Reviews**: Model exists but UI not fully implemented
4. **Return Processing**: Admin workflow incomplete (approve/reject/refund)
5. **Low Stock Alerts**: Logic present but UI alerts could be more prominent
6. **Payment Processing**: Currently demo-only; needs real payment gateway integration
7. **Email Sending**: Configured for local log driver; needs SMTP setup for production
8. **Admin Dashboard**: Edit products feature needs completion
9. **Search**: Basic category/price filters; could add advanced search with pagination
10. **Performance**: No caching; could implement Redis for cart/inventory caching

---

## Summary

**Implemented**: ~70% of core requirements
**Tested**: Basic functionality works end-to-end (auth, shopping, orders)
**Pending**: Admin order management, product reviews, reports, testing suite, deployment

**Next Priority Tasks**:
1. Complete order management admin UI
2. Add product reviews implementation
3. Seed demo data for orders/returns
4. Set up automated tests
5. Prepare for production deployment
