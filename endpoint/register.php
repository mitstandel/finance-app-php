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

if (isset($_POST['verify_password']) && $_POST['verify_password'] != $_POST['password']) {
    $_SESSION['ERROR'] = "Password and verify password are not matching";
    redirect('referer');
}

$userFirstName = @$_POST['firstname'];
$userLastName = @$_POST['lastname'];
$userAddress = @$_POST['address'];
$userEmail = $_POST['email'];
$userMobile = @$_POST['mobile'];
$userName = $_POST['username'];
$userPassword = $_POST['password'];

try {

    $message = 'You have been sucessfully registered. Please verify your email address from the link sent to your registered email address.';
   
    $stmt = $conn->prepare("
        INSERT INTO `login` (`username`, `password`)
        VALUES (:username, :password)
    ");

    // Bind parameters
    $stmt->bindParam(':username', $userName, PDO::PARAM_STR);
    $stmt->bindParam(':password', $userPassword, PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    $userId = $conn->lastInsertId();

    $_SESSION['SUCCESS'] = $message;

} catch (PDOException $e) {

    if ($e->errorInfo[1] == 1062) {
        $_SESSION['ERROR'] = "Username '" . $_POST['username'] . "' is already been taken. Please provide different name.";
    } else {
        $_SESSION['ERROR'] = "Something went wrong. Please try after sometime.";
    }
    error_log($e->getMessage());

    redirect('referer');
}

try {

    $stmt = $conn->prepare("
        INSERT INTO `user` (`user_id`, `fisrtname`, `lastname`, `mobile`, `address`, `email`)
        VALUES (:user_id, :firstname, :lastname, :mobile, :address, :email)
    ");

    // Bind parameters
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':firstname', $userFirstName, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $userLastName, PDO::PARAM_STR);
    $stmt->bindParam(':mobile', $userMobile, PDO::PARAM_STR);
    $stmt->bindParam(':address', $userAddress, PDO::PARAM_STR);
    $stmt->bindParam(':email', $userEmail, PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    redirect(SITE_URL.'verify-email.php?hash='.md5(HASH.$userEmail));

} catch (PDOException $e) {

    $_SESSION['ERROR'] = "Something went wrong. Please try after sometime.";
    error_log($e->getMessage());

    redirect('referer');
}


