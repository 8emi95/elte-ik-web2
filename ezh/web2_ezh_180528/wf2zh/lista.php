<?php

function redirect($to) {
  header('Location: ' . $to);
  exit;
}

$shapes = json_decode(file_get_contents('shapes.json'), true);

// $true = 'true';

$hide = '';
if (isset($_GET['true'])) {
  foreach ($shapes as $shape) {
    if (!isset($shape['kedvenc'])) {
      $hide = 'style="display: none;"';
    }
  }
} else if (isset($_GET['false'])) {
  foreach ($shapes as $shape) {
    if (isset($shape['kedvenc'])) {
      $hide = 'style="display: none;"';
    }
  }
}



?>

<!DOCTYPE HTML>

<html>

<head>
  <title>ZH</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css" title="default">
  <link rel="stylesheet" type="text/css" media="screen" href="style.php">
</head>

<body>

  <p><a href="uj.php">Új alakzat</a>
  <table id="tabla">
    <tr>
      <th>Név</th>
      <th>Méret</th> 
      <th>Kedvenc</th>
      <th>Funkciók</th>
    </tr>
    <?php
      $i = 0;
      foreach ($shapes as $shape) {
        echo  '<tr data-id="' . ($i + 1) . '" value="' . $hide . '"><td>' . 
              htmlspecialchars($shape['name']) . 
              '</td><td>' . 
              htmlspecialchars($shape['size']) . 
              '</td><td>' . 
              ($shape['favorite'] ? '♥' : '♡') . 
              '</td>
              <td>
                <a href="megjelenit.php?id=' . $shape['id'] . '">Megjelenít</a>
              </td></tr>';
        ++$i;
      }
    ?>
  </table>

  <?php
  $true = 'true';
  $false = 'false';
  echo '<a href="lista.php?kedvenc="' . $true . '">kedvenc</a>';
  echo '<a href="lista.php?kedvenc="' . $false . '"> nem kedvenc</a>';
  ?>

</body>
</html>