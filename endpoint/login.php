<?php
include_once "../bootstrap.php";

if (!isset($_POST['username'])) {
  $_SESSION['ERROR'] = "Please provide your username";
  redirect('referer');
}

if (!isset($_POST['password'])) {
  $_SESSION['ERROR'] = "Please provide your password";
  redirect('referer');
}

$username = $_POST['username'];
$password = $_POST['password'];
$passwordHash = _hash($password); //die($passwordHash);

$stmt = $conn->prepare("SELECT * FROM `login` where username = :username and password = :password");
$stmt->execute([
  ':username' => $_POST['username'],
  ':password' => $passwordHash
]);
$loginData = $stmt->fetch();

if (!$loginData) {
  $_SESSION['ERROR'] = 'Username and password combination is wrong';
  redirect('referer');
}

$stmt = $conn->prepare("SELECT * FROM `user` where user_id = :user_id");
$stmt->execute([
  ':user_id' => $loginData['user_id'],
]);
$userData = $stmt->fetch();

$_SESSION['MAIN'] = session_id();
$_SESSION['USERID'] = $userData['user_id'];
$_SESSION['NAME'] = $userData['firstname'].' '.$userData['lastname'];
$_SESSION['EMAILID'] = $userData['email'];
$_SESSION['USERNAME'] = $loginData['username'];

redirect(SITE_URL.'profile.php');
