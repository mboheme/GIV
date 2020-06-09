<?php 
session_start();
$page = array(5,1);

include_once('include/function.php');
expireSession();
require_once ('include/db_private/db_connection.php');
$mysqli = OpenCon();
$query = 'SELECT * FROM `giv_trajet` ;';
$result = $mysqli->query($query);

$rowsTrajet = array();
if ($result->num_rows !== 0) {
  while ($rowTrajet = $result->fetch_array()) {
    $rowsTrajet[] = $rowTrajet;
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
<title>Trajet sur Google Maps - Déplacement - GIV</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
<link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
<link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
<link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
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
  <?php include('content/header.php') ?>
  <?php include('content/sidebar.php') ?>
  
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-9 mt"> 
          <!--CUSTOM CHART START -->
          <div class="border-head">
            <h3>Déplacement - Trajet sur Google Maps</h3>
          </div>
          <div class="col-lg-12 mt">
            <div class="description">
              <div style="font-size: 1.4em;">Sélectionner un trajet pour l'afficher</div>
                <div id="floating-panel">
              
                <b>Trajet : </b>
                <select id="trajet">
                  <option value="0">Choix du trajet</option>
                <?php
                foreach ($rowsTrajet as $trajet)
                {
                  echo '<option value="'.$trajet['id'].'">'.$trajet['name'].' partira de '.$trajet['start'].' pour '.$trajet['end'].'</option>';
                }
                ?>
                </select>
                <b>Supprimer un trajet : </b>
                <?php
                foreach ($rowsTrajet as $trajet)
                {
                  echo '<form id="del-trajet">';
                  echo '<input type="hidden" id="id" value="'.$trajet['id'].'">';
                  echo '<input type="button" value="'.$trajet['name'].'">';
                  echo '</form>';
                } 
                ?>
                
              </div>
              <?php
              foreach ($rowsTrajet as $key => $trajet)
              {
                ?>
                <div class="floating-panel hidden">
                  <input type="text" id='start-<?php echo $trajet['id']; ?>' value="<?php echo $trajet['start']; ?>"><input type="text" id="end-<?php echo $trajet['id']; ?>" value="<?php echo $trajet['end']; ?>">
                  
                </div>
                <?php
              }
              ?>
              <div id="map"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- /row --> 
    </section>
  </section>
  <!--main content end-->
  
  <?php include('content/footer.php') ?>
</section>
<!-- js placed at the end of the document so the pages load faster --> 
<script src="lib/jquery/jquery.min.js"></script> 
<script src="lib/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script> 
<script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script> 
<script src="lib/jquery.scrollTo.min.js"></script> 
<script src="lib/jquery.nicescroll.js" type="text/javascript"></script> 
<script src="lib/jquery.sparkline.js"></script> 
<script type="text/javascript" src="lib/gritter/js/jquery.gritter.js"></script> 
<script type="text/javascript" src="lib/gritter-conf.js"></script> 
<script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script> 
<script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script> 
<script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="lib/advanced-form-components.js"></script>
<!--common script for all pages--> 
<script src="lib/common-scripts.js"></script> 


<script>
function initMap() {

  
  var directionsService = new google.maps.DirectionsService();
  var directionsRenderer = new google.maps.DirectionsRenderer();
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 7,
    center: {lat: 48.302111, lng: 6.136444}
  });
  directionsRenderer.setMap(map);

  var onChangeHandler = function() {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  };
  document.getElementById('trajet').addEventListener('change', onChangeHandler);
  //document.getElementById('end').addEventListener('change', onChangeHandler);
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  var valueTrajet = document.getElementById('trajet').value;
  directionsService.route(
      {
        origin: {query: document.getElementById('start-'+valueTrajet).value},
        destination: {query: document.getElementById('end-'+valueTrajet).value},
        travelMode: 'DRIVING'
      },
      function(response, status) {
        if (status === 'OK') {
          directionsRenderer.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
}

setTimeout(function(){
   $('body').load("content/lock_screen.php");
   document.cookie = "expire=true"; 
}, <?php echo expiresession; ?>);
</script> 
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS3iIFb9ugBZdlnL8mm_TBXjEzWKX855k&callback=initMap">
    </script>
</body>
</html>