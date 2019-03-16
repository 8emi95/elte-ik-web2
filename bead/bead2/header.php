<!DOCTYPE HTML>

<html>

<head>
<title>Book Shelf</title>
<meta charset="UTF-8">
</head>

<body>

  <?php if (isset($_SESSION['user'])): ?>
    <p><?= $_SESSION['user']['name'] ?> - <a href="list.php">List</a> | <a href="logout.php">Log Out</a></p>
  <?php endif; ?>

  <?php foreach ($_SESSION['flash']['errors'] ?? [] as $error): ?>
    <p><?= $error ?></p>
  <?php endforeach; ?>