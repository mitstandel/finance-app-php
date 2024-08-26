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

            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1 class="text-bold">Categories</h1>
                <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#expenseCategoryModal">&#43; Add</button>
            </div>

            <!-- Expense Category  -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Button trigger modal -->


                        <!--Add Category Modal -->
                        <div class="modal fade" id="expenseCategoryModal" tabindex="-1" role="dialog" aria-labelledby="expenseCategoryModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="expenseCategoryModal">Add Expense Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addCategory" action="<?php echo SITE_URL; ?>endpoint/category.php" method="POST">
                                            <div class="form-group">
                                                <label for="expenseCategoryName">Category Name</label>
                                                <input type="text" class="form-control" id="expenseCategoryName" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategoryBudget">Budget</label>
                                                <input type="number" class="form-control" id="expenseCategoryBudget" name="budget">
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

                        <!-- Update Category Modal -->
                        <div class="modal fade" id="updateExpenseCategoryModal" tabindex="-1" role="dialog" aria-labelledby="updateExpenseCategoryModal" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateExpenseCategoryModal">Update Expense Category</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo SITE_URL; ?>endpoint/category.php" method="POST">
                                            <input type="hidden" class="form-control" id="updateExpenseCategoryID" name="id">
                                            <div class="form-group">
                                                <label for="expenseCategoryName">Category Name</label>
                                                <input type="text" class="form-control" id="updateExpenseCategoryName" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="expenseCategoryBudget">Budget</label>
                                                <input type="text" class="form-control" id="updateExpenseCategoryBudget" name="budget">
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
                            <ul class="list-group col-md-12">
                                <!-- Table -->
                                <table class="table table-hover table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="10%">#</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col" width="20%" style="text-align: right;">Monthly Budget</th>
                                            <th scope="col" width="20%" style="text-align: right;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $stmt = $conn->prepare("SELECT * FROM `tbl_expense_categories`");
                                        $stmt->execute();

                                        $result = $stmt->fetchAll();

                                        $i = 1;
                                        $totalBudget = 0;
                                        foreach ($result as $row) {

                                            $categoryID = $row['id'];
                                            $categoryName = $row['category_name'];
                                            $categoryBudget = $row['category_budget'];

                                            $totalBudget += $categoryBudget;

                                        ?>
                                            <tr>
                                                <td><?php echo $i++ ?></td>
                                                <td id="categoryName-<?= $categoryID ?>"><?php echo $categoryName ?></td>
                                                <td style="text-align: right;">$<span id="categoryBudget-<?= $categoryID ?>"><?php echo $categoryBudget ?></span></td>
                                                <td style="text-align: right;">
                                                    <div>
                                                        <button type="submit" title="Edit" onclick="update_category('<?php echo $categoryID ?>')" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pencil"></i></button>
                                                        <button type="button" title="Remove" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" onclick="delete_category('<?php echo $categoryID ?>')"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php

                                        }

                                        ?>

                                        <tr style="font-weight: bold;">
                                            <td colspan="2" style="text-align: right;">Total Category Budget: </td>
                                            <td style="text-align: right;">$<?php echo $totalBudget; ?></td>
                                            <td></td>
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

        // update category
        function update_category(id) {
            $("#updateExpenseCategoryModal").modal("show");

            let updateCategoryName = $("#categoryName-" + id).text();
            let updateCategoryBudget = $("#categoryBudget-" + id).text();

            $("#updateExpenseCategoryID").val(id);
            $("#updateExpenseCategoryName").val(updateCategoryName);
            $("#updateExpenseCategoryBudget").val(parseInt(updateCategoryBudget));
        }

        // delete resident data
        function delete_category(id) {
            if (confirm("Do you confirm to delete this category?")) {
                window.location = "<?php echo SITE_URL;?>endpoint/delete_category.php?id=" + id
            }
        }
    </script>
</body>

</html>