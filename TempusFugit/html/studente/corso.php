<!doctype html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/logo.png">
    <title>Home - Tempus Fugit</title>
    <!-- Trovare e scaricare i fali corrispettivi ai CDN, per velocizzare il caricamento della pagina -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/home.css" type="text/css"/>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="logo">
        <img class="rounded" src="../../images/logo.png" alt="" width="38" height="38"/>
      </div>
      <a class="navbar-brand" href="../index.php" style="position:absolute; top:15px; left:60px;"><b><i>Tempus Fugit</i></b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent"><br/>
        <ul class="navbar-nav mr-auto" style="margin-left:40%;">
          <!--Corsi-->
          <li class="nav-item"><a class="nav-link" href="corsi.php">Corsi<span class="sr-only">(current)</span></a></li>
          <!--Comunicazioni-->
          <li class="nav-item"><a class="nav-link" href="login.html">Comunicazioni</a></li>
          <!--Profilo-->
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profilo</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item sm" href="#">Esci</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container" style="margin-bottom:16px; left:-16px;">
      <!--Vista studente di un corso-->
      <div class="row" style="margin-top:16px;">
        <div class="col-md-4">
          <h2 id="nomeCorso">---Nome Corso---</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <h4 id="professoreCorso">---Professore---</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <p class="lead">---Descrizione del corso---</p>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-4">
          <h4>Materiali e discussioni:</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="list-group">
            <p><a href="#" class="list-group-item list-group-item-action" id="materiale">Materiale 1 <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" style="position:absolute; right:10px;"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg></a></p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="list-group">
            <a href="discussione.php" class="list-group-item list-group-item-action" id="nomeDiscussione">discussione 1 <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" style="position:absolute; right:10px;"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/><path d="M0 0h24v24H0z" fill="none"/></svg></a>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 footerleft ">
            <div class="logofooter">Tempus Fugit</div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
            <p><i class="fa fa-map-pin"></i> meme street, Uruguay</p>
            <p><i class="fa fa-phone"></i> Phone (Italy) : +39 666 666 666</p>
            <p><i class="fa fa-envelope"></i> E-mail : info@l.ol</p>
          </div>
          <div class="col-md-2 col-sm-6 paddingtop-bottom">
            <h6 class="heading7">GENERAL LINKS</h6>
            <ul class="footer-ul">
              <li><a href="#"> stuff</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
