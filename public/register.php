<?php
  require __DIR__.'/../boot/boot.php';

  use Hotel\User;

  // Chech for existing logged in user
  if (!empty(User::getCurrentUserId())){
    header('Location: http://hotel.collegelink.localhost/public/intex.php');die;
  }
 ?>

<!DOCTYPE>
<html>
  <head>
    <meta charset="utf-8">
    <title> Signup </title>
    <link rel="shortcut icon" href="assets\images\booking.png">

    <link  href="CSS\intex-style.css" rel="stylesheet"/>
    <link  href="CSS\register-style.css" rel="stylesheet"/>
    <link  href="assets/css/fontawesome.min.css" rel="stylesheet"/>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />

  </head>

  <body>

    <header class="intex-menu">
      <span id="hotel" href="#"></i>Hotels</span>
      <a id="home" href="./intex.php"><i class="fas fa-home"></i>Home |</a>
      <span id="register" href="./register.php"><i class="fas fa-user-plus"></i>Sign up |</span>
      <a id="login" href="./login.php"><i class="fas fa-sign-in-alt"></i>Log in |</a>

    </header>

    <main>
      <section class="image">
        <div class="box register-box">

          <div class="register-form">
            <h1> Sign up</h1>
              <form method="post" action="actions/register.php">
                <?php if (!empty($_GET['error'])){ ?>
                  <div class="alert alert-danger alert-styled-left">Register Error</div>
                <?php } ?>

                <label for="name">Full  name <span style="color:red;">*</span>
                  <div class="text-danger name-error">
                    Must be a valid full name!
                  </div>
                </label>
                <input type="input" name="name" id="name" placeholder="Name Surname " id="name" />

                <label for="email">Email address <span style="color:red;">*</span>
                  <div class="text-danger email-error">
                    Must be a valid email address!
                  </div>
                </label>
                <input type="input" name="email" id="email" placeholder="example@email.com" id="email" />


                <label for="confirm-email">Confirm Email adress <span style="color:red;">*</span>
                   <div class="text-danger confirm-email-error">
                    Must be equal to email!
                   </div>
                </label>
                <input type="input" placeholder="example@email.com" id="confirm-email" />


                <label for="password">Password  <span style="color:red;">*</span>
                  <div class="text-danger password-error">
                    must be more than 8 charracters!
                  </div>
                </label>
                <input type="password" name="password" id="password" placeholder="12345678" id="password" />


                <button disabled type="submit " name="signup" id="signup-button"> Sign up </button>
              </form>
            </div>
        </div>
      </section>
    <main>

    <footer>
      <p>© CollegLink 2021</>

    </footer>

    <script src="./JS/validation-register.js"></script>

  </body>
</html>
