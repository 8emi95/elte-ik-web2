<?php

require('common.php');

$books = read_file('books');

if (isset($_GET['delete'])) {
  delete_book($books);
  redirect('list.php');
}

$filtered_books = [];
foreach ($books as $book) {
  if ($_SESSION['user']['id'] === $book['user_id']) {
    array_push($filtered_books, $book);
  }
}

function delete_book($books) {
  foreach ($books as $index => $book) {
    if ($_GET['delete'] == $book['id']) {
      unset($books[$index]);
      break;
    }
  }

  write_to_file('books', $books);
}

?>

<?php require('header.php') ?>

<p><a href="newbook.php">Add New Book</a>

  <table>
    <tr>
      <th>Author</th>
      <th>Title</th> 
      <th>Category</th>
      <th>Read</th>
      <th>Modify</th>
      <th>Delete</th>
    </tr>
    <?php
      foreach ($filtered_books as $book) {
        echo  '<tr><td>' . 
              htmlspecialchars($book['author']) . 
              '</td><td>' . 
              htmlspecialchars($book['title']) . 
              '</td><td>' . 
              htmlspecialchars($book['category']) . 
              '</td><td>' . 
              ($book['is_read'] ? 'Yes' : 'No') . 
              '</td>
              <td>
                <a href="modify.php?modify=' . $book['id'] . '">Modify</a>
              </td>
              <td>
                <a href="list.php?delete=' . $book['id'] . '">Delete</a>
              </td></tr>';
      }
    ?>
  </table>

<?php require('footer.php') ?>