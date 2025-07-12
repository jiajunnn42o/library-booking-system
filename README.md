## Iteration 4 – Edit Book and Overdue Functionality

### New Features Implemented

#### Admin Edit Book Feature
Admin users can now update book information:

- Title  
- Author  
- Subject  
- Cover image (optional replacement)  

Other enhancements:

- Form is styled to match the `manage_books.php` layout  
- Preview of current book cover is displayed  
- Upon successful update, a floating toast message appears  

#### Overdue Status Functionality
The system automatically updates the status of borrowed books to **overdue** if:

- The current date is later than the `due_date`
- The current status is still `borrowed`

Overdue status is clearly indicated in:

- `my_bookings.php` – student borrowing history  
- `view_reservations.php` – admin reservation view  

---

### Files Affected or Added

| File Path                      | Description                                    |
|-------------------------------|------------------------------------------------|
| `frontend/edit_book.php`      | Interface for admin to edit book details       |
| `backend/update_book.php`     | Backend logic to update book information       |
| `frontend/my_bookings.php`    | Overdue status logic added for students        |
| `frontend/view_reservations.php` | Admin reservation list with overdue check |
| `frontend/book_list.css`      | Updated styles for form layout & indicators    |

---

###  How to Test

1. Log in as admin and navigate to **Manage Books**.
2. Click **Edit** next to any book entry.
3. Update the fields (title, author, subject, or cover image).
4. Confirm:
   - Book updates correctly
   - Success toast message appears

To test **overdue functionality**:

1. Manually set `due_date` in the past for a record in `borrow_records` table.
2. Ensure status is still set to `borrowed`.
3. Open `my_bookings.php` or `view_reservations.php` and confirm the book is marked as **Overdue**.

---

### Notes

- `due_date` remains 5 days after reservation.
- Book borrowing/returning workflow is unchanged from previous iterations.
- Future improvements may include:
  - Email reminders for overdue books
  - Automatic fine system for late returns
