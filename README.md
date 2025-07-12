# Library Booking System
## Iteration 1 – User Authentication & Basic Layout

This iteration focuses on implementing secure user registration and login functionality, 
with layout styling for the login and registration pages.

### Features Implemented
- User registration with email and student ID
- Password hashing using PHP's `password_hash`
- Duplicate email/student ID detection
- Login system with session handling
- Role-based redirection (user/admin)
- Styled login and registration pages

### File Structure Definition
LIBRARY-BOOKING-SYSTEM/
├── backend/
│   ├── db_connect.php        # Handles database connection
│   ├── login.php             # Processes user login
│   ├── logout.php            # Handles user logout
│   └── register.php          # Processes user registration
│
├── database/
│   └── schema.sql            # SQL script for setting up initial database schema
│
├── frontend/
│   ├── icons/
│   │   ├── books.jpg         # Icon for books
│   │   ├── history.jpg       # Icon for borrowing history
│   │   ├── logout.jpg        # Icon for logout
│   │   ├── library-bg.jpg    # Background image
│   │   └── school-logo.png   # School logo
│   │
│   ├── dashboard.css         # Styles for the dashboard page
│   ├── email_exist.html      # Shown when email is already registered
│   ├── index.php             # Homepage after login (dashboard)
│   ├── login.html            # User login form
│   ├── login_fail.html       # Login failure page
│   ├── register.html         # User registration form
│   └── style.css             # Global styles for login and registration
│
├── .gitattributes            # Git configuration file
└── README.md                 # Project overview and instructions

### To test:
1. Run XAMPP, open phpMyAdmin and import the `library` database.
2. Access `login.html` through `localhost/library-booking-system/frontend/login.html`
3. Try registering and logging in with valid credentials.

### Next Iteration Preview
- Book catalog display by subject
- Reservation logic
- Prevent duplicate reservations
