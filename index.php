<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require("head.php") ?>

    <?php
      require("php/DAL.class.php");

      $database = new DAL();
      $sql = "SELECT * FROM book";
      $data = $database->getData($sql);
      $array = json_decode($data);
    ?>
    <title>Homepage</title>
    <script>
      function addToCart(id) {
        $.ajax({
            url: 'api/add_to_cart.php',
            data: {book_id: id},
            method: 'GET'
        })
        .done(function(data){
          if (data <= -1){
            alert("Something went wrong")
          }
            console.log(data)
        })
        return;
        
      }

      function addToCartThenGo(id) {
        $.ajax({
            url: 'api/add_to_cart.php',
            data: {book_id: id},
            method: 'GET'
        })
        .done(function(data){
          if (data <= -1){
            alert("Something went wrong")
          }
            console.log(data)
            location.href = "cart.php"
        })
        return;
        
      }
    </script>
  </head>
  <body>
    <?php require("header.php") ?>
    <h1>Books</h1>
    <main class="flex">
    <?php
      foreach ($array as $book) {
        $html .= '<div class="card flex-column">
        <h3 class="card-header" data-id="'.$book->id.'">'.$book->title.'</h3>
        <a href="book_details.php?id='.$book->id.'">
          <img
            class="card-image"
            alt=""
            src="http://covers.openlibrary.org/b/isbn/'.$book->ISBN.'-M.jpg"
          />
        </a>
        <div class="flex">
          <button class="button" onclick="addToCart('.$book->id.')">
            Add to Cart
          </button>
          <button class="button" onclick="addToCartThenGo('.$book->id.')">
            Buy now
          </button>
        </div>
      </div>';
    }
    echo $html;
    ?>
    </main>
  </body>
</html>
