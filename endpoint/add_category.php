<?php
include('../conn/conn.php');

$expenseCategoryName = $_POST['category_name'];
$expenseCategoryBudget = $_POST['category_budget'];

// Check if the Category Name already exists
$stmt = $conn->prepare("SELECT `category_name` FROM `tbl_expense_category` WHERE `category_name` = :category_name");
$stmt->execute([
    'category_name' => $expenseCategoryName,
]);

$exist = $stmt->fetch(PDO::FETCH_ASSOC);

if (empty($exist)) {
    try {
        // Create a prepared statement
        $stmt = $conn->prepare("INSERT INTO `tbl_expense_category` (`tbl_expense_category_id`, `category_name`, `category_budget`) VALUES (NULL, :category_name, :category_budget) ");

        // Bind parameters
        $stmt->bindParam(':category_name', $expenseCategoryName, PDO::PARAM_STR);
        $stmt->bindParam(':category_budget', $expenseCategoryBudget, PDO::PARAM_INT);

        // Execute the statement
        $stmt->execute();

        echo "<script>
        alert('Category Added Successfully'); 
        window.location.href = 'http://localhost/simple-expense-tracker-app/';
        </script>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<script>
    alert('Category already exists, try adding another category'); 
    window.location.href = 'http://localhost/simple-expense-tracker-app/';
    </script>";
}

exit();
?>
