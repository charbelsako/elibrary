<?php require("php/admin_authorization.php") ?>
<?php
    include_once("php/DAL.class.php");
    // echo "what";
    $conn = new DAL();
    $conn->connect();
    
    $id = $conn->escape($_GET["id"]);
    
    $sql = "SELECT * FROM author WHERE id='$id'";
    $data = $conn->getData($sql);

    $author_data = json_decode($data)[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require("head.php");
    ?>
    <title>Update Author</title>
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        updateForm.onsubmit = e => {
            e.preventDefault()

            const idVal = id.value;
            const nameVal = authorName.value;
            console.log(nameVal)

            $.ajax({
                url: 'api/update_author.php',
                data: {id: idVal, name: nameVal},
                method: 'POST',
            })
            .done( function(data) {
                if (data > -1) {
                    alert("updated author")
                    location.href = "manage_authors.php"
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
            <h1>Update Author</h1>
            <input type="hidden" id="id" value="<?php echo $author_data->id; ?>">
            <div class="form-group">
                <input type="text" id="authorName" value="<?php echo $author_data->name ?>">
            </div>
            
            <div class="form-group">
                <input type="reset" class="button" value="Reset to default">
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="Update author">
            </div>
        </form>
    </div>
</body>
</html>