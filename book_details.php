<?php 
require_once("php/DAL.class.php");

if (!isset($_GET["id"])) {
    echo "No book id was provided";
    exit;
}

$id = $_GET["id"]; 
$db = new DAL();
$sql = "SELECT * FROM book WHERE id = $id";
$data = $db->getData($sql);
$array = json_decode($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>Book details</title>
    <script>
        let isbn = "<?php echo $array[0]->ISBN; ?>";
        console.log(isbn)
        // get data from api
        document.addEventListener('DOMContentLoaded', () => {
            $.ajax({
                url: 'http://openlibrary.org/api/books?jscmd=data&format=json&bibkeys=ISBN:' + isbn,
                method: 'GET',
            })
            .done( data => {
                console.log(data[`ISBN:${isbn}`])
                bookData = data[`ISBN:${isbn}`]
                // Show data
                numberOfPages.innerText += " " + bookData.number_of_pages;
                publishDate.innerText += " " + bookData.publish_date;
                title.innerText += " " + bookData.title;
                publishers.innerText += " " + bookData.publishers.map(obj => obj.name).join(" ")
                price.innerText += " " + <?php echo $array[0]->price ?>  + "$"
            })
        })
    </script>
</head>
<body>
    <?php require("header.php"); ?>
    <div class="flex">
    <div class="card flex-column">
        <img src="http://covers.openlibrary.org/b/isbn/<?php echo $array[0]->ISBN; ?>-M.jpg" alt="">
        <p id="title">Title: </p>
        <p id="price">Price: </p>     
        <p id="numberOfPages">Number of pages: </p>
        <p id="publishDate">Published: </p>
        <p id="publishers">Publishers: </p>
    </div>
    </div>
</body>
</html>