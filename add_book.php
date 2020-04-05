<?php require("php/admin_authorization.php") ?>
<?php
    include_once("php/DAL.class.php");
    // echo "what";
    $conn = new DAL();
    
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

            const authorVal = authors.value;
            const categoriesVal = categories.value;

            $.ajax({
                url: 'api/add_book.php',
                data: {quantity: quantityVal, 
                        title: titleVal, price: priceVal, date: dateVal, 
                        categories: categoriesVal, author: authorVal, isbn: ISBNVal,
                        },
                method: 'POST',
            })
            .done( function(data) {
                if (data > -1){
                    location.href = "manage_books.php"
                }
            })
        }
    })
    </script>
</head>
<body>
    <?php require("header.php") ?>
    <div class="flex-column">
        <form action="" class="flex-column card" id="updateForm">
            <h1>Add New Book</h1>
            <div class="form-group">
                <input type="text" id="title" placeholder="title">
            </div>
            <div class="form-group">
                <input type="number" id="quantity" placeholder="quantity">
            </div>
            <div class="form-group">
                <input type="number" id="price" placeholder="price">
            </div>
            <div class="form-group">
                <input type="date" id="publication_date" placeholder="published date">
            </div>
            <div class="form-group">
                <input type="text" id="ISBN" placeholder="ISBN">
            </div>
            <!-- Select tag for authors -->
            <div class="form-group">
                <select id="authors">
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