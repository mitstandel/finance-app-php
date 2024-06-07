<?php
include_once '../auth.php';

$expenseCategoryName = $_POST['name'];
$expenseCategoryBudget = $_POST['budget'];

try {

    $message = 'Category has been successfully added.';

    // Create a prepared statement
    if (isset($_POST['id'])) {
        $message = 'Category has been successfully updated.';
        $stmt = $conn->prepare("
            UPDATE `tbl_expense_categories`
            SET `category_name` = :category_name,
                `category_budget` = :category_budget
            WHERE `id` = :id
                and `tbl_user_id` = :user_id;
        ");
    } else {
        $stmt = $conn->prepare("
            INSERT INTO `tbl_expense_categories` (`category_name`, `category_budget`, `tbl_user_id`)
            VALUES (:category_name, :category_budget, :user_id)
        ");
    }

    // Bind parameters
    $stmt->bindParam(':category_name', $expenseCategoryName, PDO::PARAM_STR);
    $stmt->bindParam(':category_budget', $expenseCategoryBudget, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $_SESSION['USERID'], PDO::PARAM_INT);

    if (isset($_POST['id'])) {
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    }

    // Execute the statement
    $stmt->execute();

    $_SESSION['SUCCESS'] = $message;
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        $_SESSION['ERROR'] = "'" . $_POST['name'] . "' is already available. Please provide different name.";
    } else {
        $_SESSION['ERROR'] = "Something went wrong. Please try after sometime.";
    }
    error_log($e->getMessage());
}

redirect('referer');
