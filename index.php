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
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>assets/css/captcha.css" />

</head>

<body>
    <div class="main-panel mt-4 col-11">
        <div class="d-flex justify-content-center align-items-lg-center h-100 position-relative">
            <?php include_once "includes/notifications.php"; ?>

            <!-- Login  -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <div class="data-item">
                            <div class="row">
                                <div class="col">
                                    <div id="notifyLogin"></div>
                                    <form id="loginForm" action="<?php echo SITE_URL; ?>endpoint/login.php" method="POST">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="captcha">Captcha</label>
                                            <div class="d-flex align-items-center">
                                                <div id="image" class="inline" selectable="false"></div>
                                                <input type="text" class="form-control" id="captcha" maxlength="4" name="captcha">
                                            </div>
                                        </div>
                                        <div class="row mt-3 align-items-center">
                                            <div class="col-lg-12" style="text-align: right;">
                                                <button type="submit" class="btn btn-dark px-4">Login</button>
                                            </div>
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
    <script src="assets/js/captcha.js"></script>
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