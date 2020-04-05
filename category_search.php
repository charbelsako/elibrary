<?php
if (!isset($_GET["id"])) {
    echo "No Id was provided";
    exit;
}

require("php/DAL.class.php");

$conn = new DAL();
$conn->connect();
$id = $conn->escape($_GET["id"]);
$sql = "SELECT * FROM book JOIN categories ON categories.id = book.category_id WHERE category_id='$id'";
$data = $conn->getData($sql);
$array = json_decode($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>Category <?php echo $array[0]->name?> </title>
</head>
<body>
<?php require("header.php"); ?>
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
</body>
</html>