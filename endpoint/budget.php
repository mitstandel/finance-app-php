<?php 
include('../conn/conn.php');

$budgetID = '1';
$monthlyBudget = $_POST['monthly_budget'];

$stmt = $conn->prepare("UPDATE `tbl_budget` SET `monthly_budget` = '$monthlyBudget' WHERE `tbl_budget_id` = '$budgetID';");
$stmt->execute();

echo "<script>
alert('Monthly Budget Updated Sucessfully'); 
window.location.href = 'http://localhost/simple-expense-tracker-app/';
</script>";

?>