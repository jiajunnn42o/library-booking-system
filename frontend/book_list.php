<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Book List</title>
  <link rel="stylesheet" href="book_list.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text&display=swap" rel="stylesheet">
</head>
<body>
  <div class="book-page">
    <div class="page-header">
      <div class="header-left">
        <img src="school-logo.png" alt="School Logo" class="header-logo">
      </div>
      <div class="header-center">
        <h2 class="page-title">AVAILABLE BOOKS</h2>
      </div>
      <div class="header-right">
        <a href="index.php" class="back-btn">Back to Home</a>
      </div>
    </div>

    <!-- Art -->
    <div class="subject-section">
      <h3>Art</h3>
      <div class="book-row">
        <div class="book-card">
          <img src="books/art1.jpg" alt="Art Book 1">
          <p class="book-title">The Story of Art</p>
          <p class="author">by E. H. Gombrich</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="1">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/art2.jpg" alt="Art Book 2">
          <p class="book-title">Ways of Seeing</p>
          <p class="author">by John Berger</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="2">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/art3.jpg" alt="Art Book 3">
          <p class="book-title">Art & Fear</p>
          <p class="author">by David Bayles</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="3">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Science -->
    <div class="subject-section">
      <h3>Science</h3>
      <div class="book-row">
        <div class="book-card">
          <img src="books/sci1.jpg" alt="Science Book 1">
          <p class="book-title">Brief History of Time</p>
          <p class="author">by Stephen Hawking</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="4">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/sci2.jpg" alt="Science Book 2">
          <p class="book-title">The Selfish Gene</p>
          <p class="author">by Richard Dawkins</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="5">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/sci3.jpg" alt="Science Book 3">
          <p class="book-title">Cosmos</p>
          <p class="author">by Carl Sagan</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="6">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Fantasy -->
    <div class="subject-section">
      <h3>Fantasy</h3>
      <div class="book-row">
        <div class="book-card">
          <img src="books/fantasy1.jpg" alt="Fantasy Book 1">
          <p class="book-title">The Hobbit</p>
          <p class="author">by J.R.R. Tolkien</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="7">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/fantasy2.jpg" alt="Fantasy Book 2">
          <p class="book-title">Harry Potter</p>
          <p class="author">by J.K. Rowling</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="8">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/fantasy3.jpg" alt="Fantasy Book 3">
          <p class="book-title">Game of Thrones</p>
          <p class="author">by George R.R. Martin</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="9">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Biography -->
    <div class="subject-section">
      <h3>Biography</h3>
      <div class="book-row">
        <div class="book-card">
          <img src="books/bio1.jpg" alt="Bio Book 1">
          <p class="book-title">Steve Jobs</p>
          <p class="author">by Walter Isaacson</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="10">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/bio2.jpg" alt="Bio Book 2">
          <p class="book-title">Elon Musk</p>
          <p class="author">by Ashlee Vance</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="11">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
        <div class="book-card">
          <img src="books/bio3.jpg" alt="Bio Book 3">
          <p class="book-title">The Diary of Anne Frank</p>
          <p class="author">by Anne Frank</p>
          <form action="../backend/reserve.php" method="POST">
            <input type="hidden" name="book_id" value="12">
            <button type="submit" class="reserve-btn">Reserve</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php if (isset($_GET['reserved'])): ?>
  <div class="toast 
    <?php echo $_GET['reserved'] === 'success' ? 'toast-success' : 'toast-error'; ?>">
    <?php
      if ($_GET['reserved'] === 'success') echo "Book reserved successfully!";
      elseif ($_GET['reserved'] === 'exists') echo "You’ve already reserved this book.";
      elseif ($_GET['reserved'] === 'unavailable') echo "This book has already been reserved by another user.";
    ?>
  </div>
  <script>
    setTimeout(() => {
      const toast = document.querySelector('.toast');
      if (toast) toast.style.display = 'none';
    }, 3000);
  </script>
<?php endif; ?>

</body>
</html>