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

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="data-item">
                            <div class="row">
                                <div class="col">
                                    <div id="notifyLogin"></div>
                                    <form id="loginForm" action="<?php echo SITE_URL;?>endpoint/login.php" method="POST">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="firstName">First Name</label>
                                                <input type="text" class="form-control" id="firstName" name="first_name" readonly>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="lastName">Last Name</label>
                                                <input type="text" class="form-control" id="lastName" name="last_name">
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address">
                                        </div>
                                        <div class="row mt-2">
                                            <div class="form-group col-lg-6">
                                                <label for="mobile">Mobile Number</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile">
                                            </div>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                    </form>
                                </div>
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