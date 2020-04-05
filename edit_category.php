<?php require("php/admin_authorization.php") ?>
<?php
    include_once("php/DAL.class.php");
    // echo "what";
    $conn = new DAL();
    $conn->connect();
    
    $id = $conn->escape($_GET["id"]);
    
    $sql = "SELECT * FROM categories WHERE id='$id'";
    $data = $conn->getData($sql);

    $category_data = json_decode($data)[0];
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

            const idVal = id.value;
            const nameVal = catName.value;
            console.log(nameVal)

            $.ajax({
                url: 'api/update_category.php',
                data: {id: idVal, name: nameVal},
                method: 'POST',
            })
            .done( function(data) {
                if (data > -1) {
                    alert("updated category")
                    location.href = "manage_categories.php"
                    console.log(data)
                }
            })
        }
    })
    </script>
</head>
<body>
    <?php require("header.php"); ?>
    <div class="flex-column">
        <form action="" class="flex-column card" id="updateForm">
            <h1>Update Category</h1>
            <input type="hidden" id="id" value="<?php echo $category_data->id; ?>">
            <div class="form-group">
                <input type="text" id="catName" value="<?php echo $category_data->name ?>">
            </div>
            
            <div class="form-group">
                <input type="reset" class="button" value="Reset to default">
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="update category">
            </div>
        </form>
    </div>
</body>
</html>