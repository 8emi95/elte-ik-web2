<?php

require('common.php');

$books = read_file('books');

if ($_POST) {
  $errors = [];
  if (!is_numeric($_POST['pages'])) {
    $errors[] = 'Pages must be an integer.';
  }
  if (!ctype_digit($_POST['isbn'])) {
    $errors[] = 'ISBN must only contain numbers.';
  }
  if (strlen($_POST['isbn']) != 10 && strlen($_POST['isbn']) != 13) {
    $errors[] = 'The ISBN number must be 10 or 13 characters.';
  }

  if (empty($errors)) {
    $next_id = get_next_id($books);
    $books[] = [
      'id' => $next_id,
      "user_id" => $_SESSION['user']['id'],
      "author" => $_POST['author'],
      "title" => $_POST['title'],
      "pages" => (int) $_POST['pages'],
      "category" => $_POST['category'],
      "isbn" => $_POST['isbn'],
      "is_read" => isset($_POST['is_read'])
    ];

    write_to_file('books', $books);
    redirect('list.php');
  } else {
    $_SESSION['flash'] = [
      'errors' => $errors,
      'old' => $_POST
    ];
    redirect('newbook.php');
  }
}

?>

<?php require('header.php') ?>

<form method="post" action="newbook.php">
  Author: <input	type="text"
                  name="author"
                  value="<?= htmlspecialchars($_SESSION['flash']['old']['author'] ?? '') ?>"
                  required><br>
  Title: <input type="text"
                name="title"
                value="<?= htmlspecialchars($_SESSION['flash']['old']['title'] ?? '') ?>"
                required><br>
  Pages: <input	type="number"
                name="pages"
                min="1"
                value="<?= $_SESSION['flash']['old']['pages'] ?? 1 ?>"><br>
  Category: <input  type="text"
                    list="category"
                    name="category"
                    value="<?= $_SESSION['flash']['old']['category'] ?? '' ?>">
  <datalist id="category">
    <option value="Action"</option>
    <option value="Biography"</option>
    <option value="Crime"</option>
    <option value="Comics"</option>
    <option value="Diary"</option>
    <option value="Drama"</option>
    <option value="Fantasy"</option>
    <option value="History"</option>
    <option value="Horror"</option>
    <option value="Mystery"</option>
    <option value="Mythology"</option>
    <option value="Poetry"</option>
    <option value="Romance"</option>
    <option value="Science fiction"</option>
    <option value="Self Help"</option>
    <option value="Thriller"</option>
    <option value="Tragedy"</option>
    <option value="Tragicomedy"</option>
    <option value="Western"</option>
  </datalist><br>
  ISBN: <input  type="text"
                name="isbn"
                value="<?= $_SESSION['flash']['old']['isbn'] ?? '' ?>"><br>
  Read: <input  type="checkbox"
                name="is_read"
                <?= isset($_SESSION['flash']['old']['is_read']) ? 'checked' : '' ?>
                value="yes"><br>
  <input type="submit" value="Submit"><br>
</form>

<?php require('footer.php') ?>