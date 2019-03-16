<?php

session_start();

function read_file($name) {
  return json_decode(file_get_contents($name . '.json'), true);
}

function write_to_file($name, $content) {
  file_put_contents($name . '.json', json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function get_next_id($arr) {
  if (empty($arr)) {
    return 1;
  }

  return max(
    array_map(
      function ($item) {
        return $item['id'];
      },
      $arr
    )
  ) + 1;
}

function redirect($to) {
  header('Location: ' . $to);
  exit;
}

register_shutdown_function(function () {
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    unset($_SESSION['flash']);
  }
});

?>