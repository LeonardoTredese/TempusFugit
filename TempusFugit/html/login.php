<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/logo.png">

    <title>Login - Tempus Fugit</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap-4.0.0-alpha.6/dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/login.css" rel="stylesheet">
  </head>

  <body class="text-center">
      <div class="container">
          <form class="form-signin" action="../Actions/Complete/Common/login.php" method="post">
              <img class="rounded" src="../images/logo.png" alt="" width="72" height="72"><br/><br/>
              <h1 class="h3 mb-3 font-weight-normal"><b><i>Tempus Fugit</i></b></h1><br/>
              <label for="inputEmail" class="sr-only">Nome utente</label>
              <input type="text" id="inputEmail" class="form-control" placeholder="Nome utente" required autofocus name="username">
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
              <div class="checkbox mb-3">
                  <label><input type="checkbox" value="remember-me"> Ricordami</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button><a href="index.php">home</a>

              <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
          </form>
      </div>
  </body>
</html>
