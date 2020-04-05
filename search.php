<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("head.php"); ?>
    <title>Search Page</title>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            search.onkeyup = ({target}) => {
                // search
                console.log(target.value)
                $.ajax({
                    url: 'api/search.php',
                    data: {search: target.value},
                    method: 'GET'
                })
                .done(function(data){
                    bookList = JSON.parse(data)
                    // console.log(data[0])
                    let html = '';
                    for (let book of bookList) {
                        html += `
                        <div class="card flex-column">
                            <h3 class="card-header" data-id="${book.id}">${book.title}</h3>
                            <a href="book_details.php?id=${book.id}">
                                <img
                                    class="card-image"
                                    alt=""
                                    src="http://covers.openlibrary.org/b/isbn/${book.ISBN}-M.jpg"
                                />
                            </a>
                            <div class="flex">
                                <button class="button" onclick="addToCart(${book.id})">
                                    Add to Cart
                                </button>
                                <button class="button" onclick="addToCartThenGo(${book.id})">
                                    Buy now
                                </button>
                            </div>
                        </div>`
                    }
                    document.querySelector("main").innerHTML = html;
                })
            }
        })
    </script>
</head>
<body>
    <?php require("header.php"); ?>
    <form action="" class="flex">
        <div class="form-group">
            <input type="search" name="search" id="search" class="search" placeholder="Search">
        </div>
    </form>
    <main>
        
    </main>
</body>
</html>