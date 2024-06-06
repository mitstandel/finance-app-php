<?php
include('../conn/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expenseID = $_POST['tbl_expense'];
    $expenseName = $_POST['expense_name'];
    $expenseCategoryID = $_POST['tbl_expense_category_id'];
    $expenseDate = $_POST['expense_date'];
    $expenseSpent = $_POST['expense_spent'];
    $expenseDescription = $_POST['expense_description'];

    // Convert the date to the 'Y-m-d' format (assuming it's received as 'Y-m-d' from the form)
    $expenseDate = date('Y-m-d', strtotime($expenseDate));

    // Update the expense data in the database
    $query = "UPDATE tbl_expense SET
                expense_name = :expenseName,
                tbl_expense_category_id = :expenseCategoryID,
                expense_date = :expenseDate,
                expense_spent = :expenseSpent,
                expense_description = :expenseDescription
              WHERE tbl_expense_id = :expenseID";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':expenseName', $expenseName, PDO::PARAM_STR);
    $stmt->bindParam(':expenseCategoryID', $expenseCategoryID, PDO::PARAM_INT);
    $stmt->bindParam(':expenseDate', $expenseDate, PDO::PARAM_STR);
    $stmt->bindParam(':expenseSpent', $expenseSpent, PDO::PARAM_INT);
    $stmt->bindParam(':expenseDescription', $expenseDescription, PDO::PARAM_STR);
    $stmt->bindParam(':expenseID', $expenseID, PDO::PARAM_INT);

    try {
        if ($stmt->execute()) {
            echo "<script>
            alert('Expense Updated Sucessfully'); 
            window.location.href = 'http://localhost/simple-expense-tracker-app/';
            </script>";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
?>
