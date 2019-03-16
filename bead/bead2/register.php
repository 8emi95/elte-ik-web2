<?php

require('common.php');

if ($_POST) {
  $users = read_file('users');

  $errors = [];
  if (email_exists($_POST['email'], $users)) {
    $errors[] = 'This e-mail address is already in use.';
  }
  if (strlen($_POST['password']) < 6) {
    $errors[] = 'The password must contain at least 6 characters.';
  }
  if (empty($errors)) {
    $next_id = get_next_id($users);
    $users[] = [
      'id' => $next_id,
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'password' => $_POST['password']
    ];
    write_to_file('users', $users); 
    redirect('index.php');
  } else {
    $_SESSION['flash'] = [
      'errors' => $errors,
      'old' => $_POST
    ];
    redirect('register.php');
  }
}

function email_exists($email, $users) {
  foreach ($users as $user) {
    if ($user['email'] === $_POST['email']) {
      return true;
    }
  }
  return false;
}

?>

<?php require('header.php') ?>

<form method="post" action="register.php">
  <input  type="text"
          name="name"
          placeholder="Name"
          value="<?= htmlspecialchars($_SESSION['flash']['old']['name'] ?? '') ?>"
          required>
  <input type="email" name="email" placeholder="E-mail" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>

<?php require('footer.php') ?>