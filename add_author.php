<?php require("php/admin_authorization.php") ?>
<?php
    include_once("php/DAL.class.php");

    $conn = new DAL();
    
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

            const nameVal = title.value;
            console.log(nameVal)

            $.ajax({
                url: 'api/add_author.php',
                data: { name: nameVal },
                method: 'POST',
            })
            .done( function(data) {
                if (data > -1){
                    location.href = "manage_authors.php"
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
            <h1>Add Author</h1>
            <div class="form-group">
                <input type="text" id="title" placeholder="Author name" autofocus>
            </div>
            
            <div class="form-group">
                <input type="reset" class="button" value="Reset to default">
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="Add Author">
            </div>
        </form>
    </div>
</body>
</html>