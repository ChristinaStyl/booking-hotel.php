<!DOCTYPE>
<html>
  <head>
    <meta charset="utf-8">
    <title> Login </title>
    <link rel="shortcut icon" href="assets\images\booking.png">

    <link  href="CSS\intex-style.css" rel="stylesheet">
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
      <a id="register" href="./register.php"><i class="fas fa-user-plus"></i>Sign up |</a>
      <span id="login" href="./login.php"><i class="fas fa-sign-in-alt"></i>Log in |</span>

    </header>

    <main>

      <section class="image">
        <div class="box login-box">
          <div class="login-form">
            <h1> Login</h1>
              <form method="post" action="actions/login.php">

                <label for="email">Email address <span style="color:red;">*</span>
                  <div class="text-danger email-error">
                    Must be a valid email address!
                  </div>
                </label>
                <input type="input"  name="email" placeholder="example@email.com" id="email" />

                <label for="password">Password  <span style="color:red;">*</span>
                  <div class="text-danger password-error">
                    must be more than 8 charracters!
                  </div>
                </label>
                <input type="password" name="password" placeholder="12345678" id="password" />

                <button disabled type="submit" name="signup" id="login-button">Login </button>
              </form>
            </div>
        </div>
      </section>
    <main>

    <footer>
      <p>© CollegLink 2021</>
    </footer>

    <script src="./JS/validation-login.js"></script>

  </body>
</html>
