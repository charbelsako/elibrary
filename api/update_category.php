<?php
    require("../php/DAL.class.php");

    $conn = new DAL();
    $conn->connect();

    $id = $conn->escape($_POST['id']);
    $name = $conn->escape($_POST['name']);    
    
    $sql = "UPDATE categories SET name='$name' WHERE id='$id'";
    echo $conn->ExecuteQuery($sql);
?>
