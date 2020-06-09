<?php 
session_start();
$page = array(8,0);

include_once('include/function.php');
expireSession();

require_once ('include/db_private/db_connection.php');
$mysqli = OpenCon();
$queryUtilisateur = "SELECT * FROM giv_utilisateur";
$resultUtilisateur = $mysqli->query($queryUtilisateur);
if ($resultUtilisateur->num_rows !== 0) {
  while ($rowUtilisateur = $resultUtilisateur->fetch_array()) {
    $rowsUtilisateur[] = $rowUtilisateur;
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Gestionnaire d'Intervention sur Véhicules - GIV">
<meta name="keyword" content="gestionnaire, intervention, vehicules, giv">
<title>Mon compte - Gestion du compte - GIV</title>

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
<script src="lib/chart-master/Chart.js"></script>



<!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->

</head>

<body>
<section id="container">
  <?php include('content/header.php'); ?>
  <?php include('content/sidebar.php'); ?>
  
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper site-min-height">
      <div class="row mt">
        <div class="col-lg-12">
          <div class="row content-panel">
            <div class="col-md-4 profile-text mt mb centered">
              <div class="right-divider hidden-sm hidden-xs">               
                <h3><?php echo company; ?></h3>
                <h4><?php echo companyadress; ?></h4>
                <h4>Tél : <?php echo companytel; ?></h4>
                <h4>Fax : <?php echo companyfax; ?></h4>
              </div>
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 profile-text">
              <h3><?php echo $_SESSION['info']['name']; ?></h3>
              <h4><?php echo $_SESSION['info']['function']; ?></h4>
              
            </div>
            <!-- /col-md-4 -->
            <div class="col-md-4 centered">
              <div class="profile-pic">
                <p class="centered"><img src="./upload/picture/<?php echo $_SESSION['info']['id']; ?>.jpg" class="img-circle" width="80"></a></p>
                <p><button type="button" class="btn btn-theme btn-small btn-theme" data-toggle="modal" data-target="#modal"><i class="fa fa-check"></i> Editer le profile</button>
                </p>
              </div>
            </div>
            <!-- /col-md-4 --> 
          </div>
          <!-- /row --> 
        </div>
        <!-- /col-lg-12 -->
        <div class="col-lg-12 mt">
          <!-- /panel-heading -->
          <div class="panel-body">
            <div class="tab-content">
              <div id="overview" class="tab-pane active">
                <div class="row">
                  <div class="col-md-6 detailed">
                    <h4>Mémo</h4>

                    <textarea rows="3" class="form-control" placeholder="Vous envoyez un commentaire ?"></textarea>
                    <div class="grey-style">
                      <div class="pull-left">
                        <button class="btn btn-sm btn-theme"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-sm btn-theme"><i class="fa fa-map-marker"></i></button>
                      </div>
                      <div class="pull-right">
                        <button class="btn btn-sm btn-theme03">Envoyer</button>
                      </div>
                    </div>
                    <div class="detailed mt">
                      <h4>Mémo sauvegardés</h4>
                      <div class="recent-activity">
                        <div class="activity-icon bg-theme"><i class="fa fa-check"></i></div>
                        <div class="activity-panel">
                          <h5>1 HOUR AGO</h5>
                          <div class="pull-left">
                            <button class="btn btn-sm btn-theme"><i class="fa fa-trash"></i></button>
                          </div>
                          <div class="pull-right">
                            <button class="btn btn-sm btn-theme03">Modifier</button>
                          </div>
                        </div>
                        
                        <div class="activity-icon bg-theme"><i class="fa fa-check"></i></div>
                        <div class="activity-panel">
                          <h5>1 HOUR AGO</h5>
                          <div class="pull-left">
                            <button class="btn btn-sm btn-theme"><i class="fa fa-trash"></i></button>
                          </div>
                          <div class="pull-right">
                            <button class="btn btn-sm btn-theme03">Modifier</button>
                          </div>
                        </div>
                      </div>
                      <!-- /recent-activity --> 
                    </div>
                    <!-- /detailed --> 
                  </div>
                  <!-- /col-md-6 -->
                  <div class="col-md-6 detailed">
                    <!-- /row -->
                    <h4>Liste des membres</h4>
                    <div class="row centered mb">
                      <?php
                      foreach ($rowsUtilisateur as $rowUtilisateur) 
                      {
                      ?>
                      <div class="friends-pic col-sm-4 col-lg-4"><img class="img-circle" width="35" height="35" src="upload/picture/<?php echo $rowUtilisateur['id']; ?>.jpg">
                        <ul class="my-friends">
                          <li> <?php echo $rowUtilisateur['name']; ?><br>
                            <?php echo $rowUtilisateur['function']; ?> </li>
                        </ul>
                      </div>
                      <?php
                      }
                      ?>
                    </div>
                    <!-- /row -->
                    <?php
                      $sql = 'SELECT * FROM giv_connexion WHERE id_utilisateur='.$_SESSION['info']['id'].' ORDER BY years DESC';
                      $resultConnexion = $mysqli->query($sql);	
                      $numRows = mysqli_num_rows($resultConnexion);
                      $maxpresence = 0;
                      $data = '[';
                      
                      while($rowConnexion = $resultConnexion->fetch_assoc()) 
                      {
                        $rowsConnexion[] = $rowConnexion;
                       
                        if($rowConnexion['num_connexion'] > $maxpresence)
                          $maxpresence = $rowConnexion['num_connexion'];
                        
                        $data = $data.$rowConnexion['num_connexion'];
                        
                        $numRows --;
                        
                        if($numRows > 0)
                          $data = $data.',';
                          
                        
                      }	
                      $data = $data.']';
                      ?>
                    <div class="panel terques-chart">
                      <div class="panel-body">
                        <div class="chart">
                          <div class="centered">
                            <h4>Présences</h4>
                            <h5>Nombre maximal de présence en une semaine : <strong><?php echo $maxpresence; ?> présences</strong>.</h5>
                            <h4>Nombre de connexion les dernières semaines</h4>
                            <span></span> </div>
                          <br>
                          <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="<?php echo $data ; ?>"></div>
                        </div>
                      </div>
                    </div>
                    <h4> Où également : </h4>
                    <div class="row centered">
                      <div class="col-md-8  col-md-offset-2"> 
                        <!-- REVENUE PANEL -->
                        <div class="green-panel pn">
                          <div class="green-header">
                            <h5>Nombre de présence par semaines</h5>
                          </div>
                          <div class="chart">
                            <div class="sparkline" data-type="line" data-resize="true"  data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="<?php echo $data ; ?>"></div>
                          </div>
                          <p class="mt">Nombre maximal de présence en une semaine :</p>
                          <br/>
                          <p><?php echo $maxpresence; ?> présences maximal</p>
                        </div>
                      </div>
                      <!-- /col-md-8 --> 
                    </div>
                    <!-- /row --> 
                  </div>
                  <!-- /col-md-6 --> 
                </div>
                <!-- /OVERVIEW --> 
              </div>
              <!-- /tab-pane --> 
            </div>
            <!-- /tab-content --> 
          </div>
          <!-- /panel-body --> 
        </div>
        <!-- /col-lg-12 --> 
      </div>
      <!-- /container -->
      
      <!-- Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form enctype="multipart/form-data" id="modalForm">
              <input type="hidden" value="action" id="action" name="update">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edition du profile</h4>
              </div>
              <?php
              foreach ($rowsUtilisateur as $rowUtilisateur) 
              {
                if($rowUtilisateur['id'] === $_SESSION['info']['id'])
                {
              ?>

              <div class="modal-body">
              <div class="form-group" id="form_id_vehicule">
                <label class="col-sm-2 col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                  <input type="number" class="default" name="id" id="id" value="<?php echo $rowUtilisateur['id']; ?>" hidden>
                  <input type="file" class="default" name="picture" id="picture">
                  <p class="help-block" id="help_id_vehicule"></p>
                </div>
              </div>
              <div class="form-group" id="form_name">
                <label class="col-sm-2 col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" id="name" value="<?php echo $rowUtilisateur['name']; ?>">
                  <p class="help-block" id="help_name"></p>
                </div>
              </div>
              <div class="form-group" id="form_id_vehicule">
                <label class="col-sm-2 col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" id="email" value="<?php echo $rowUtilisateur['email']; ?>">
                  <p class="help-block" id="help_id_vehicule"></p>
                </div>
              </div>
              <div class="form-group" id="form_id_vehicule">
                <label class="col-sm-2 col-sm-2 control-label">Mot de passe</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" id="password" value="<?php echo $rowUtilisateur['password']; ?>">
                  <p class="help-block" id="help_id_vehicule"></p>
                </div>
              </div>
              <?php
                }
              }
              ?>
            </div>              
            
            <div class="modal-footer">
              <div class="form-group">
                <div class="controls col-md-9">
                  <button class="btn btn-theme btn-small btn-theme" type="submit">Oui</button>
                  <button class="btn btn-theme btn-small btn-theme02" type="button" data-dismiss="modal">Non</button>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>   
      </div>
    </section>
    <!-- /wrapper --> 
  </section>
  <!-- /MAIN CONTENT -->
  
  <?php include('content/footer.php'); ?>
</section>
<!-- js placed at the end of the document so the pages load faster --> 
<script src="lib/jquery/jquery.min.js"></script> 
<script src="lib/jquery-ui-1.9.2.custom.min.js"></script> 
<script src="lib/bootstrap/js/bootstrap.min.js"></script> 
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script> 
<script src="lib/jquery.scrollTo.min.js"></script> 
<script src="lib/jquery.nicescroll.js" type="text/javascript"></script> 
<script src="lib/jquery.sparkline.js"></script> 
<!--common script for all pages--> 
<script src="lib/common-scripts.js"></script> 
<script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script> 
<script type="text/javascript" src="lib/gritter-conf.js"></script> 
<!--script for this page--> 
<script src="js/jquery.carouFredSel-5.5.0-packed.js" type="text/javascript"></script> 
<script src="js/jquery.vortex.min.js" type="text/javascript"></script> 
<script src="js/functions.js" type="text/javascript"></script> 
<script src="lib/sparkline-chart.js"></script> 
<script>




$(document).ready(function() {

$("#modalForm").on('submit', function(e){
  e.preventDefault();;
		
        $.ajax({
            type: 'POST',
            url: 'include/form_account.php',
            data: new FormData(this),
			dataType: "json",
            contentType: false,
            cache: false,
            processData:false,
			success: function(data){
				alert('Reconnection obligatoire pour voir les modifications !');
        //document.location.reload(true);				
			},
			error: function() {				
        alert('Erreur');
				//document.location.reload(true);	
			}
    });
});

});  


setTimeout(function(){
   $('body').load("content/lock_screen.php");
   document.cookie = "expire=true"; 
}, <?php echo expiresession; ?>);

</script>
</body>
</html>