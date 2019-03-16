<?php

function redirect($to) {
  header('Location: ' . $to);
  exit;
}

$shapes = json_decode(file_get_contents('shapes.json'), true);

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
      if (empty($_GET['kedvenc'])) {
        $i = 0;
        foreach ($shapes as $shape) {
          echo  '<tr data-id="' . ($i + 1) . '"><td>' . 
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
      } else {
        if ($_GET['kedvenc'] == 'true') {
          $i = 0;
          foreach ($shapes as $shape) {
            if ($shape['favorite']) {
              echo  '<tr data-id="' . ($i + 1) . '"><td>' . 
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
          }
        }
        else if ($_GET['kedvenc'] == 'false') {
          $i = 0;
          foreach ($shapes as $shape) {
            if (!$shape['favorite']) {
              echo  '<tr data-id="' . ($i + 1) . '"><td>' . 
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
          }
        }
      }

      // $i = 0;
      // foreach ($shapes as $shape) {
      //   echo  '<tr data-id="' . ($i + 1) . '"><td>' . 
      //         htmlspecialchars($shape['name']) . 
      //         '</td><td>' . 
      //         htmlspecialchars($shape['size']) . 
      //         '</td><td>' . 
      //         ($shape['favorite'] ? '♥' : '♡') . 
      //         '</td>
      //         <td>
      //           <a href="megjelenit.php?id=' . $shape['id'] . '">Megjelenít</a>
      //         </td></tr>';
      //   ++$i;
      // }
    ?>
  </table>

  <?php
  echo '<a href="lista.php">mind</a>';
  echo '<br>';
  echo '<a href="lista.php?kedvenc=true">kedvenc</a>';
  echo '<br>';
  echo '<a href="lista.php?kedvenc=false">nem kedvenc</a>';
  ?>

</body>
</html>