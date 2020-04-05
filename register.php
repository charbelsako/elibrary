<!DOCTYPE html>
<html lang="en">
  <head>
    
    <?php require("head.php") ?>
    
    <title>Register</title>

    <script>
      document.addEventListener('DOMContentLoaded', () => {

        // These functions return true when there is an error
        function validateUsername(username) {
          if (username.length < 4) {
            usernameStatus.innerHTML = "Username should 3 characters or more"
            return true  
          }
          return false
        }

        function validateName(name) {
          if (name.length == 0) {
            nameStatus.innerHTML = "Name is required"
            return true
          }

          for (let c of name) {
            if (!isNaN(c) && c != " ") {
              nameStatus.innerHTML = "Name can't contain a number"
              return true
            }
          }

          return false
        }

        function validatePassword(password) {
          if (password.length < 10) {
            passwordStatus.innerHTML = "Password should be 10 characters or more"
            return true
          }
          return false
        }

        function validateEmail(email) {
          if (email.length == 0) {
            emailStatus.innerHTML = "Email is required"
            return true
          }
          return false
        }

        function requiredInput(input, statusElt, name) {
          if (input.length == 0) {
            statusElt.innerHTML = `${name} is required`
            return true
          }
          return false
        }

        registerForm.onsubmit = e => {
          e.preventDefault();

          let username = usernameInput.value
          let password = passwordInput.value
          let email = emailInput.value
          let name = nameInput.value

          // Validate Input
          let errors = new Array(4).fill(false)
          errors[0] = validatePassword(password)
          errors[1] = validateUsername(username)
          errors[2] = validateName(name)
          errors[3] = validateEmail(email)
          
          if (errors.includes(true)) {
            return;
          }

          $.ajax({
            url: "http://localhost/e-library/api/register.php",
            method: 'POST',
            data: {username, password, email, name}
          })
          .done( function(data) {
            console.log(data)
            if (JSON.parse(data) > -1) {
              // Redirect to homepage
              location.href = "index.php"
            } else {
              console.log('Oops!')
            }
          })
        }
      });
    </script>
  </head>
  <body>

    <?php require("header.php") ?>
    
    <div class="register flex-column w-100">
      <div class="card flex-column">
        <h1>Register</h1>
        <form action="" class="flex-column" id="registerForm">
          <div class="form-group flex-column-left">
            <input type="text" id="usernameInput" placeholder="Username" />
            <span id="usernameStatus" class="small status">fef</span>
          </div>
          <div class="form-group flex-column-left">
            <input type="text" id="nameInput" placeholder="Name" />
            <span id="nameStatus" class="small status">fed</span>
          </div>
          <div class="form-group flex-column-left">
            <input type="email" id="emailInput" placeholder="Email" />
            <span id="emailStatus" class="small status">fef</span>
          </div>
          <div class="form-group flex-column-left">
            <input type="password" id="passwordInput" placeholder="Password" />
            <span id="passwordStatus" class="small status">fef</span>
          </div>
          <div class="flex">
            <input type="submit" value="Register" class="button" />
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
