<?php
include_once "bootstrap.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Finance Manager</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

    <div class="main-panel mt-4 ml-5 col-11">
        <div class="row justify-content-center align-items-center h-100">

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
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="modal-footer">
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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