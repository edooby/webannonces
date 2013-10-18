<!DOCTYPE html>
<html>
  <head>
    <title>WebAnnonces</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Web Annonces</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Accueil</a></li>
            <li><a href="a-propos.php">A propos</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
          <form class="navbar-form navbar-right" method="post" action="connexion.php">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Mot de passe" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Connexion</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>


    <div class="container" style="margin-top:100px;">
      <div class="row">
        <div class="col-lg-9">
          <h1>Inscription</h1>
		  
		  <p>Merci de vous inscrire à Web Annonces</p>
		  
		  
        </div>
        <div class="col-lg-3 well">
			<h3>Dernières annonces</h3>

			<div class="row" style="border-bottom:3px dashed #fff;">
				<div class="col-lg-6"><a href="annonce.php?id=0">Chaise longue <span class="label label-warning">42 €</span></a></div>
				<div class="col-lg-6"><em>A vendre chaise longue neuve encore emballée, tombé d'un camion</em></div>
			</div>
			
			<div class="row" style="border-bottom:3px dashed #fff;">
				<div class="col-lg-6"><a href="annonce.php?id=0">Iphone 5S <span class="label label-warning">2000 €</span></a></div>
				<div class="col-lg-6"><em>A vendre Iphone 5S vitre brisée, locké opérateur Joe Mobile</em></div>
			</div>
			
			<div class="row" style="border-bottom:3px dashed #fff;">
				<div class="col-lg-6"><a href="annonce.php?id=0">4L 1984 <span class="label label-warning">1300 €</span></a></div>
				<div class="col-lg-6"><em>CT OK, 4 roues motrices</em></div>
			</div>
			
			<p style="margin-top:10px;" class="text-center"><a class="btn btn-success btn-lg" href="annonces.php">
				<span class="glyphicon glyphicon-hand-right"></span> Voir toutes les annonces</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Cours Html 2013</p>
      </footer>
    </div> <!-- /container -->
		  
		  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>