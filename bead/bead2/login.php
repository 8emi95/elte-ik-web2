<?php

require('common.php');

$users = read_file('users');
foreach ($users as $user) {
  if ($user['email'] === $_POST['email'] && $user['password'] === $_POST['password']) {
    $_SESSION['user'] = $user;
    redirect('list.php'); // index helyett
  }
}

$_SESSION['flash'] = [
  'errors' => ['Given credentials are invalid.']
];

redirect('index.php');

?>