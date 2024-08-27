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
    <div class="main-panel mt-4 col-11">
        <div class="d-flex justify-content-center align-items-lg-center h-100">

            <!-- Login  -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Verification Pending
                    </div>
                    <div class="card-body">
                        <p>Your registration has been successfully done. To login, please verify your email address from the link provided in the verification email sent to your registered email address.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>