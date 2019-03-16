<?php

function redirect($to) {
  header('Location: ' . $to);
  exit;
}

$shapes = json_decode(file_get_contents('shapes.json'), true);

if ($_POST) {
  $hibak = [];
  if (!is_numeric($_POST['id'])) {
    $hibak[] = "Az id nem szám";
  }
  if (empty($_POST['nev'])) {
    $hibak[] = "A név kötelező";
  }
  if (empty($_POST['szelesseg'])) {
    $hibak[] = "A szélesség kötelező";
  }
  if (!is_numeric($_POST['szelesseg'])) {
    $hibak[] = "A szélesség nem szám";
  }
  if (empty($_POST['magassag'])) {
    $hibak[] = "A magasság kötelező";
  }
  if (!is_numeric($_POST['magassag'])) {
    $hibak[] = "A magasság nem szám";
  }
  if (empty($_POST['alakzat'])) {
    $hibak[] = "Az alakzat kötelező";
  }
  if (json_decode ($_POST['alakzat']) === null) {
    $hibak[] = "Az alakzat rossz formátumú";
  }

  if (empty($hibak)) {
    $shapes[] = [
      'id' => $_POST['id'],
      "name" => $_POST['nev'],
      "size" => $_POST['magassag'] . ' x ' . $_POST['szelesseg'],
      "favorite" => isset($_POST['kedvenc']),
      "matrix" => $_POST['alakzat']
    ];

    file_put_contents('shapes.json', json_encode($shapes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    redirect('lista.php');
  } else {
    echo '<div id="hibak">';
    foreach ($hibak as $hiba) {
      echo $hiba;
      echo '<br>';
    }
    echo '</div>';
    // redirect('uj.php');
  }
}

?>

<!DOCTYPE HTML>

<html>

<head>
  <title>ZH</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="style.css" title="default">
</head>

<body>

  <h1>Új alakzat</h1>

  <form method="post" action="uj.php">
    Id:
    <input  type="text"
            name="id"><br>
    Név:
    <input  type="text"
            name="nev"><br>
    Szélesség:
    <input  type="text"
            name="szelesseg"><br>
    Magasság:
    <input  type="text"
            name="magassag"><br>
    Kedvenc:
    <input  type="checkbox"
            name="kedvenc"><br>
    Alakzat:
    <textarea name="alakzat"
              rows="5"
              cols="50"></textarea><br>
    <input type="submit" value="Ment"><br>
  </form>

</body>
</html>
