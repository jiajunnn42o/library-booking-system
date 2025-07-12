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