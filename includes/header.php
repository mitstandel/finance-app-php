<nav class="navbar navbar-expand-lg navbar-dark bg-dark col-12 d-flex align-items-center justify-content-between px-lg-5 px-3">
  <a class="navbar-brand flex-grow-1 d-flex gap-2" href="#"><img src="<?php echo SITE_URL;?>assets/images/logo.png" height="30" alt="Logo"><span class="d-none d-lg-block"> Personal Finance Manager</span></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if (isset($_SESSION['MAIN'])) { ?>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-3">
          <a class="nav-link p-0" href="<?php echo SITE_URL; ?>dashboard.php">
            Dashboard
          </a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link p-0" href="<?php echo SITE_URL; ?>expenses.php">
            Expenses
          </a>
        </li>
        <li class="nav-item me-3">
          <a class="nav-link p-0" href="<?php echo SITE_URL; ?>categories.php">
            Categories
          </a>
        </li>
        <li class="nav-item mr-5">
          <span class="text-white pe-2"><?php echo $_SESSION['NAME']; ?></span>
          <a class="btn btn-danger btn-sm" title="Logout" href="<?php echo SITE_URL; ?>endpoint/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a>
        </li>
      </ul>
    </div>
  <?php } ?>
</nav>

<?php
if (isset($_SESSION['ERROR'])) {
?>
  <div class="toast position-absolute top-0 end-0 align-items-center bg-danger show" data-bs-autohide="false" data-bs-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body text-white">
        <?php echo $_SESSION['ERROR'];?>
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
<?php
  unset($_SESSION['ERROR']);
}
?>

<?php
if (isset($_SESSION['SUCCESS'])) {
?>
  <div class="toast position-absolute top-0 end-0 align-items-center bg-success show" data-bs-autohide="false" data-bs-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body text-white">
        <?php echo $_SESSION['SUCCESS'];?>
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
<?php
  unset($_SESSION['SUCCESS']);
}
?>