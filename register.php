<?php
include_once "bootstrap.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <?php include_once "includes/head-content.php"; ?>

    <style>
        .main-panel {
            height: 90vh;
        }

        .card-body {
            font-size: small;
        }

        /* Custom CSS */
        .main-panel,
        .card {
            margin: auto;
            overflow-y: auto;
        }
    </style>

</head>

<body>
    <?php include_once "includes/notifications.php"; ?>
    <div class="main-panel mt-4 col-11">
        <div class="d-flex justify-content-center align-items-lg-center h-100">

            <!-- Login  -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Register
                    </div>
                    <div class="card-body">

                        <div class="data-item">
                            <div class="row">
                                <div class="col">
                                    <div id="notifyLogin"></div>
                                    <form id="loginForm" action="<?php echo SITE_URL;?>endpoint/register.php" method="POST">
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label for="firstName">First Name</label>
                                                <input type="text" class="form-control" id="firstName" name="first_name">
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
                                        <div class="row mt-2">
                                            <div class="form-group col-lg-6">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="verifyPassword">Verify Password</label>
                                                <input type="password" class="form-control" id="verifyPassword" name="verify_password">
                                            </div>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <button type="submit" class="btn btn-dark px-5">Register</button>
                                        </div>
                                        <div class="mt-4 text-center">
                                            Already registered? <a href="./">Click here</a> here to login.
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
    <script src="assets/jquery-validate/jquery.validate.min.js"></script>
    <script src="assets/jquery-validate/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#loginForm').validate({
                showErrors: function(errorMap, errorList) {
                    var summary = "";
                    var i = 0;
                    jQuery.each(errorList, function() {
                        if (i == 0) summary = this.message;
                        i++;
                    });

                    if (summary != '') {
                        jQuery("div#notifyLogin").html('<div class="error">' + summary + '</div>');
                    } else {
                        jQuery("div#notifyLogin").html('');
                    }
                    //this.defaultShowErrors();
                },
                rules: {
                    email: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Please provide your account email address"
                    },
                    password: {
                        required: "Please provide your password"
                    }
                }
            });
        });
    </script>
</body>

</html>