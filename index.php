<?php
include_once "bootstrap.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager</title>

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

    <?php include_once SITE_PATH."includes/header.php"; ?>

    <div class="main-panel mt-4 col-11">
        <div class="d-flex justify-content-center align-items-lg-center h-100">

            <!-- Login  -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <div class="data-item">
                            <div class="row">
                                <div class="col">
                                    <div id="notifyLogin"></div>
                                    <form id="loginForm" action="<?php echo SITE_URL;?>endpoint/login.php" method="POST">
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="modal-footer mt-2">
                                            <button type="submit" class="btn btn-dark">Login</button>
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