<?php
include('../auth.php');

if (!isset($_GET['id'])) {
    $_SESSION['ERROR'] = "Required parameters are missing.";
    redirect('referer');
}

try {

    $query = "DELETE FROM `tbl_expense_categories` WHERE `id` = :id and `tbl_user_id` = :user_id;";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':user_id', $_SESSION['USERID'], PDO::PARAM_INT);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

    $query = $stmt->execute();

    $_SESSION['SUCCESS'] = 'Category has been successfully deleted.';
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1451) {
        $_SESSION['ERROR'] = "You cannot delete this category as some expense details are associated with it.";
    } else {
        $_SESSION['ERROR'] = "Something went wrong. Please try after sometime.";
    }
    error_log($e->getMessage());
}

redirect('referer');
