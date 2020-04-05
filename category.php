<?php
  require("php/DAL.class.php");
  $conn = new DAL();
  $sql = "SELECT id, name FROM categories";
  $data = $conn->getData($sql);
  $array = json_decode($data);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require("head.php") ?>
    <title>Categories</title>
  </head>
  <body>
  <?php 
    require("header.php");
  ?>
    <div class="" style="background: white;">
      <ul class="categories">
        <?php 
          foreach ($array as $link) {
            echo '<li> <a href="category_search.php?id='.$link->id.'">'.$link->name.'</a> </li>';
          }
        ?>
      </ul>
    </div>
  </body>
</html>
