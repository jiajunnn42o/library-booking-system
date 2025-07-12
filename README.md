# Library Booking System
## Iteration 2 – Book Reservation & History Page

This iteration focuses on enabling authenticated users to browse available books, reserve a book (only once), and view their borrowing history. It also includes visual improvements such as cover images, floating toast messages, and page layout consistency.

---

### Features Implemented

- Book catalog grouped by subject
- Book cover display using dynamic image paths
- One-click book reservation (1 user per book)
- Prevent duplicate reservation by the same user
- Prevent reservation of already borrowed books
- Borrowing history (my_bookings.php)
  - Displays borrow date, due date (5 days), return date
  - Allows return of books (status changes to `returned`)
- Floating toast-style alerts for:
  - Reservation success
  - Already reserved
  - Book unavailable
  - Return success
- Styled interface (buttons, tables, background, fonts)

---

### File Structure & Additions (Since Iteration 1)
LIBRARY-BOOKING-SYSTEM/
├── backend/
│   ├── db_connect.php        # Handles database connection
│   ├── login.php             # Processes user login
│   ├── logout.php            # Handles user logout
│   ├── register.php          # Processes user registration
│   ├── reserve.php           # Handles book reservation logic
│   └── return_book.php       # (Optional future) Handles returning of borrowed books
│
├── database/
│   └── schema.sql            # Database details
│
├── frontend/
│   ├── books/              # Contains book cover images
│   │   └── [*.jpg]           # Each book image (e.g. book1.jpg, book2.jpg, etc.)
│   │
│   ├── icons/
│   │   ├── books.jpg         # Icon for books
│   │   ├── history.jpg       # Icon for history
│   │   └── logout.jpg        # Icon for logout
│   │
│   ├── book_list.php         # Displays available books grouped by subject
│   ├── my_bookings.php       # Displays user's borrow history and return option
│   ├── book_list.css         # Styling for all book-related pages
│   ├── dashboard.css         # Styles for the dashboard
│   ├── email_exist.html      # Page shown if email is already registered
│   ├── index.php             # Homepage after login
│   ├── login.html            # User login form
│   ├── login_fail.html       # Page for failed login attempt
│   ├── register.html         # User registration form
│   ├── library-bg.jpg        # Background image
│   ├── school-logo.png       # School logo
│   └── style.css             # General global styling
│
├── .gitattributes            # Git configuration file
└── README.md                 # Project overview and update logs

---

### How to Use

- Log in with a valid user account (from Iteration 1)
- Browse books via book_list.php
- Click Reserve to borrow a book (limit: 1 reservation per book)
- Visit my_bookings.php to view borrowed books
- Use the Return button to return books
- Feedback will be shown via toast messages

---

### Next Iteration (Preview)
- Admin dashboard with user role-based access
- View all reservations (admin only)
- Manage books (add, edit, delete)
- Upload new book cover via form