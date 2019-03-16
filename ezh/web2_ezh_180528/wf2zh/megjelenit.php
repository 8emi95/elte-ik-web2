<?php

$shapes = json_decode(file_get_contents('shapes.json'), true);

$id = $_GET['id'];

?>

<!DOCTYPE HTML>

<html>

<head>
  <title>ZH</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css" title="default">
</head>

<body>

<dl>
  <dt>Azonosító</dt>
  <dd>200000000</dd>

  <dt>Név</dt>
  <dd>szilva</dd>

  <dt>Méret</dt>
  <dd>2 x 3</dd>

  <dt>Kedvenc</dt>
  <dd>♡</dd>

  <dt>Vetületek</dt>
  <dd>
    <table>
      <tr>
        <th>Felülnézet</th>
        <th>Oldalnézet</th>
        <th>Elölnézet</th>
      </tr>
      <tr>
        <td>
          <table class="vetulet" id="felul">
            <tr>
                <td class="black"></td>
                <td class="black"></td>
                <td class="black"></td>
            </tr>
            <tr>
                <td class="black"></td>
                <td class=""></td>
                <td class=""></td>
            </tr>
          </table>
        </td>
        <td>
          <!-- bal v oldal? -->
          <div class="vetulet" id="oldal"> 
            <div class="vetulet" id="bal">
              <div>
                  <div></div>
                  <div></div>
              </div>
              <div>
                  <div></div>
                  <div></div>
              </div>
            </div>
          </div>
        </td>
        <td>
        <div class="vetulet" id="elol">
          <div>
              <div></div>
              <div></div>
          </div>
          <div>
              <div></div>
          </div>
          <div>
              <div></div>
          </div>
        </div>
        </td>
      </tr>
    </table>
  </dd>
</dl>


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
    ?>
  </table>

  <!-- 
  <a href="modify.php?modify=' . $shape['id'] . '">Megjelenít</a>
  <a href="list.php?delete=' . $shape['id'] . '">Delete</a>
  -->

  <!--
  <a href="lista.php?kedvenc=true">kedvenc</a>
  <a href="lista.php?kedvenc=false">nem kedvenc</a>
  -->

</body>
</html>