<nav class="navbar navbar-expand-lg navbar-dark bg-dark col-12">
  <a class="navbar-brand ml-5" href="#">Personal Finance Manager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if (isset($_SESSION['MAIN'])) { ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto mr-5">
      <li class="nav-item dropdown mr-1">
        <a class="nav-link" href="<?php echo SITE_URL;?>expenses.php">
          Expenses
        </a>
      </li>
      <li class="nav-item dropdown mr-1">
        <a class="nav-link" href="<?php echo SITE_URL;?>categories.php">
          Categories
        </a>
      </li>
      <li class="nav-item dropdown mr-5">
        <a class="nav-link dropdown-toggle" href="javascript:;" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['NAME'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Vew Account</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo SITE_URL;?>endpoint/logout.php">Log Out</a>
        </div>
      </li>
    </ul>
  </div>
  <?php } ?>
</nav>