<?php 
session_start();
require("php/authorization.php"); 
?>

<?php 
  require_once("php/DAL.class.php");
  $conn = new DAL();
  $conn->connect();
  $id = $conn->escape($_SESSION["id"]);
  $sql = "SELECT cart.user_id, book.id, book.title, book.price, COUNT(book.ISBN) as quant, SUM(book.price) as total 
    FROM cart JOIN book ON book.id = cart.book_id 
    WHERE user_id='$id' 
    GROUP BY book.isbn
    WITH ROLLUP";
  $data = $conn->getData($sql);
  $array = json_decode($data);
  $last_row = array_splice($array, sizeof($array) - 1);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require("head.php"); ?>
    <title>Cart</title>
    <script>
      function removeFromCart(bookId, userId) {
        let answer = confirm("Are you sure you want to delete this item from your cart")
        if (!answer) {
          return;
        }

        $.ajax({
          url: 'api/delete_from_cart.php',
          data: {book_id: bookId, user_id: userId},
          method: 'GET'
        })
        .done(function(data) {
          if (data > -1) {
            alert("Removed From Cart. Reload Page")
          }
        })
      }
    </script>
  </head>
  <body>
  <div class="flex">
    <table class="table">
    <thead>
      <tr><th>Title</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
      <th></th></tr>
    </thead>
    <tbody>
    <?php
      require("header.php");
      
      foreach ($array as $book) {
        // var_dump($book);
        $row .= '<tr> 
        <td> '. $book->title .' </td> 
        <td> '. $book->price .'$</td> 
        <td> '. $book->quant .'</td> 
        <td> '. $book->total .'$</td> 
        <td> <button class="button button-danger" onclick="removeFromCart('. $book->id .','. $book->user_id .')"> Remove </button> </td> 
        </tr>';
      }
      $row .= '<tr> <td colspan="3"> </td> <td>'. $last_row[0]->total .'$</td> 
      <td>  <button class="button"> Checkout </button> </td> 
      </tr>';
      echo $row;
    ?>
    </tbody>
    </table>
    </div>
  </body>
</html>
