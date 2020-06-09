<?php 
session_start();
$page = array(5,2);

include_once('include/function.php');
expireSession();
?>

<?php
require_once ('include/db_private/db_connection.php');
$mysqli = OpenCon();
$queryHoraire = "SELECT * FROM giv_trajet ;";
$resultHoraire = $mysqli->query($queryHoraire);
if ($resultHoraire->num_rows !== 0) {
  while ($rowHoraire = $resultHoraire->fetch_array()) {
    $rowsHoraire[] = $rowHoraire;
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
<title>Créneau horaire - Déplacement - GIV</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<script src="lib/chart-master/Chart.js"></script>
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<script src="lib/chart-master/Chart.js"></script>
<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />


<script type="text/javascript" src="lib/jscalendar/jsCalendar.js"></script>

<style>
table {
  width:100%;
  height: 100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table#t01 tr:nth-child(even) {
  background-color: #eee;
}
table#t01 tr:nth-child(odd) {
 background-color: #fff;
}
table#t01 th {
  background-color: black;
  color: white;
}
</style>

<!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->

</head>

<body>
<section id="container">
  <?php include('content/header.php') ?>
  <?php include('content/sidebar.php') ?>
  
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12 main-chart"> 
          <!--CUSTOM CHART START -->
          <div class="border-head">
            <h3><i class="fa fa-angle-right"></i>  Créneau horaire des déplacements</h3>
          </div>
        </div>
        </div>      
        <div class="col-lg-3 mt"> 
          <br>
          <h4><i class="fa fa-angle-right"></i> Créer une plage horaire</h4>
          <div id="external-events">
            <form action="include/form_creneau_horaire.php" method="post" class="form-horizontal style-form">
            <div class="form-group">         
              <div class="input-group input-large">
                <span class="input-group-addon">Nom du trajet</span>
                  <input type="text" name="title" class="form-control">
              </div>
            </div>
            <div class="form-group">         
              <div class="input-group input-large">
                <span class="input-group-addon">Couleur</span>
                  <input type="color" name="backgroundColor" class="form-control" value="#73a87b">
              </div>
            </div>
            <div class="form-group">         
              <div class="input-group input-large">
                <span class="input-group-addon">Ville de départ</span>
                  <input type="text" name="start" class="form-control" value="Mirecourt">
              </div>
            </div>
            <div class="form-group">         
              <div class="input-group input-large">
                <span class="input-group-addon">Ville d'arrivée</span>
                  <input type="text" name="end" class="form-control" value="Contrexéville">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-large" data-date="<?php echo time(); ?>" data-date-format="mm/dd/yyyy"> <span class="input-group-addon">Date </span>
                <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date">
              </div>
            </div>
            <div class="form-group">            
                <div class="input-group input-large" data-date="<?php echo time(); ?>" data-date-format="mm/dd/yyyy">
                  <span class="input-group-addon"> De </span>
                  <div class="input-group bootstrap-timepicker">
                    <input type="text" name="from-time" class="form-control timepicker-24">
                    <span class="input-group-btn">
                    <button class="btn btn-theme04" type="button"><i class="fa fa-clock-o"></i></button>
                    </span> </div>
                </div>
            </div>
            <div class="form-group">
              <div class="input-group input-large" data-date="<?php echo time(); ?>" data-date-format="mm/dd/yyyy">
                <span class="input-group-addon"> à </span>
                <div class="input-group bootstrap-timepicker">
                  <input type="text" name="to-time" class="form-control timepicker-24">
                  <span class="input-group-btn">
                  <button class="btn btn-theme04" type="button"><i class="fa fa-clock-o"></i></button>
                  </span> </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group input-large"> <span class="input-group-addon">Répéter</span>
                  <select id="repeat" name="repeat[]" class="form-control" onChange="addRepeat()">
                    <option selected>Aucune</option>
                    <option value="1">Journaliaire</option>
                    <option value="2">Semestrielle</option>
                    <option value="3">Mensuelle</option>
                    <option value="4">Annuelle</option>
                  </select>
              </div>
            </div>
            <div class="form-group" id="day" hidden="true">
              <div class="input-group input-large"> <span class="input-group-addon">Jours</span>
                <select multiple class="form-control multiple " name="day[]" id="day">
                    <option value="1">Lundi</option>
                    <option value="2">Mardi</option>
                    <option value="3">Mercredi</option>
                    <option value="4">Jeudi</option>
                    <option value="5">Vendredi</option>
                    <option value="6">Samedi</option>
                    <option value="7">Dimanche</option>
                  </select>
              </div>
            </div>
            <div class="form-group" id="week" hidden="true">
              <div class="input-group input-large"> <span class="input-group-addon">Semaines</span>
                <input class="form-control" name="week" type="number" value="1"/>
              </div>
            </div>
            <div class="form-group" id="month" hidden="true">
              <div class="input-group input-large"> <span class="input-group-addon">Mois</span>
                <select multiple class="form-control multiple" name="month[]">
                    <option>Janvier</option>
                    <option>Février</option>
                    <option>Mars</option>
                    <option>Avril</option>
                    <option>Mai</option>
                    <option>Juin</option>
                    <option>Juillet</option>                  
                    <option>Août</option>
                    <option>Septembre</option>
                    <option>Octobre</option>
                    <option>Novembre</option>
                    <option>Décembre</option>
                  </select>
              </div>
            </div>
            <div class="form-group" id="year" hidden="true">
              <div class="input-group input-large"> <span class="input-group-addon">Années</span>
                <input class="form-control" name="freq-year" type="number" value="1"/>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <div class="input-group bootstrap-timepicker">
                  <input class="btn btn-theme" type="submit" value="Valider" id="valider"/>
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>


        <div class="col-lg-9 mt">
          <div style="font-size: 1.4em;">
          <h3>Créneau horaire </h3>
          
          <?php

          $joursem = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');

          $annee=date('Y');
          $jour=date('d');
          $mois = date('n');

          $numSemaine =date('W',mktime(0,0,0,$mois,$jour,$annee));
          $premierJanvier = mktime(1,0,0,1,1,$annee);
          $jourPremierJanvier = date('w',$premierJanvier);


          $timestamp1 = $premierJanvier+$numSemaine*7*24*3660;
          $jour = date('w',$timestamp1);

          ?>
          <table style="width: 100%;" id="t01">
            <tr>
              <th class="centered" >Jour de la semaine</th>
              <?php
              for ($i=0;$i<=24;$i=$i+2) 
              { 

              echo '<th class="centered">'.$i.'</th>';

              }
              ?>
            </tr>
          <?php
          for ($i=0;$i<=6;$i++) 
          {
            $timestamp = $timestamp1+($i-$jour+date('N'))*24*3600;
            $jour1 = date('w',$timestamp);

            $dateDuJour = date('Y-m-d', time());
            //echo $dateDuJour;
            echo '<tr>';
            echo '<td>'.$joursem[$jour1].'</td>';

            $arraykey = array();
            echo '<td colspan="25">';
            foreach ($rowsHoraire as $key => $horaire) 
            {
              if($horaire['date'] >= $dateDuJour && $horaire['date'] <= strtotime(date("Y-m-d", strtotime($dateDuJour)) . " +7 day")) 
              {
                if(strtotime(date("Y-m-d", strtotime($horaire['date'])) . " +0 day") == strtotime(date("Y-m-d", strtotime($dateDuJour)) . " +$i day"))
                {
                  array_push($arraykey, $key);
                  $isDetected = true;
                  $heureDebut = date('H',strtotime($horaire['date_debut'])) ;
                  $heureFin = date('H',strtotime($horaire['date_fin']));

                  $pourcent = ($heureFin-$heureDebut) / 24 * 100;

                  $pourcentUn = $heureDebut / 25 * 100;      
                  $pourcentDeux = $pourcent;
                  $pourcentTrois = 100 - $pourcentDeux - $pourcentUn;    

                  $valuenowUn =  0;
                  $valuenowDeux = $heureDebut / 24 * 100;
                  $valuenowTrois = 100 - $valuenowDeux;
                  ?>
                  <div class="progress">
                    <div class="progress-bar bg-theme" role="progressbar" style="width: <?php echo $pourcentUn; ?>%" aria-valuenow="<?php echo $valuenowUn; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar" role="progressbar" style="background-color: <?php echo $horaire['background_color']; ?>; width: <?php echo $pourcentDeux -10/100; ?>%" aria-valuenow="<?php echo $valuenowDeux; ?>" aria-valuemin="0" aria-valuemax="100"><p class="black-txt"><?php echo $horaire['name']; ?></p></div>
                    <div class="progress-bar bg-theme" role="progressbar" style="width: <?php echo $pourcentTrois; ?>%" aria-valuenow="<?php echo $valuenowTrois; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <?php
                  }  

                } 
                else
                { 
                  $isDetected = false; 
                }
            }echo '</td>';
          }
          echo" </tr> ";

          ?>
          </table>        
        </div>
		  </div>
    </section>
  </section>
  <!--main content end-->
  
  <?php include('content/footer.php') ?>
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
<!--custom switch--> 
<script src="lib/bootstrap-switch.js"></script> 
<!--custom tagsinput--> 
<script src="lib/jquery.tagsinput.js"></script> 
<!--script for this page--> 
<script src="lib/sparkline-chart.js"></script> 
<script src="lib/zabuto_calendar.js"></script> 
<script src="js/jquery.carouFredSel-5.5.0-packed.js" type="text/javascript"></script> 
<script src="js/jquery.vortex.min.js" type="text/javascript"></script> 
<script src="js/functions.js" type="text/javascript"></script> 
<script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script> 
<script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
<script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script> 
<script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script> 
<script src="lib/advanced-form-components.js"></script> 











<script type="application/javascript">

  setTimeout(function(){
   $('body').load("content/lock_screen.php");
   document.cookie = "expire=true"; 
}, <?php echo expiresession; ?>);

</script> 
</body>
</html>