<?php 
    include_once("php/admin_authorization.php"); 
    // error_reporting(E_ALL);
    include_once("php/DAL.class.php");

    $conn = new DAL();
    $sql = "SELECT * FROM categories";
    $data = $conn->getData($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>Manage Categories</title>
    <script>
        function deleteBook(id) {
            // console.log(id)
            $.ajax({
                url: 'api/delete_category.php',
                data: {id},
                method: 'GET'
            })
            .done(function(data){
                if (data > -1) {
                    alert('deleted category')
                }
            })
        }        
    </script>
</head>
<body>
    <?php require("header.php"); ?>
    <!-- FIXME: make these into a class -->
    <div class="flex">
        <a href="add_category.php" style="padding: 1rem; margin: 0.4rem; color: white; background: black">Add new category</a>
    </div>
    <div class="flex">
        <table border="1" style="background: white; border: 1px solid black;" cellpadding="15">
            <tbody class="">
                <?php
                    // For debugging
                    $arr = json_decode($data);
                    foreach($arr as $cat) {
                        echo "<tr> <td> ". $cat->name ." </td> <td> <button class='button button-danger' onclick='deleteBook(".$cat->id.")'>Delete</button> </td> <td> <a class='button button-link' href='edit_category.php?id=".$cat->id."'>Edit</a> </td> </tr>";        
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>