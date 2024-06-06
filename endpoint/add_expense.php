<?php
include('../conn/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryID = $_POST['tbl_expense_category_id'];
    $expenseName = $_POST['expense_name'];
    $expenseDate = date('Y-m-d', strtotime($_POST['expense_date']));
    $expenseSpent = $_POST['expense_spent'];
    $expenseDescription = $_POST['expense_description'];

    try {
        // Create a prepared statement
        $stmt = $conn->prepare("INSERT INTO tbl_expense (tbl_expense_category_id, expense_name, expense_date, expense_spent, expense_description) VALUES (:categoryID, :expenseName, :expenseDate, :expenseSpent, :expenseDescription)");

        // Bind parameters
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        $stmt->bindParam(':expenseName', $expenseName, PDO::PARAM_STR);
        $stmt->bindParam(':expenseDate', $expenseDate, PDO::PARAM_STR);
        $stmt->bindParam(':expenseSpent', $expenseSpent, PDO::PARAM_INT);
        $stmt->bindParam(':expenseDescription', $expenseDescription, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        echo "<script>
        alert('Expense Added Successfully'); 
        window.location.href = 'http://localhost/simple-expense-tracker-app/';
        </script>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
?>
