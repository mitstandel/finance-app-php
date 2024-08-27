<?php if (isset($_SESSION['MAIN'])) { ?>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item mr-5">
          <span class="text-white pe-2">Your Profile</span>
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