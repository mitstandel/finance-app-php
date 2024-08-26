<?php
include_once "auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <?php include_once "includes/head-content.php"; ?>

</head>

<body>

    <?php include_once SITE_PATH . "includes/header.php"; ?>

    <div class="main-panel mt-4 container">
        <div class="row">

            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="text-bold">Expenses</h1>
                <div class="navigation">
                    <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#expenseModal">&#43; Add</button>
                </div>
            </div>

            <!--  Exepense Name  -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!--Add Expense Modal -->
                        <div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="expensModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="expenseModal">Add Expense Name</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo SITE_URL; ?>endpoint/expense.php" method="POST">
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

                                                $stmt = $conn->prepare("SELECT * FROM `tbl_expense_categories`");
                                                $stmt->execute();

                                                $expense_category = $stmt->fetchAll();

                                                ?>

                                                <select class="form-control" name="tbl_expense_category_id" id="expenseCategory">
                                                    <option value="">- select -</option>
                                                    <?php foreach ($expense_category as $category) {
                                                    ?>
                                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name'] ?></option>
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
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo SITE_URL; ?>endpoint/expense.php" method="POST">
                                            <input type="hidden" id="updateExpenseID" name="id">
                                            <div class="form-group">
                                                <label for="updateExpenseName">Expense Name</label>
                                                <input type="text" class="form-control" id="updateExpenseName" name="expense_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateExpenseCategory">Category</label>
                                                <?php

                                                $stmt = $conn->prepare("SELECT * FROM `tbl_expense_categories`");
                                                $stmt->execute();

                                                $expense_category = $stmt->fetchAll();

                                                ?>

                                                <select class="form-control" name="tbl_expense_category_id" id="updateExpenseCategory">
                                                    <option value="">- select -</option>
                                                    <?php foreach ($expense_category as $category) {
                                                    ?>
                                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['category_name'] ?></option>
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
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="data-item">
                            <div class="col-md-12 table-responsive">
                                <div class="col-md-6">
                                    <div class="col">
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
                                        <?php
                                        $stmt = $conn->prepare("
                                            SELECT sum(expense_spent) as total_expenses
                                            FROM `tbl_expenses`
                                            WHERE MONTH(`expense_date`) = MONTH(now())
                                        ");
                                        $stmt->execute();
                                        $result = $stmt->fetch();

                                        if ($result) {
                                            $totalExpenses = $result['total_expenses'];
                                        } else {
                                            $totalExpenses = 0;
                                        }
                                        ?>
                                        <label for="monthlyBudgetInputLeft"><strong>Monthly Budget Left: </strong><span class="btn btn-primary">$<?php echo ($monthlyBudget - $totalExpenses); ?></span></label>
                                    </div>
                                </div>
                                <!-- Table -->
                                <table class="table table-hover table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="10%">#</th>
                                            <th scope="col">Expense Label</th>
                                            <th scope="col" width="20%">Category</th>
                                            <th scope="col" width="25%">Date Spent</th>
                                            <th scope="col" width="10%" style="text-align: right;">Spent</th>
                                            <th scope="col" width="15%" style="text-align: right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $stmt = $conn->prepare("
                                            SELECT
                                                `tbl_expenses`.`id`,
                                                `tbl_expenses`.`tbl_expense_category_id`,
                                                `tbl_expenses`.`expense_name`,
                                                `tbl_expense_categories`.`category_name`,
                                                `tbl_expenses`.`expense_date`,
                                                `tbl_expenses`.`expense_spent`,
                                                `tbl_expenses`.`expense_description`
                                            FROM
                                                `tbl_expenses`
                                            LEFT JOIN tbl_expense_categories ON
                                                `tbl_expenses`.`tbl_expense_category_id` = `tbl_expense_categories`.`id`
                                            WHERE MONTH(`tbl_expenses`.`expense_date`) = MONTH(now())
                                            ORDER BY `tbl_expenses`.`expense_date` DESC
                                            
                                        ");
                                        $stmt->execute();

                                        $result = $stmt->fetchAll();

                                        $i = 1;
                                        $totalExpense = 0;
                                        foreach ($result as $row) {
                                            $expenseID = $row['id'];
                                            $categoryID = $row['tbl_expense_category_id'];
                                            $expenseName = $row['expense_name'];
                                            $categoryName = $row['category_name'];
                                            $expenseDate = date('l, d-m-Y', strtotime($row['expense_date']));
                                            $expenseSpent = $row['expense_spent'];
                                            $expenseDescription = $row['expense_description'];

                                            $totalExpense += $expenseSpent;
                                        ?>

                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td id="categoryID-<?= $expenseID ?>" hidden><?php echo $categoryID ?></td>
                                                <td id="expenseName-<?= $expenseID ?>"><?php echo $expenseName ?></td>
                                                <td id="categoryName-<?= $expenseID ?>"><?php echo $categoryName ?></td>
                                                <td id="expenseDate-<?= $expenseID ?>" data-expense-date="<?php echo $row['expense_date']; ?>"><?php echo $expenseDate ?></td>
                                                <td style="text-align: right;">$<span id="expenseSpent-<?= $expenseID ?>"><?php echo $expenseSpent ?></span></td>
                                                <td style="text-align: right;">
                                                    <div>
                                                        <button type="submit" title="Edit" class="btn btn-sm btn-secondary" onclick="update_expense('<?php echo $expenseID ?>')"><i class="fa-solid fa-pencil"></i></button>
                                                        <button type="button" title="Remove" class="btn btn-sm btn-danger" onclick="delete_expense('<?php echo $expenseID ?>')"><i class="fa-solid fa-trash"></i></button>
                                                        <button type="button" title="View" class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#expenseDescriptionView-<?php echo $expenseID ?>"><i class="fa-solid fa-list"></i></button>
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


                                        <tr style="font-weight: bold;">
                                            <td colspan="4" style="text-align: right;">Total Spent: </td>
                                            <td style="text-align: right;"><span id="totalSpent">$<?php echo $totalExpense; ?></span></td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "includes/footer-scripts.php"; ?>
    <script src="assets/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/jquery-validate/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#addCategory').validate({
                rules: {
                    name: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: "Please provide category name"
                    },
                }
            });
        });

        // update expense
        function update_expense(id) {
            $("#updateExpenseModal").modal("show");

            let updateExpenseName = $("#expenseName-" + id).text();
            let updateCategoryName = $("#categoryName-" + id).text();
            let updateExpenseDate = $("#expenseDate-" + id).data('expense-date');
            let updateExpenseSpent = $("#expenseSpent-" + id).text();
            let updateExpenseDescription = $("#expenseDescription-" + id).text();


            $("#updateExpenseID").val(id);
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


        // delete expense data
        function delete_expense(id) {

            if (confirm("Do you confirm to delete this expense?")) {
                window.location = "endpoint/delete_expense.php?id=" + id
            }
        }
    </script>
</body>

</html>