<?php
include_once "auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Expense Tracker App</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>

        .card-body {
            font-size: small;
        }
        /* Custom CSS */
        .main-panel, .card {
            margin: auto;
            height: 90vh;
            overflow-y: auto;
        }

    
    </style>

</head>
<body>
    
<?php include_once SITE_PATH."includes/header.php"; ?>

    <div class="main-panel mt-4 ml-5 col-11">
        <div class="row">

            <!-- Expense Category  -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Expenses Category
                    </div>
                    <div class="card-body">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-outline-secondary col-md-3 float-right" data-toggle="modal" data-target="#expenseCategoryModal">&#43; Expense Category</button>

                        <!--Add Category Modal -->
                        <div class="modal fade" id="expenseCategoryModal" tabindex="-1" role="dialog" aria-labelledby="expenseCategoryModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="expenseCategoryModal">Add Expense Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="endpoint/add_category.php" method="POST">
                                            <div class="form-group" hidden>
                                                <label for="expenseCategoryID">Category ID</label>
                                                <input type="text" class="form-control" id="expenseCategoryID" name="tbl_expense_category_id">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategoryName">Category Name</label>
                                                <input type="text" class="form-control" id="expenseCategoryName" name="category_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategoryBudget">Budget</label>
                                                <input type="number" class="form-control" id="expenseCategoryBudget" name="category_budget">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Category Modal -->
                        <div class="modal fade" id="updateExpenseCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateExpenseCategoryModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateExpenseCategoryModal">Update Expense Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="endpoint/update_category.php" method="POST">
                                            <div class="form-group" hidden>
                                                <label for="updateExpenseCategoryID">Category ID</label>
                                                <input type="text" class="form-control" id="updateExpenseCategoryID" name="tbl_expense_category_id">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategoryName">Category Name</label>
                                                <input type="text" class="form-control" id="updateExpenseCategoryName" name="category_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategoryBudget">Budget</label>
                                                <input type="text" class="form-control" id="updateExpenseCategoryBudget" name="category_budget">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
 

                        
                        <div class="data-item">
                            <ul class="list-group col-md-12 mt-5">
                            <div class="row">
                                <div class="col">
                                    <label for="monthlyBudget"><strong>Total Monthly Budget: </strong></label>
                                    <div style="display: flex; align-items: center;">
                                        <?php
                                        $stmt = $conn->prepare("SELECT * FROM `tbl_budget`");
                                        $stmt->execute();
                                        $result = $stmt->fetch();
                                        
                                        if ($result) {
                                            $monthlyBudget = $result['monthly_budget'];
                                        } else {
                                            $monthlyBudget = 0;
                                        }
                                        ?>
                                        <input type="number" class="form-control col-6" name="monthly_budget" id="monthlyBudget" value="<?php echo $monthlyBudget; ?>" readonly>
                                        <button type="button" class="btn btn-light" id="editButton" title="Edit" data-toggle="modal" data-target="#monthlyBudgetModal">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </div>
                                    <!-- Monthly Budget Modal -->
                                    <div class="modal fade" id="monthlyBudgetModal" tabindex="-1" role="dialog" aria-labelledby="monthlyBudgetModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="monthlyBudgetModalLabel">Update Monthly Budget</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="endpoint/budget.php" method="POST">
                                                        <div class="form-group" hidden>
                                                            <label for="budgetID">Budget ID</label>
                                                            <input type="text" class="form-control" id="budgetID" name="tbl_budget_id">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="monthlyBudgetInput">Budget</label>
                                                            <input type="number" class="form-control" id="monthlyBudgetInput" name="monthly_budget" value="<?php echo $monthlyBudget; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-dark">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <label for="monthlySavings"><strong>Total Monthly Savings: </strong></label>
                                    <input type="text" class="form-control col-6" name="monthly_savings" id="monthlySavings" value="0" readonly>
                                </div>
                            </div>

                                <!-- Table -->
                                <table class="table table-hover mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Category ID</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Monthly Budget</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            
                                            $stmt = $conn->prepare("SELECT * FROM `tbl_expense_category`");
                                            $stmt->execute();

                                            $result = $stmt->fetchAll();
                                            
                                            foreach ($result as $row) {
                                                
                                                $categoryID = $row['tbl_expense_category_id'];
                                                $categoryName = $row['category_name'];
                                                $categoryBudget = $row['category_budget'];
                                        
                                                ?>

                                                <tr>
                                                    <td id="categoryID-<?= $categoryID ?>"><?php echo $categoryID ?></td>
                                                    <td id="categoryName-<?= $categoryID ?>"><?php echo $categoryName ?></td>
                                                    <td id="categoryBudget-<?= $categoryID ?>"><?php echo $categoryBudget?></td>
                                                    <td>
                                                        <div>
                                                            <button type="submit" title="Edit" onclick="update_category('<?php echo $categoryID ?>')"><i class="fa-solid fa-pencil"></i></button>
                                                            <button type="button" title="Remove"><i class="fa-solid fa-trash" onclick="delete_category('<?php echo $categoryID ?>')"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <?php

                                            }

                                        ?>

                                        <tr>
                                            <td colspan="2">Total Budget: </td>
                                            <td colspan="2"><span id="totalBudget">0</span></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </ul>                            
                        </div>
                    </div>
                </div>
            </div>
            

            <!--  Exepense Name  -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Expenses
                    </div>

                    <div class="card-body">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-outline-secondary col-md-2 float-right" data-toggle="modal" data-target="#expenseModal">&#43; Expense Name</button>
                            
                        <!--Add Expense Modal -->
                        <div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="expensModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="expenseModal">Add Expense Name</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="endpoint/add_expense.php" method="POST">
                                            <div class="form-group" hidden>
                                                <label for="expenseID">Expense ID</label>
                                                <input type="text" class="form-control" id="expenseID" name="tbl_expense">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseName">Expense Name</label>
                                                <input type="text" class="form-control" id="expenseName" name="expense_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategory">Category</label>
                                                <?php 
                                                
                                                $stmt = $conn->prepare("SELECT * FROM `tbl_expense_category`");
                                                $stmt->execute();

                                                $expense_category = $stmt->fetchAll();

                                                ?>

                                                <select class="form-control" name="tbl_expense_category_id" id="expenseCategory">
                                                    <option value="">- select -</option>
                                                    <?php foreach ($expense_category as $category) {
                                                        ?>
                                                        <option value="<?php echo $category['tbl_expense_category_id']; ?>"><?php echo $category['category_name'] ?></option>
                                                        <?php
                                                    } ?>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="expenseDate">Date</label>
                                                <input type="date" class="form-control" name="expense_date" id="expenseDate">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseSpent">Spent</label>
                                                <input type="number" class="form-control" id="expenseSpent" name="expense_spent">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseDescription">Description</label>
                                                <textarea class="form-control" name="expense_description" id="expenseDescription" rows="5"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Expense Modal -->
                        <div class="modal fade" id="updateExpenseModal" tabindex="-1" role="dialog" aria-labelledby="expenseModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="expenseModal">Update Expense Name</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="endpoint/update_expense.php" method="POST">
                                            <div class="form-group" hidden>
                                                <label for="updateExpenseID">Expense ID</label>
                                                <input type="text" class="form-control" id="updateExpenseID" name="tbl_expense">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateExpenseName">Expense Name</label>
                                                <input type="text" class="form-control" id="updateExpenseName" name="expense_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateExpenseCategory">Category</label>
                                                <?php 
                                                
                                                $stmt = $conn->prepare("SELECT * FROM `tbl_expense_category`");
                                                $stmt->execute();

                                                $expense_category = $stmt->fetchAll();

                                                ?>

                                                <select class="form-control" name="tbl_expense_category_id" id="updateExpenseCategory">
                                                    <option value="">- select -</option>
                                                    <?php foreach ($expense_category as $category) {
                                                        ?>
                                                        <option value="<?php echo $category['tbl_expense_category_id']; ?>"><?php echo $category['category_name'] ?></option>
                                                        <?php
                                                    } ?>
                                                </select>

                                            </div>
                                            <div class="form-group">
                                                <label for="updateExpenseDate">Date</label>
                                                <input type="date" class="form-control" name="expense_date" id="updateExpenseDate">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateExpenseSpent">Spent</label>
                                                <input type="number" class="form-control" id="updateExpenseSpent" name="expense_spent">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateExpenseDescription">Description</label>
                                                <textarea class="form-control" name="expense_description" id="updateExpenseDescription" rows="5"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="data-item">
                            <ul class="list-group col-md-12 mt-5">
                                <div class="row">
                                    <div class="col">
                                        <label for="monthlyBudgetInputLeft"><strong>Monthly Budget Left: </strong></label>
                                        <input type="text" class="form-control col-3" name="monthly_budget_left" id="monthlyBudgetInputLeft" value="0" readonly>
                                    </div>
                                </div>
                                <!-- Table -->
                                <table class="table table-hover mt-3">
                                    <thead>
                                        <tr>
                                        <th scope="col">Expense ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Date Spent</th>
                                        <th scope="col">Spent</th>
                                        <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        
                                        $stmt = $conn->prepare("
                                            SELECT
                                                `tbl_expense`.`tbl_expense_id`,
                                                `tbl_expense_category`.`tbl_expense_category_id`,
                                                `tbl_expense`.`expense_name`,
                                                `tbl_expense_category`.`category_name`,
                                                `tbl_expense`.`expense_date`,
                                                `tbl_expense`.`expense_spent`,
                                                `tbl_expense`.`expense_description`
                                            FROM
                                                `tbl_expense`
                                            LEFT JOIN tbl_expense_category ON
                                                `tbl_expense`.`tbl_expense_category_id` = `tbl_expense_category`.`tbl_expense_category_id`
                                            
                                        ");
                                        $stmt->execute();
                                        
                                        $result = $stmt->fetchAll();

                                        foreach ($result as $row) {
                                            $expenseID = $row['tbl_expense_id'];
                                            $categoryID = $row['tbl_expense_category_id'];
                                            $expenseName = $row['expense_name'];
                                            $categoryName = $row['category_name'];
                                            $expenseDate = $row['expense_date'];
                                            $expenseSpent = $row['expense_spent'];
                                            $expenseDescription = $row['expense_description'];
                                            ?>

                                            <tr>
                                                <td id="expenseID-<?= $expenseID ?>"><?php echo $expenseID ?></td>
                                                <td id="categoryID-<?= $expenseID ?>" hidden><?php echo $categoryID ?></td>
                                                <td id="expenseName-<?= $expenseID ?>"><?php echo $expenseName ?></td>
                                                <td id="categoryName-<?= $expenseID ?>"><?php echo $categoryName ?></td>
                                                <td id="expenseDate-<?= $expenseID ?>"><?php echo $expenseDate ?></td>
                                                <td id="expenseSpent-<?= $expenseID ?>"><?php echo $expenseSpent ?></td>
                                                <td>
                                                    <div>
                                                        <button type="submit" title="Edit" onclick="update_expense('<?php echo $expenseID ?>')"><i class="fa-solid fa-pencil"></i></button>
                                                        <button type="button" title="Remove" onclick="delete_expense('<?php echo $expenseID ?>')"><i class="fa-solid fa-trash"></i></button>
                                                        <button type="button" title="View" data-toggle="collapse" data-target="#expenseDescriptionView-<?php echo $expenseID ?>"><i class="fa-solid fa-list"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="expenseDescriptionView-<?= $expenseID ?>">
                                                <td colspan="2">Expense Description:</td>
                                                <td colspan="6" id="expenseDescription-<?= $expenseID ?>"><?php echo $expenseDescription ?></td>
                                            </tr>

                                            <?php
                                        }
                                        
                                        ?>

                                        
                                        <tr>
                                            <td colspan="4">Total Spent: </td>
                                            <td colspan="2"><span id="totalSpent">0</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>

        // update category
       function update_category(id) {
            $("#updateExpenseCategoryModal").modal("show");

            let updateCategoryID = $("#categoryID-" + id).text();
            let updateCategoryName = $("#categoryName-" + id).text();
            let updateCategoryBudget = $("#categoryBudget-" + id).text();

            $("#updateExpenseCategoryID").val(updateCategoryID);
            $("#updateExpenseCategoryName").val(updateCategoryName);
            $("#updateExpenseCategoryBudget").val(updateCategoryBudget);


        }

        // delete resident data
        function delete_category(id) {

            if (confirm("Do you confirm to delete this category?")) {
                window.location = "endpoint/delete_category.php?category=" + id
            }
        }

        // update expense
        function update_expense(id) {
            $("#updateExpenseModal").modal("show");

            let updateExpenseID = $("#expenseID-" + id).text();
            let updateExpenseName = $("#expenseName-" + id).text();
            let updateCategoryName = $("#categoryName-" + id).text();
            let updateExpenseDate = $("#expenseDate-" + id).text();
            let updateExpenseSpent = $("#expenseSpent-" + id).text();
            let updateExpenseDescription = $("#expenseDescription-" + id).text();


            $("#updateExpenseID").val(updateExpenseID);
            $("#updateExpenseName").val(updateExpenseName);
            $("#updateExpenseCategory option").each(function() {
                let category = $(this).text();
                if (category === updateCategoryName) {
                    $(this).prop("selected", true);
                    return false;
                }
            });
            $("#updateExpenseDate").val(updateExpenseDate);
            $("#updateExpenseSpent").val(updateExpenseSpent);
            $("#updateExpenseDescription").val(updateExpenseDescription);

        }

        
        // delete resident data
        function delete_expense(id) {

            if (confirm("Do you confirm to delete this expense?")) {
                window.location = "endpoint/delete_expense.php?expense=" + id
            }
        }

        // total budget
        var categoryBudgetElements = document.querySelectorAll('[id^="categoryBudget-"]');
        var totalBudgetElement = document.getElementById("totalBudget");
        var total = 0;

        categoryBudgetElements.forEach(function(element) {
            var categoryBudget = parseInt(element.textContent);
            
            if (!isNaN(categoryBudget)) {
                total += categoryBudget;
            }
        });
        totalBudgetElement.textContent = total;

        // total spent
        var spentElements = document.querySelectorAll('[id^="expenseSpent-"]');
        var totalSpentElement = document.getElementById("totalSpent");
        var total = 0;

        spentElements.forEach(function(element) {
            var spent =parseInt(element.textContent);

            if (!isNaN(spent)) {
                total += spent;
            }
        });
        totalSpentElement.textContent = total;

        // monthly savings
        document.addEventListener("DOMContentLoaded", function() {
            var monthlyBudgetInput = document.getElementById("monthlyBudgetInput");
            var totalBudgetSpan = document.getElementById("totalBudget");
            var monthlySavingsInput = document.getElementById("monthlySavings");

            var totalBudget = parseFloat(totalBudgetSpan.textContent) || 0;
            var monthlyBudget = parseFloat(monthlyBudgetInput.value) || 0;

            monthlySavingsInput.value = (monthlyBudget - totalBudget);

            monthlyBudgetInput.addEventListener("input", function() {
                var monthlyBudget = parseFloat(monthlyBudgetInput.value) || 0; 
                monthlySavingsInput.value = (monthlyBudget - totalBudget);
            });
        });

        // budget left
        document.addEventListener("DOMContentLoaded", function() {
            var monthlyBudgetLeftInput = document.getElementById("monthlyBudgetInputLeft");
            var totalSpentSpan = document.getElementById("totalSpent");
            var totalBudgetSpan = document.getElementById("totalBudget");

            var totalSpent = parseFloat(totalSpentSpan.textContent) || 0;
            var totalBudget = parseFloat(totalBudgetSpan.textContent) || 0;

            monthlyBudgetLeftInput.value = (totalBudget - totalSpent);

   
        })


    </script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>