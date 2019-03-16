<?php

require('common.php');

$user_count = count(read_file('users'));
$book_count = count(read_file('books'));

?>

<?php require('header.php') ?>

  <p>Welcome to Book Shelf!</p>

  <p>Total number of users: <?= $user_count ?><br>Total number of books: <?= $book_count ?></p>

  <form method="post" action="login.php">
    <input type="email" name="email" placeholder="E-mail">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Log In</button>
  </form>

  <?php if (!isset($_SESSION['user'])): ?>
    <p><a href="register.php">Register</a></p>
  <?php endif; ?>

<?php require('footer.php') ?>