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

            <?php
                $stmt = $conn->prepare("
                    SELECT u.*, l.username FROM `user` as u
                    INNER JOIN `login` as l
                        ON l.user_id = u.user_id
                    where u.user_id = :user_id
                ");
                $stmt->execute([
                    ':user_id' => $_SESSION['USERID'],
                ]);
                $userData = $stmt->fetch();
            ?>

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
                                            <?php echo $userData['firstname']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Last Name:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            <?php echo $userData['lastname']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Address:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            <?php echo $userData['address']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Mobile Number:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            <?php echo $userData['mobile']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            E-mail Address:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            <?php echo $userData['email']; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-group col-lg-4">
                                            Username:
                                        </label>
                                        <div class="form-group col-lg-8">
                                            <?php echo $userData['username']; ?>
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