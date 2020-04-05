<?php
if(!isset($_GET["search"])) {
    echo "Nothing to search for";
    exit;
}

require("../php/DAL.class.php");
$conn = new DAL();
$conn->connect();

$search = $conn->escape($_GET["search"]);
$sql = "SELECT * FROM book WHERE title LIKE '%$search%'";
$data = $conn->getData($sql);

echo $data;

?>