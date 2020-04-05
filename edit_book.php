<?php require("php/admin_authorization.php") ?>
<?php
    include_once("php/DAL.class.php");
    // echo "what";
    $conn = new DAL();
    $conn->connect();
    
    $id = $conn->escape($_GET["id"]);
    
    $sql = "SELECT * FROM book WHERE id='$id'";
    $data = $conn->getData($sql);

    $book_data = json_decode($data)[0];

    $sql = "SELECT * FROM categories";
    $categories = $conn->getData($sql);

    $sql = "SELECT * FROM author";
    $authors = $conn->getData($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require("head.php");
    ?>
    <title>Update Book</title>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        updateForm.onsubmit = e => {
            e.preventDefault()

            const titleVal = title.value;
            const quantityVal = quantity.value;
            const priceVal = price.value;
            const dateVal = publication_date.value;
            const ISBNVal = ISBN.value;
            const idVal = id.value;

            const authorVal = authors.value;
            const categoriesVal = categories.value;

            $.ajax({
                url: 'api/update_book.php',
                data: {id: idVal, quantity: quantityVal, 
                        title: titleVal, price: priceVal, date: dateVal, 
                        categories: categoriesVal, author: authorVal, isbn: ISBNVal,
                        },
                method: 'POST',
            })
            .done( function(data) {
                console.log(data)
            })
        }
    })
    </script>
</head>
<body>
    <?php require("header.php") ?>
    <div class="flex-column">
        <form action="" class="flex-column card" id="updateForm">
            <h1>Update</h1>
            <input type="hidden" id="id" value="<?php echo $book_data->id; ?>">
            <div class="form-group">
                <input type="text" id="title" value="<?php echo $book_data->title ?>">
            </div>
            <div class="form-group">
                <input type="number" id="quantity" value="<?php echo $book_data->quantity ?>">
            </div>
            <div class="form-group">
                <input type="number" id="price" value="<?php echo $book_data->price ?>">
            </div>
            <div class="form-group">
                <input type="date" id="publication_date" value="<?php echo substr($book_data->publication_date, 0, 10); ?>">
            </div>
            <div class="form-group">
                <input type="text" id="ISBN" value="<?php echo $book_data->ISBN ?>">
            </div>
            <!-- Select tag for authors -->
            <div class="form-group">
                <select id="authors" id="">
                    <option value="">Choose author</option>
                    <?php 
                        $arr = json_decode($authors);
                        foreach ($arr as $cat) {
                            echo "<option value='$cat->id'>$cat->name</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- Select tag for categories -->
            <div class="form-group">
                <select id="categories" id="">
                    <option value="">Choose category</option>
                    <?php 
                        $arr = json_decode($categories);
                        foreach ($arr as $cat) {
                            echo "<option value='$cat->id'>$cat->name</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="reset" class="button" value="Reset to default">
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="update book">
            </div>
        </form>
    </div>
</body>
</html>