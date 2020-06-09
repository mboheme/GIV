<?php 
session_start();
ob_start();
$page = array(1,0);

include_once('include/function.php');
expireSession();

require_once ('include/db_private/db_connection.php');	
$mysqli = OpenCon();
$queryAlerte = 'SELECT giv_vehicule.id as v_id, giv_vehicule.name as v_name, giv_vehicule.plaque, giv_utilisateur.id as u_id, giv_utilisateur.name as u_name, giv_utilisateur.function, giv_alerte.* FROM giv_alerte INNER JOIN giv_utilisateur ON giv_alerte.id_utilisateur = giv_utilisateur.id INNER JOIN giv_vehicule ON giv_alerte.id_vehicule = giv_vehicule.id ORDER BY giv_alerte.date DESC;';
$resultAlerte = $mysqli->query($queryAlerte);
while ($rowAlerte = $resultAlerte->fetch_array()) {
  $rowsAlerte[] = $rowAlerte;
}

$queryAlerteUtilisateur = 'SELECT * FROM giv_alerte_utilisateur ;';
$resultAlerteUtilisateur = $mysqli->query($queryAlerteUtilisateur);
while ($rowAlerteUtilisateur = $resultAlerteUtilisateur->fetch_array()) {
  $rowsAlerteUtilisateur[] = $rowAlerteUtilisateur;
}

$queryUtilisateur = 'SELECT * FROM giv_utilisateur ;';
$resultUtilisateur = $mysqli->query($queryUtilisateur);
while ($rowUtilisateur = $resultUtilisateur->fetch_array()) {
  $rowsUtilisateur[] = $rowUtilisateur;
}

$queryCalendar = 'SELECT * FROM giv_calendar ;';
$resultCalendar = $mysqli->query($queryCalendar);
while ($rowCalendar = $resultCalendar->fetch_array()) {
  $rowsCalendar[] = $rowCalendar;
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
<title>Accueil - GIV</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />
<!-- FullCalendar -->
<link rel="stylesheet" type="text/css" href="lib/fullcalendar/fullcalendar.css">
<link href="lib/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<script src="lib/chart-master/Chart.js"></script>
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />

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
    <section class="wrapper">
      <div class="row" style="background-image:url(img/background1.jpg)">
        <div class="centered"><h1 style="color: var(--couleur-texte);">Tableau de bord</h1></div>
        <div class="col-lg-9 main-chart">

          <!--custom chart end-->
          
          <div class="row"> 
            <!-- WEATHER PANEL -->
            <div class="col-md-4 mb"> <a class="weatherwidget-io" href="https://forecast7.com/fr/48d306d13/mirecourt/" data-label_1="MIRECOURT" data-label_2="WEATHER" data-theme="original" >MIRECOURT WEATHER</a> 
              <script>
               !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
              </script> 
            
              <div class="row mt message-p pn" style="padding-left: 10px; padding-right: 10px; margin-left: 2px; margin-right: 2px;"> 
                <h4 class="title">Envoyer un message</h4>
                <form class="contact-form php-mail-form" role="form" id="sendMessage" method="POST">

                  <div class="form-group">
                    <!-- <input type="name" name="name" class="form-control" id="contact-name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" > -->
                    <label>Sélectionner un destinataire</label>
                    <br>
                    <select id="destinataire">
                      <option value="0">Choix du destinataire</option>
                      <?php
                      foreach($rowsUtilisateur as $utilisateur)
                      {
                        echo '<option value="'.$utilisateur['id'].'">'.$utilisateur['name'].'</option>';
                      }
                      ?>
                      
                    </select>
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" name="subject" class="form-control" id="sujet" placeholder="Objet :" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
                    <div class="validate"></div>
                  </div>

                  <div class="form-group">
                    <textarea class="form-control" name="msg" id="msg" placeholder="Message :" rows="5" data-rule="required" data-msg="Please write something for us"></textarea>
                    <div class="validate"></div>
                  </div>

                  <div class="loading"></div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <div class="form-send">
                    <input type="button" onclick="sendMsg()" class="btn btn-large btn-primary" value="Envoie du message">
                  </div>

                </form>
              </div>
            <!-- /row -->
            </div>


            <!-- DIRECT MESSAGE PANEL -->
            <div class="col-md-8 mb">
              <?php              
              foreach ($rowsAlerte as $rowAlerte) 
              { 
                $hidden = '';
                foreach ($rowsAlerteUtilisateur as $rowAlerteUtilisateur) 
                {
                  if($_SESSION['info']['id'] === $rowAlerteUtilisateur['id_utilisateur'] && $rowAlerte['id']  === $rowAlerteUtilisateur['id_alerte'])
                  {
                    $hidden = "hidden=\"true\"";
                  }					  	
                } 
              ?>
              <div class="message-p pn" <?php echo $hidden; ?>>
                <div class="message-header">
                  <h4>Alerte sur <?php echo $rowAlerte['v_name']; ?></h4>
                  <h5><?php echo $rowAlerte['name']; ?></h5>
                </div>
                <div class="row">
                  <div class="col-md-3 centered hidden-sm hidden-xs"> <img onclick="openFullscreen(this.src)" src="upload/photo/<?php echo $rowAlerte['id_vehicule']; ?>.jpg" class="img" width="65"><br><name><?php echo $rowAlerte['v_name']; ?></name><br>Par <?php echo $rowAlerte['u_name']; ?><br>Le <?php echo dateFr($rowAlerte['date'], true); ?></div>
                  <div class="col-md-9">
                    <p class="small well green"><?php if($rowAlerte['fait'] === "on") echo '<i class="fa fa-check"></i> '; else echo '<i class="fa fa-warning"></i> '; ?><?php echo $rowAlerte['description']; ?></p>
                    
                    <form class="form-inline" id="formAlerte-<?php echo $rowAlerte['id']; ?>">
                        <div class="form-group">
                          <input type="text" hidden="true" name="id_alerte" id="id_alerte" value="<?php echo $rowAlerte['id']; ?>">
                          <!-- <p class="txt-theme">Status : <?php //if($rowAlerte['fait'] === "on") echo 'C\'est fait !'; else echo 'Indérerminé'; ?></p> -->
                        
                          <a class="btn btn-default btn-theme02" href="create_intervention.php?car=<?php echo $rowAlerte['v_id']; ?>">Intervenir</a>
                          <input type="button" onclick="itDone(<?php echo $rowAlerte['id']; ?>)" class="btn btn-default pull-right btn-theme <?php if($rowAlerte['fait'] === "on") echo 'hidden'; ?>" value="C'est fait !">
                          <!-- <button type="submit" class="btn btn-default pull-right btn-theme05">En cours</button> -->
                          <input type="submit" class="btn btn-default btn-danger" value="Masquer">
                          <div class="statusMsg"></div>
                        </div>
                       
                    </form>
                    
                  </div>
                </div>
              </div>
              <!-- /Message Panel-->
              <?php	}
					  ?>
            </div>
            <!-- /col-md-8  --> 
          </div>
        </div>
        
        <div class="col-lg-3 message-p pn ds"> 
          <!--COMPLETED ACTIONS DONUTS CHART-->
          <div class="donut-main">
            <h4>Planning</h4>
            
          </div>
          <!--NEW EARNING STATS -->
          <div class="panel terques-chart">
            <div class="panel-body">
              <div class="chart">
                <div class="centered"> <span></span></div>
                <br>
                <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                <?php
                // $url='upload/calendar/'.$_SESSION['info']['id'].'.json';
                // $json = file_get_contents($url);
                // $data = json_decode($json, TRUE);     
                

                
                  foreach($rowsCalendar as $item)
                {
                ?>
                  <div class="desc" style="background-color: <?php echo $item['color']; ?>">
                    <div>Débute : <strong><?php echo dateFr($item['date_start'], false); ?> à <?php echo timeFr($item['date_start'], true); ?></strong></div>
                    <div class="text-uppercase"><h3><?php echo $item['title']; ?></h3></div>
                    <div class="text">Termine : <strong><?php echo dateFr($item['date_end'], false); ?> à <?php echo timeFr($item['date_end'], true); ?></strong></div>
                <?php if($item['repeat_day'] != "") { ?>                   <div class="text"><br> Jours répéter sont : <strong><?php echo $item['repeat_day']; ?></strong></div><?php } ?>
                <?php if($item['repeat_mouth'] != "") { ?>                   <div class="text">Et les mois : <strong><?php echo $item['repeat_mouth']; ?></strong></div><?php } ?>
                <?php if($item['repeat_week'] != "") { ?>                   <div class="text">Nombre de mois répétés : <strong><?php echo $item['repeat_week']; ?></strong></strong></div><?php } ?>
                <?php if($item['repeat_year'] != "") { ?>                   <div class="text">Nombre d'années : <strong><?php echo $item['repeat_year']; ?></strong></div><?php } ?>
                    <form  enctype="multipart/form-data" id="formDel-<?php echo $item['id']; ?>">
                    <input hidden type="number" id="id_calendar" name="id_calendar" value="<?php echo $item['id']; ?>">
                      <div class="text-uppercase"><input class="btn btn-default btn-danger" type="submit" id="submit" name="submit" value="Supprimer"></div>
                    </form>
                  </div>
                <?php 
                }  
                ?>
                
              </div>
            </div>
          </div>
          <!--new earning end--> 
         </div> 
      </div>
      <!-- /row --> 
    </section>
    <!--wrapper end--> 
  </section>
  <!--main content end-->
  
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

<!--custom switch--> 
<script src="lib/bootstrap-switch.js"></script> 
<!--custom tagsinput--> 
<script src="lib/jquery.tagsinput.js"></script> 
<script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script> 
<script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script> 
<script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
<script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script> 
<script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script> 
<script src="lib/advanced-form-components.js"></script> 


<script type="text/javascript">
$(document).ready(function() {
  <?php 
  foreach ($rowsAlerte as $rowAlerte) { 
    $hidden = false;
    foreach ($rowsAlerteUtilisateur as $rowAlerteUtilisateur) {
        if($_SESSION['info']['id'] === $rowAlerteUtilisateur['id_utilisateur'] && $rowAlerte['id']  === $rowAlerteUtilisateur['id_alerte'])
        {
          $hidden = true;
        }					  	
        if ($rowAlerte['fait'] === 'on')
        {
          $hidden = true; 
        }
    } 
    if( ! $hidden)
    {
    ?>
    
    var unique_id = $.gritter.add({
      // (string | mandatory) the heading of the notification
      title: '<?php echo $rowAlerte['name']; ?> !',
      // (string | mandatory) the text inside the notification
      text: '<?php echo $rowAlerte['description']; ?>',
      // (string | optional) the image to display on the left
      image: 'upload/photo/<?php echo $rowAlerte['id_vehicule']; ?>.jpg',
      // (bool | optional) if you want it to fade out on its own or just sit there
      sticky: false,
      // (int | optional) the time you want it to be alive for before fading out
      time: 8000,
      // (string | optional) the class name you want to apply to that specific message
      class_name: 'my-sticky-class'
    });

	<?php }
		} ?>
	  return false;
	});
  </script>


<script>

$(document).ready(function() {

  

  <?php foreach ($rowsCalendar as $rowCalendar) { ?>
  $("#formDel-<?php echo $rowCalendar['id']; ?>").on('submit', function(e){
		e.preventDefault();
		
        $.ajax({
            type: 'POST',
            url: 'include/form_index.php',
            data: { id_calendar: '<?php echo $rowCalendar['id']; ?>', action:'delAlerte'},
			success: function(data){
				document.location.reload(true);				
			},
			error: function() {				
				//document.location.reload(true);	 
        alert("Une erreur est survenue");
			}
    });
  });
  <?php 
  }  // End Foreach
  ?>



<?php foreach ($rowsAlerte as $rowAlerte) { ?>
  $("#formAlerte-<?php echo $rowAlerte['id']; ?>").on('submit', function(e){
		e.preventDefault();;
		
        $.ajax({
            type: 'POST',
            url: 'include/form_index.php',
            data: new FormData(this),
			dataType: "json",
            contentType: false,
            cache: false,
            processData:false,
			success: function(data){
				document.location.reload(true);				
			},
			error: function() {				
				document.location.reload(true);	
			}
    });
  });
  <?php 
  }  // End Foreach
  ?>
});  
  setTimeout(function(){
    $('body').load("content/lock_screen.php");
    document.cookie = "expire=true"; 
  }, <?php echo expiresession; ?>);

function itDone(id) 
{
  $.ajax({
    type: "POST",
    url: 'include/form_index.php',
    data:{action:'itsdone', id:id},
    success:function(data) 
    {
      document.location.reload(true);	
    }
  });
}

function sendMsg() 
{

  if($('#destinataire :selected').val() === "0")
  {
    alert('Destinataire invalide');
  }
  else
  {
    $.ajax({
      type: "POST",
      url: 'include/form_index.php',
      data: { id:$('#destinataire :selected').val(), sujet:$('#sujet').val(), msg:$('#msg').val(), action:'sendmsg'},
      success:function(data) 
      {
        document.location.reload(true);	
      }
    });
  }
}
</script>
</body>
</html>