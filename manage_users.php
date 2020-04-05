<?php 
    include_once("php/admin_authorization.php"); 
    // error_reporting(E_ALL);
    include_once("php/DAL.class.php");

    $conn = new DAL();
    $sql = "SELECT * FROM user";
    $data = $conn->getData($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>Manage Categories</title>
    <script>
        function deleteUser(id) {
            // console.log(id)
            $.ajax({
                url: 'api/delete_user.php',
                data: {id},
                method: 'GET'
            })
            .done(function(data){
                if (data > -1) {
                    alert('deleted user')
                }
            })
        }        
    </script>
</head>
<body>
    <?php require("header.php"); ?>
    <!-- FIXME: make these into a class -->
    <div class="flex">
        <a href="add_user.php" style="padding: 1rem; margin: 0.4rem; color: white; background: black;">Add new user</a>
    </div>
    <div class="flex">
        <table border="1" style="background: white; border: 1px solid black;" cellpadding="15">
            <tbody class="">
                <?php
                    // For debugging
                    $arr = json_decode($data);
                    foreach($arr as $user) {
                        echo "<tr> <td> ". $user->name ."</td> <td>". $user->type ."</td> <td>". $user->email ." </td> <td> <button class='button button-danger' onclick='deleteUser(".$user->id.")'>Delete</button> </td> <td> <a class='button button-link' href='edit_user.php?id=". $user->id ."'>Edit</a> </td> </tr>";        
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>