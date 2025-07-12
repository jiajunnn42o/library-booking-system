# Library Booking System  
## Iteration 3 – Admin Panel & Book Management

In this iteration, an **admin role** is introduced to manage the system via a dedicated dashboard. The admin can add, delete, and view all books and reservations. This separates user and admin privileges effectively and prepares the system for real-world scalability.

---

### Features Implemented

- **Admin Authentication & Role Control**
  - Admin is redirected to `admin_dashboard.php` upon login
  - Role is determined by the `role` column in the `users` table

- **Admin Dashboard (`admin_dashboard.php`)**
  - Provides navigation to:
    - `Manage Books`
    - `View All Reservations`
    - `Logout`

- **Manage Books (`manage_books.php`)**
  - View all books in a styled table
  - Add new book (with cover image)
  - Delete existing book
  - Form includes:
    - Title, Author, Subject, Cover Image Upload
  - Reuses `book_list.css` for consistent UI
  - Floating success message after book added or deleted

- **View All Reservations (`view_reservation.php`)**
  - Shows a full table of all borrow records
  - Columns: Book Title, Borrower Name, Borrow Date, Due Date, Return Date, Status

---

### File Structure & Updates (Since Iteration 2)
LIBRARY-BOOKING-SYSTEM/
├── backend/
│   ├── add_book.php            # Admin: Adds new book to the system
│   ├── delete_book.php         # Admin: Deletes book from the system
│   ├── db_connect.php          # Handles database connection
│   ├── login.php               # Processes user/admin login
│   ├── logout.php              # Handles session logout
│   ├── register.php            # Processes new user registration
│   ├── reserve.php             # Handles book reservation
│   └── return_book.php         # Handles return logic for borrowed books
│
├── database/
│   └── schema.sql              # Updated schema with users, books, borrow_records
│
├── frontend/
│   ├── books/                  # Folder for uploaded book cover images
│   ├── icons/
│   │   ├── books.jpg           # Book icon
│   │   ├── history.jpg         # Borrowing history icon
│   │   └── logout.jpg          # Logout icon
│   │
│   ├── admin_dashboard.php     # Admin panel homepage
│   ├── book_list.php           # Displays available books to users
│   ├── book_list.css           # Styles for book listing pages
│   ├── dashboard.css           # Styling for dashboard layout
│   ├── email_exist.html        # Page shown if email is already registered
│   ├── index.php               # Default landing page after login
│   ├── login.html              # User/Admin login form
│   ├── login_fail.html         # Login failure notification page
│   ├── manage_books.php        # Admin CRUD page for managing books
│   ├── my_bookings.php         # User's borrow history with return button
│   ├── register.html           # New user registration form
│   ├── library-bg.jpg          # Background image for UI
│   ├── school-logo.png         # School/brand logo
│   └── style.css               # Global CSS for all pages
│
├── .gitattributes              # Git configuration for text encoding
└── README.md                   # Project documentation and instructions

---

### To test
1. Go to register.html and register a new account
2. Login via login.html
3. If successful, homepage loads with buttons and welcome message
4. Logout and verify session is cleared

---

### Next Iteration Preview
- Add book editing functionality in the admin dashboard
- Implement overdue status handling
- Track total borrow count per book
- Enable book search or filtering by subject
- Enhance responsive UI styling