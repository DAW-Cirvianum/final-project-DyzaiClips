[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/nMSQJoxi)

# **Final Project: Build a Full-Stack Web Application**

## **Introduction**

This project consists of developing a full-stack web application using all the knowledge acquired during the course.  
The application, called **Pokémon Market**, is inspired by online trading platforms such as Cardmarket and focuses on the buying and selling of Pokémon-related products.

The project is built using **React + Vite** for the front-end and **Laravel** for the back-end, following modern development practices and ensuring a clean user experience and interface.

---

## **Goals**

- **Learn MVC (Model-View-Controller)**  
  Understand and apply the MVC architecture using Laravel by organizing the application into models, controllers, and routes.

- **Connect Front-End and Back-End**  
  Integrate a React + Vite front-end with a Laravel API back-end using HTTP requests and JSON responses.

- **Work with Databases**  
  Design and implement a relational database using Laravel migrations, models, factories, and seeders.  
  Perform full CRUD operations.

- **Modern Front-End Development**  
  Use React Router, protected routes, state management, and dynamic rendering to create a modern web application.

- **Improve Usability and Accessibility**  
  Ensure the application is easy to navigate, responsive, and accessible on desktop and mobile devices.

---

## **What You Will Create**

At the end of the project, the following has been achieved:

- A fully functional **full-stack web application**.
- Secure authentication using **Bearer Tokens (Laravel Sanctum)**.
- A relational database with multiple connected entities.
- A responsive and user-friendly interface.
- Clear documentation explaining the project structure and functionality.

---

## **Backend Project**

The back-end is implemented as a **REST API** using Laravel.

All communication between front-end and back-end is handled via HTTP requests using JSON format.  
The API supports the following HTTP methods:

- GET
- POST
- PUT
- DELETE

### **Authentication and Route Protection**

The API implements:

- Token-based authentication using **Laravel Sanctum**
- Protected routes for authenticated users
- Role-based access control (`user` and `admin`)

Public routes:
- `/api/login`
- `/api/register`

All other routes require authentication.

---

## **Database**

The database manages more than the required **7 entities**, all properly related.

### **Tables**

- users
- products
- product_values
- transactions
- boxes
- packs
- cards
- product_value_transaction

### **Relationships**

- Users can perform transactions
- Products have multiple price variations
- Transactions can include multiple product values
- Boxes contain packs, packs contain cards

All tables follow Laravel naming conventions.

---

## **Factories and Seeders**

The database is populated using factories and seeders:

- Realistic Pokémon product names
- New and used product conditions
- Used prices are always lower than new prices
- Coherent stock values
- Fake users and transactions for testing

---

## **Functionality**

### **User Role**

- Register and login
- Browse products
- Search products by name
- View product prices
- Buy products
- View purchase history

### **Admin Role**

- Create new products
- Define prices, conditions, and stock
- Update and delete products
- Access protected admin-only routes

---

## **Front-End Requirements**

### **Routing and Navigation**

- React Router used for navigation
- Protected routes for authenticated users
- Dynamic routes for product details

### **State Management**

- React hooks (`useState`, `useEffect`)
- Token and role stored in `localStorage`

### **Forms and Validation**

- Login and register forms with validation
- Product creation with server-side validation
- Search input with real-time filtering

### **Responsive Design**

- Responsive layout using CSS
- Navigation adapts to smaller screens
- Tested on desktop and mobile resolutions

---

## **Transactions**

Users can buy products through the interface.

When a purchase is made:
- A transaction is created
- Stock is reduced
- The purchase appears in the user's transaction history

---

## **Project Structure**

[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/nMSQJoxi)

# **Final Project: Build a Full-Stack Web Application**

## **Introduction**

This project consists of developing a full-stack web application using all the knowledge acquired during the course.  
The application, called **Pokémon Market**, is inspired by online trading platforms such as Cardmarket and focuses on the buying and selling of Pokémon-related products.

The project is built using **React + Vite** for the front-end and **Laravel** for the back-end, following modern development practices and ensuring a clean user experience and interface.

---

## **Goals**

- **Learn MVC (Model-View-Controller)**  
  Understand and apply the MVC architecture using Laravel by organizing the application into models, controllers, and routes.

- **Connect Front-End and Back-End**  
  Integrate a React + Vite front-end with a Laravel API back-end using HTTP requests and JSON responses.

- **Work with Databases**  
  Design and implement a relational database using Laravel migrations, models, factories, and seeders.  
  Perform full CRUD operations.

- **Modern Front-End Development**  
  Use React Router, protected routes, state management, and dynamic rendering to create a modern web application.

- **Improve Usability and Accessibility**  
  Ensure the application is easy to navigate, responsive, and accessible on desktop and mobile devices.

---

## **What You Will Create**

At the end of the project, the following has been achieved:

- A fully functional **full-stack web application**.
- Secure authentication using **Bearer Tokens (Laravel Sanctum)**.
- A relational database with multiple connected entities.
- A responsive and user-friendly interface.
- Clear documentation explaining the project structure and functionality.

---

## **Backend Project**

The back-end is implemented as a **REST API** using Laravel.

All communication between front-end and back-end is handled via HTTP requests using JSON format.  
The API supports the following HTTP methods:

- GET
- POST
- PUT
- DELETE

### **Authentication and Route Protection**

The API implements:

- Token-based authentication using **Laravel Sanctum**
- Protected routes for authenticated users
- Role-based access control (`user` and `admin`)

Public routes:
- `/api/login`
- `/api/register`

All other routes require authentication.

---

## **Database**

The database manages more than the required **7 entities**, all properly related.

### **Tables**

- users
- products
- product_values
- transactions
- boxes
- packs
- cards
- product_value_transaction

### **Relationships**

- Users can perform transactions
- Products have multiple price variations
- Transactions can include multiple product values
- Boxes contain packs, packs contain cards

All tables follow Laravel naming conventions.

---

## **Factories and Seeders**

The database is populated using factories and seeders:

- Realistic Pokémon product names
- New and used product conditions
- Used prices are always lower than new prices
- Coherent stock values
- Fake users and transactions for testing

---

## **Functionality**

### **User Role**

- Register and login
- Browse products
- Search products by name
- View product prices
- Buy products
- View purchase history

### **Admin Role**

- Create new products
- Define prices, conditions, and stock
- Update and delete products
- Access protected admin-only routes

---

## **Front-End Requirements**

### **Routing and Navigation**

- React Router used for navigation
- Protected routes for authenticated users
- Dynamic routes for product details

### **State Management**

- React hooks (`useState`, `useEffect`)
- Token and role stored in `localStorage`

### **Forms and Validation**

- Login and register forms with validation
- Product creation with server-side validation
- Search input with real-time filtering

### **Responsive Design**

- Responsive layout using CSS
- Navigation adapts to smaller screens
- Tested on desktop and mobile resolutions

---

## **Transactions**

Users can buy products through the interface.

When a purchase is made:
- A transaction is created
- Stock is reduced
- The purchase appears in the user's transaction history

---

## **Project Structure**

```bash
pokemon-market/
├── backend/ (Laravel API)
│ ├── app/
│ ├── database/
│ ├── routes/
│ └── ...
│
├── frontend/ (React + Vite)
│ ├── src/
│ │ ├── pages/
│ │ ├── auth/
│ │ ├── components/
│ │ └── api/
│ └── ...
│
└── README.md
```

---

## **Installation Instructions**

### **Backend**

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

```
### **Frontend**
```bash
npm install
npm run dev

```
