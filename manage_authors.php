<?php 
    include_once("php/admin_authorization.php"); 
    // error_reporting(E_ALL);
    include_once("php/DAL.class.php");

    $conn = new DAL();
    $sql = "SELECT * FROM author";
    $data = $conn->getData($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>Manage Authors</title>
    <script>
        function deleteAuthor(id) {
            $.ajax({
                url: 'api/delete_author.php',
                data: {id},
                method: 'GET'
            })
            .done(function(data){
                if (data > -1) {
                    alert('deleted author')
                }
            })
        }        
    </script>
</head>
<body>
    <?php require("header.php"); ?>
    <!-- FIXME: make these into a class -->
    <div class="flex">
        <a href="add_author.php" style="padding: 1rem; margin: 0.4rem; color: white; background: black">Add Author</a>
    </div>
    <div class="flex">
        <table class="table" cellpadding="15">
            <tbody class="">
                <?php
                    // For debugging
                    $arr = json_decode($data);
                    foreach($arr as $cat) {
                        echo "<tr> <td> ". $cat->name ." </td> <td> <button class='button button-danger' onclick='deleteAuthor(".$cat->id.")'>Delete</button> </td> <td> <a class='button button-link' href='edit_author.php?id=".$cat->id."'>Edit</a> </td> </tr>";        
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>