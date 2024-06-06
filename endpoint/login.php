<?php
include_once "../bootstrap.php";

if (!isset($_POST['email'])) {
  $_SESSION['ERROR'] = "Please provide your account email address";
  redirect('referer');
}

if (!isset($_POST['password'])) {
  $_SESSION['ERROR'] = "Please provide your password";
  redirect('referer');
}

$email = $_POST['email'];
$password = $_POST['password'];
$passwordHash = _hash($password); //die($passwordHash);

$stmt = $conn->prepare("SELECT * FROM `tbl_users` where email = :email and password = :password");
$stmt->execute([
  ':email' => $_POST['email'],
  ':password' => $passwordHash
]);
$loginData = $stmt->fetch();

if (!$loginData) {
  $_SESSION['ERROR'] = 'email and password combination is wrong';
  redirect('referer');
}

$_SESSION['MAIN'] = session_id();
$_SESSION['USERID'] = $loginData['id'];
$_SESSION['NAME'] = $loginData['name'];
$_SESSION['EMAILID'] = $loginData['email'];

$stmt = $conn->prepare("UPDATE `tbl_users` set last_login_at = now() where id = :id");
$stmt->execute([
  ':id' => $loginData['id']
]);

redirect(SITE_URL.'dashboard.php');
