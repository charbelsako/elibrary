<?php
    require("../php/DAL.class.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM book WHERE id = ". $id;
    $conn = new DAL();
    echo $conn->ExecuteQuery($sql);

?>