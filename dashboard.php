<?php
include_once "auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager</title>

    <?php include_once "includes/head-content.php"; ?>

</head>

<body>

    <?php include_once SITE_PATH . "includes/header.php"; ?>

    <div class="main-panel mt-4 container">
        <div class="row">

            <div class="col-12">
                <h1 class="text-bold"><?php echo date('F Y'); ?></h1>
            </div>

            <!-- Expense Category  -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        This Monthly Report
                    </div>
                    <div class="card-body">

                        <div class="data-item">
                            <div class="col-md-12">
                                <div class="row">
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
                                        <div class="card text-white bg-primary text-center mb-3">
                                            <div class="card-header">Total Monthly Budget</div>
                                            <div class="card-body">
                                                <h2>$<?php echo $monthlyBudget; ?></h2>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col">
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
                                        <div class="card text-white bg-secondary text-center mb-3">
                                            <div class="card-header">Total Monthly Spent</div>
                                            <div class="card-body">
                                                <h2>$<?php echo $totalExpenses; ?></h2>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card text-white bg-success text-center mb-3">
                                            <div class="card-header">Monthly Budget Left</div>
                                            <div class="card-body">
                                                <h2>$<?php echo ($monthlyBudget - $totalExpenses); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expense Category  -->
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        Category-wise Spents
                    </div>
                    <div class="card-body table-responsive">

                        <!-- Table -->
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Total Spent</th>
                                    <th scope="col">Remaining</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $stmt = $conn->prepare("
                                    SELECT
                                        `tbl_expense_categories`.`id`,
                                        `tbl_expense_categories`.`category_name`,
                                        `tbl_expense_categories`.`category_budget`,
                                        sum(`tbl_expenses`.`expense_spent`) as total_spent,
                                        (`tbl_expense_categories`.`category_budget` - sum(`tbl_expenses`.`expense_spent`)) as remaining
                                    FROM
                                        `tbl_expense_categories`
                                    LEFT JOIN tbl_expenses ON
                                        `tbl_expenses`.`tbl_expense_category_id` = `tbl_expense_categories`.`id`
                                    WHERE
                                        MONTH(`tbl_expenses`.`expense_date`) = MONTH(now())
                                    GROUP BY `tbl_expense_categories`.`id`
                                    ORDER BY
                                        `tbl_expense_categories`.`category_name`;
                                ");
                                $stmt->execute();

                                $result = $stmt->fetchAll();

                                $i = 1;
                                $totalBudget = $totalSpent = $totalRemain = 0;
                                foreach ($result as $row) {

                                    $categoryID = $row['id'];
                                    $categoryName = $row['category_name'];
                                    $categoryBudget = $row['category_budget'];
                                    $categorySpent = $row['total_spent'];
                                    $categoryRemain = $row['remaining'];

                                    $totalBudget += $categoryBudget;
                                    $totalSpent += $categorySpent;
                                    $totalRemain += $categoryRemain;

                                ?>

                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $categoryName ?></td>
                                        <td style="text-align: right;">$<?php echo $categoryBudget ?></td>
                                        <td style="text-align: right;">$<?php echo $categorySpent ?></td>
                                        <td style="text-align: right;">$<?php echo $categoryRemain ?></td>
                                    </tr>

                                <?php

                                }

                                ?>

                                <tr style="font-weight: bold;">
                                    <td colspan="2" style="text-align: right;">Total: </td>
                                    <td style="text-align: right;">$<?php echo $totalBudget ?></td>
                                    <td style="text-align: right;">$<?php echo $totalSpent ?></td>
                                    <td style="text-align: right;">$<?php echo $totalRemain ?></td>
                                </tr>

                            </tbody>
                        </table>
                        </ul>
                    </div>
                </div>
            </div>

            <!--  Exepense Name  -->
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        Latest Expenses This Month
                    </div>

                    <div class="card-body">

                        <div class="data-item">
                            <div class="col-md-12 table-responsive">
                                <!-- Table -->
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Date Spent</th>
                                            <th scope="col">Spent</th>
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
                                            LIMIT 5
                                        ");
                                        $stmt->execute();

                                        $result = $stmt->fetchAll();

                                        $i = 1;
                                        $totalSpent = 0;
                                        foreach ($result as $row) {
                                            $expenseID = $row['id'];
                                            $categoryID = $row['tbl_expense_category_id'];
                                            $expenseName = $row['expense_name'];
                                            $categoryName = $row['category_name'];
                                            $expenseDate = date('l, d-m-Y', strtotime($row['expense_date']));
                                            $expenseSpent = $row['expense_spent'];
                                            $expenseDescription = $row['expense_description'];

                                            $totalSpent += $expenseSpent;
                                        ?>

                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td id="categoryID-<?= $expenseID ?>" hidden><?php echo $categoryID ?></td>
                                                <td id="expenseName-<?= $expenseID ?>"><?php echo $expenseName ?></td>
                                                <td id="categoryName-<?= $expenseID ?>"><?php echo $categoryName ?></td>
                                                <td id="expenseDate-<?= $expenseID ?>"><?php echo $expenseDate ?></td>
                                                <td id="expenseSpent-<?= $expenseID ?>" style="text-align: right;">$<?php echo $expenseSpent ?></td>
                                            </tr>
                                            <tr class="collapse" id="expenseDescriptionView-<?= $expenseID ?>">
                                                <td colspan="2">Expense Description:</td>
                                                <td colspan="6" id="expenseDescription-<?= $expenseID ?>"><?php echo $expenseDescription ?></td>
                                            </tr>

                                        <?php
                                        }

                                        ?>


                                        <tr style="font-weight: bold;">
                                            <td colspan="4">Total Spent: </td>
                                            <td colspan="2" style="text-align: right;">$<?php echo $totalSpent; ?></td>
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
</body>

</html>