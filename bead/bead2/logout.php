<?php

require('common.php');

if (isset($_SESSION['user'])) {
  unset($_SESSION['user']);
}

redirect('index.php');

?>