<?php
include_once "bootstrap.php";

//print_r($_SESSION); exit;

if (!isset($_SESSION['MAIN'])) {
  $_SESSION['ERROR'] = "ERROR! Session Expired.";
  redirect(SITE_URL);
}
