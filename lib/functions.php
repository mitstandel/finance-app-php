<?php
function redirect($path)
{
  if ($path == 'referer') {
    $path = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL;
  }

  header("Location: " . $path);
  exit;
}

function _hash($str)
{
  return sha1(PASSWORD_HASH . $str);
}
