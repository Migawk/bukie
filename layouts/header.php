<header class="d-flex justfy-content-between align-items-center px-4 py-2">
  <h1 class="logo"><a href="index.php" class="text-dark">Bukie</a></h1>
  <nav class="w-100 d-flex ms-3">
    <ul class="d-flex justfy-content-between gap-2">
      <li><a href="my.php">My Books</a></li>
      <li><a href="search.php">Find More</a></li>
      <?php
      if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] == "AUTHOR") {
        echo "<li><a href=\"edit.php\">Edit</a></li>";
      }
      ?>
    </ul>
  </nav>
  <div class="d-flex justify-content-end">
    <?php if (!isset($_SESSION["user"])) { ?>
      <a href="auth.php">Account</a>
    <?php } else { ?>
      <a href="user.php">
        <?php echo "@" . $_SESSION["user"]["name"] ?>
      </a>
    <?php } ?>
  </div>
</header>