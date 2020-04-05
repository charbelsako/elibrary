<?php session_start(); ?>
<header class="flex" style="justify-content: left;">
      <ul class="nav">
        <li>
          <a href="index.php">
            <img src="assets/logo.png" alt="" width="64" height="64" />
          </a>
        </li>
        <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == 2) { ?>
          <li>
            <a href="manage_books.php">Manage books</a>
          </li>
          <li>
            <a href="manage_categories.php">Manage categories</a>
          </li>
          <li>
            <a href="manage_authors.php">Manage authors</a>
          </li>
          <li>
            <a href="manage_users.php">Manage users</a>
          </li>
        <?php } else { ?>
          

          <li>
            <a href="category.php">
              Categories
            </a>
          </li>

          <li>
            <a href="new.php">
              New Releases
            </a>
          </li>

          <li>
            <a href="search.php">
              Search
            </a>
          </li>

          <li>
            <a href="cart.php">
              Cart
            </a>
          </li>
        <?php } ?>
        <li>
          
        </li>
      </ul>
      <ul class="nav" style="margin-left: auto;">
        <?php if (!isset($_SESSION["id"])) { ?>
            <li>
              <a href="login.php">Login</a>
            </li>
            <li>
              <a href="register.php">Register</a>
            </li>
        <?php } else { ?>
          <li>
            <a href="logout.php">Logout</a>
          </li>
          <li>
            <a href="profile.php"> <?php echo $_SESSION["username"] ?> </a>
          </li>
        <?php } ?>
          </ul>
</header>