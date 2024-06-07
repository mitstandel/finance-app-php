<?php
include('../auth.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['ERROR'] = "ERROR! Invalid request method.";
    redirect('referer');
}

$categoryID = $_POST['tbl_expense_category_id'];
$expenseName = $_POST['expense_name'];
$expenseDate = date('Y-m-d', strtotime($_POST['expense_date']));
$expenseSpent = $_POST['expense_spent'];
$expenseDescription = $_POST['expense_description'];

try {

    $message = 'Expense has been successfully added.';

    // Create a prepared statement
    if (isset($_POST['id'])) {
        $message = 'Expense has been successfully updated.';
        $stmt = $conn->prepare("
            UPDATE tbl_expenses
            SET expense_name = :expenseName,
                tbl_expense_category_id = :categoryID,
                expense_date = :expenseDate,
                expense_spent = :expenseSpent,
                expense_description = :expenseDescription
            WHERE id = :id
                and `tbl_user_id` = :user_id;
        ");
    } else {
        $stmt = $conn->prepare("
            INSERT INTO tbl_expenses (tbl_expense_category_id, expense_name, expense_date, expense_spent, expense_description, tbl_user_id)
            VALUES (:categoryID, :expenseName, :expenseDate, :expenseSpent, :expenseDescription, :user_id)
        ");
    }

    // Bind parameters
    $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
    $stmt->bindParam(':expenseName', $expenseName, PDO::PARAM_STR);
    $stmt->bindParam(':expenseDate', $expenseDate, PDO::PARAM_STR);
    $stmt->bindParam(':expenseSpent', $expenseSpent, PDO::PARAM_INT);
    $stmt->bindParam(':expenseDescription', $expenseDescription, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $_SESSION['USERID'], PDO::PARAM_INT);

    if (isset($_POST['id'])) {
        $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    }

    // Execute the statement
    $stmt->execute();

    $_SESSION['SUCCESS'] = $message;
} catch (PDOException $e) {
    $_SESSION['ERROR'] = "Something went wrong. Please try after sometime.";
    error_log($e->getMessage());
}

redirect('referer');
