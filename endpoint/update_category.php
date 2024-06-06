<?php

include('../conn/conn.php');

$updateCategoryID = $_POST['tbl_expense_category_id'];
$updateCategoryName = $_POST['category_name'];
$updateCategoryBudget = $_POST['category_budget'];

$stmt = $conn->prepare("UPDATE `tbl_expense_category` SET `category_name` = '$updateCategoryName', `category_budget` = '$updateCategoryBudget' WHERE `tbl_expense_category`.`tbl_expense_category_id` = '$updateCategoryID'; ");
$stmt->execute();

echo "<script>
alert('Category Updated Sucessfully'); 
window.location.href = 'http://localhost/simple-expense-tracker-app/';
</script>";

?>