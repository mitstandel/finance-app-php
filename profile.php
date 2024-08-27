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

            <div class="col-12">
                <h1 class="text-bold">Your Profile</h1>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="data-item">
                            <div class="row">
                                <div class="col">
                                    <div id="notifyLogin"></div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            First Name:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            John
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Last Name:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            Doe
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Address:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            202 Infinity Drive, Truganina VIC 3029, Australia
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Mobile Number:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            05634534532
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            E-mail Address:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            graphic.vb@gmail.com
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Username:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            johndoe
                                        </div>
                                    </div>
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