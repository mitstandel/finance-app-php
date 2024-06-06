<?php
include('../conn/conn.php');

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    try {

        $query = "DELETE FROM `tbl_expense_category` WHERE `tbl_expense_category_id` = '$category'";

        $stmt = $conn->prepare($query);
        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "<script>
            alert('Category Deleted Sucessfully!'); 
            window.location.href = 'http://localhost/simple-expense-tracker-app/';
            </script>";
        } else {
            echo "<script>
            alert('Category Not Deleted!'); 
            window.location.href = 'http://localhost/simple-expense-tracker-app/';
            </script>";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>