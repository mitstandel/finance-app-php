<?php
include_once "../bootstrap.php";
			
unset($_SESSION['USERID']);
unset($_SESSION['EMAIL']);
unset($_SESSION['NAME']);

session_destroy();

redirect(SITE_URL);
