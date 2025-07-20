# Library Booking System (Final Version)

A PHP-based web application that allows users to reserve and manage library books. The system includes user and admin functionalities, reservation tracking, return handling, and overdue book detection.

---

### Version

- Current Release: **v1.0.0**
- Tag History:
  - `v1.0`: Iteration 1 completed
  - `v2.0`: Iteration 2 completed
  - `v3.0`: Iteration 3 completed
  - `v4.0`: Iteration 4 completed
  - `v1.0.0`: Final version tag

---

### Features

#### User Functions
- Register and login system
- View available books categorized by subject
- Reserve books (one copy per user)
- View borrowing history with:
  - Borrow date
  - Due date (5 days after reservation)
  - Return date
  - **Overdue detection** (automatically updates status)
- Return book feature

#### Admin Functions
- Login to admin dashboard
- Add new books (including uploading cover image)
- Delete books
- Edit book info and update cover
- View all reservation records by all users (with overdue status)

---

### Installation

1. Clone this repo and place it in your XAMPP `htdocs` folder:
   ```bash
   git clone https://github.com/yourusername/library-booking-system.git
2. Import the schema.sql into your MySQL using phpMyAdmin.
3. Configure database in backend/db_connect.php:
`$conn = new mysqli("localhost", "root", "", "library");`
4. Run your app via: http://localhost/library-booking-system/frontend/login.html

---

### Database Schema Highlights

- `users` – stores student/admin info and roles
- `books` – stores book details and cover path
- `borrow_records` – tracks each borrow event with status, return, and due dates

---

### Tested Browsers
- Chrome
- Edge
- Firefox

---

### Contributors
- Wong Jia Jun
- Duncan Lim Hao Yang
- Govinash A/L Murugan 
- Kesn Kanagasaba 