<?php 
session_start();
include ('include/function.php'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="GIV - Gestionnaire Informatique de Véhicules">
<meta name="author" content="m.boheme">
<meta name="keyword" content="GIV - Gestionnaire Informatique de Véhicules">
<title>GIV - Gestionnaire Informatique de Véhicules</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
</head>

<body>

<!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
<div id="login-page">
  <div class="container">
    <form class="form-login" method="post" action="include/form_login.php">
      <h2 class="form-login-heading">Connection</h2>
      <div class="login-wrap">
        <p><i class="text-warning"><span><!--<a data-toggle="modal" href="login.php#myErrorModal">-->
          <?php if (isset($_SESSION['error'])) echo $_SESSION['msg']; ?>
          <!--</a>--></span></i></p>
        <input type="text" class="form-control" placeholder="E-Mail" name="email" autofocus>
        <br>
        <input type="password" class="form-control" placeholder="Mot de passe" name="password">
        <label class="checkbox"> <span class="pull-right"> <a data-toggle="modal" href="login.php#myModal"> Réinitialiser le mot de passe ?</a> </span> </label>
        <input type="text" hidden="true" name="history" value="<?php echo checkDomain(); ?>">
        <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> CONNEXION</button>
        <br>
        <div class="registration"> Vous n'avez pas de compte ?<br/>
          <a class="" href="inscription.php"> Créer un compte </a> </div>
      </div>
    </form>
    <!-- Modal -->
    <form class="form-login" method="post" action="include/form_login_password.php">
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Mot de passe oublié ?</h4>
            </div>
            <div class="modal-body">
              <h5 class="txt-theme">Entrer votre E-mail.</h5>
              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Annuler</button>
              <button class="btn btn-theme" type="submit">Réinitialiser</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    </div>
    <!-- modal --> 
  </div>
</div>
<!-- js placed at the end of the document so the pages load faster --> 
<script src="lib/jquery/jquery.min.js"></script> 
<script src="lib/bootstrap/js/bootstrap.min.js"></script> 
<!--BACKSTRETCH--> 
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.--> 
<script type="text/javascript" src="lib/jquery.backstretch.min.js"></script> 
<script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
	
  </script>
</body>
</html>