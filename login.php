<?php 

// session_start();
// if ( isset($_SESSION["id"]) ) {
//   header('Location: http://localhost/e-library/index.php');
// }

?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <?php require("head.php"); ?>
  
    <title>Log In</title>
    <script>
    document.addEventListener('DOMContentLoaded', async () => {
      
      loginForm.onsubmit = async (e) => {
        e.preventDefault()
        let username = usernameInput.value;
        let password = passwordInput.value;

        let result = $.ajax({
          async: false,
          method: 'GET',
          url:`http://localhost/e-library/api/login.php`,
          data: {username, password}  
        })
        .done(function(data) {
          let jsonData = JSON.parse(data)
          console.log(jsonData)
          if (jsonData) {
            // redirect the user to the homepage
            if (jsonData[0].type === "1") {
              location.href = "index.php"
            } else if (jsonData[0].type === "2") {
              location.href = "admin.php"
            }
          }else{
            // Show message
            loginStatus.style.display = "block"
          }
        })
      }
    })
    </script>
  </head>
  <body>

    <?php require("header.php") ?>

    <!-- FIXME: w-100 ? -->
    <div class="login flex-column w-100">
      <div class="card flex-column">
        <h1>Login</h1>
        <form action="" class="login flex-column" id="loginForm">
          <div class="form-group">
            <input type="text" id="usernameInput" placeholder="Username" autofocus/>
          </div>
          <div class="form-group">
            <input type="password" id="passwordInput" placeholder="Password" />
            <span class="small status" id="loginStatus" style="display: none;">Wrong Credentials!</span>
          </div>
          <div class="flex">
            <input type="submit" value="Login" class="button" />
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
