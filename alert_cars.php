<?php 
session_start();
$page = array(2,2);

include_once('include/function.php');
expireSession();

require_once ('include/db_private/db_connection.php');
$mysqli = OpenCon();
$queryVehicule = "SELECT giv_vehicule.*, id_carburant AS id_c, giv_carburant.name AS c_name, giv_carburant.value AS c_value FROM giv_vehicule INNER JOIN giv_carburant ON giv_vehicule.id_carburant = giv_carburant.id";
$resultVehicule = $mysqli->query($queryVehicule);
while ($rowVehicule = $resultVehicule->fetch_array()) 
{
  $rowsVehicule[] = $rowVehicule;
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
<title>Alerter - Gestion des véhicules - GIV</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<script src="lib/chart-master/Chart.js"></script>

<!-- jsCalendar -->
<link rel="stylesheet" type="text/css" href="lib/jscalendar/jsCalendar.css">
<link rel="stylesheet" type="text/css" href="lib/jscalendar/jsCalendar.clean.css">
<script type="text/javascript" src="lib/jscalendar/jsCalendar.js"></script>

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
      <div class="col-lg-12 mt">
        <div class="row content-panel">
          <div class="col-lg-10 col-lg-offset-1">
            <div class="invoice-body">
              <div class="pull-left">
                <h1>Alerte sur un véhicule</h1>
                <h2>Sélectionner un véhicule</h2>
                <h3>Liste des véhicules</h3>
                <select name="vehicule" id="vehicule" class="default">
                  <option value="0">Choix d'un véhicule</option>
                  <?php
                  foreach ($rowsVehicule as $rowVehicule) {
                    /*if ($rowVehicule['id_c'] === $rowCarburant['id']) {
                      $selected = "selected='selected'";
                    } else {
                      $selected = '';
                    }*/
                    echo '<option value="' . $rowVehicule['id'] . '">' . $rowVehicule['name'] .'  ['. $rowVehicule['plaque'] .']</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="clearfix"></div>
              <!-- /pull-left -->
              
              <?php
                foreach ($rowsVehicule as $rowVehicule) {
              ?>
              <div class="pull-left tohide" id="info-<?php echo $rowVehicule['id']; ?>" hidden="true">
                <div class="pull-left">
                  <h3>Information sur <?php echo $rowVehicule['name']; ?></h3>
                  <h4>Son id : <?php echo $rowVehicule['id']; ?></h4>
                  <h4>Le model : <?php echo $rowVehicule['model']; ?></h4>
                  <h4>La marque : <?php echo $rowVehicule['mark']; ?></h4>
                  <h4>Son kilométrage : <?php echo $rowVehicule['kilometre']; ?> Km</h4>
                </div>
                <div class="col-md-2"> <img width="150px" src="upload/photo/<?php echo $rowVehicule['id']; ?>" onClick="openFullscreen(this.src)"> <img width="150px" src="upload/carte_grise/<?php echo $rowVehicule['id']; ?>" onClick="openFullscreen(this.src)"> </div>
              </div>
              <?php
                }
              ?>
              
              <!-- /pull-right -->
              <div class="clearfix"></div>
              <hr>
            </div>
            <!--/col-lg-12 mt --> 
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt" >
              <div class="col-lg-12">
                <form enctype="multipart/form-data" id="formAlert" hidden="true">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Remplir les informations</h4>
                  <div class="form-horizontal style-form">
                    <div class="form-group" id="form_name">
                      <label class="col-sm-2 control-label">Nom de l'alerte</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name">
                        <p class="help-block" id="help_name"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_description">
                      <label class="col-sm-2 control-label">Description de l'alerte</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="description"></textarea>
                        <p class="help-block" id="help_description"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_date">
                      <label class="col-lg-2 col-sm-2 control-label">Date de l'alerte</label>
                      <div class="controls col-md-9">
                        <input type="date" class="default" name="date" id="date" value="<?php echo date('d/m/Y'); ?>"/>
                        <p class="help-block" id="help_date"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_accident">
                      <label class="col-sm-2 control-label">Cocher s'agit-il d'un accident ?</label>
                      <div class="col-sm-10">
                        <input class="pull-left form-control" type="checkbox" name="accident" id="accident">
                        <br>
                        <p class="help-block" id="help_accident"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_probleme_technique">
                      <label class="col-sm-2 control-label">Cocher s'agit-il d'un probleme technique ?</label>
                      <div class="col-sm-10">
                        <input class="pull-left form-control" type="checkbox" name="probleme_technique" id="probleme_technique">
                        <br>
                        <p class="help-block" id="help_probleme_technique"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_changer_piece">
                      <label class="col-sm-2 control-label">Cocher s'il faut changer une pièce ?</label>
                      <div class="col-sm-10">
                        <input class="pull-left form-control" type="checkbox" name="changer_piece" id="changer_piece">
                        <br>
                        <p class="help-block" id="help_changer_piece"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_contact_technicien">
                      <label class="col-sm-2 control-label">Cocher pour contacter les techniciens ?</label>
                      <div class="col-sm-10">
                        <input checked class="pull-left form-control" type="checkbox" name="contact_technicien" id="contact_technicien">
                        <br>
                        <p class="help-block" id="help_contact_technicien"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_contact_superieur">
                      <label class="col-sm-2 control-label">Cocher pour contacter les supérieurs ?</label>
                      <div class="col-sm-10">
                        <input class="pull-left form-control" type="checkbox" name="contact_superieur" id="contact_superieur">
                        <br>
                        <p class="help-block" id="help_contact_superieur"></p>
                      </div>
                    </div>
                    <div class="form-group" id="form_status_msg">
                      <div class="controls col-md-9">
                        <div class="statusMsg"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls col-md-9">
                        <input type="submit" class="btn btn-theme" value="Valider" id="valider" name="valider"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- col-lg-12--> 
            </div>
            <!-- /row --> 
          </div>
        </div>
      </div>
    </section>
    <!-- /wrapper --> 
  </section>
  <!-- /MAIN CONTENT -->
  
  <?php include('content/footer.php') ?>
</section>
<!-- js placed at the end of the document so the pages load faster --> 
<script src="lib/jquery/jquery.min.js"></script> 
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
<script src="lib/sparkline-chart.js"></script> 
<script src="lib/zabuto_calendar.js"></script> 
<script type="application/javascript">
  $(document).ready(function() {

	$('#vehicule').on('change', function() {	  
	  if(this.value == 0)
	    document.getElementById("formAlert").hidden = true;	
	  else	{  
	    document.getElementById("formAlert").hidden = false;
	  
	    //var id_vehicule = this.value;
	  }
	  $('.tohide').attr("hidden",true);
	  $('#info-'+this.value).removeAttr('hidden');
	  
	  
	  
	});

    $("#formAlert").on('submit', function(e){
		e.preventDefault();;
		
		var formData = new FormData(this);
		var id_vehicule = $('#vehicule option:selected').val()
		formData.append("id_vehicule", id_vehicule);
		
    $.ajax({
        type: 'POST',
        url: 'include/form_alert_car.php',
        data: formData,
        dataType: "json",
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
            $('#valider').attr("disabled","disabled");
            $('#form').css("opacity",".5");
        },
        success: function(data){
            
    //valideInput(data.id_vehicule, '#help_id_vehicule', '#form_id_vehicule', '#id_vehicule');
    valideInput(data.name, '#help_name', '#form_name', '#name');
    valideInput(data.date, '#help_date', '#form_date', '#date');
    valideInput(data.description, '#help_description', '#form_description', '#description');
    valideInput(data.accident, '#help_accident', '#form_accident', '#accident');
    valideInput(data.probleme_technique, '#help_probleme_technique', '#form_probleme_technique', '#probleme_technique');
    valideInput(data.changer_piece, '#help_changer_piece', '#form_changer_piece', '#changer_piece');
    valideInput(data.contact_technicien, '#help_contact_technicien', '#form_contact_technicien', '#contact_technicien');
    valideInput(data.contact_superieur, '#help_contact_superieur', '#form_contact_superieur', '#contact_superieur');			

    if(data.nb_error == 0){                    
                $('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
      $('#form_status_msg').addClass('has-success');
            }else{
                $('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
      $('#form_status_msg').addClass('has-error');
            }
            $('#form').css("opacity","");
            $("#valider").removeAttr("disabled");
        },
			  error: function() {
				  $('#form').css("opacity","1");
				  alert('Une erreur est survenue !');
			  }
        });
    });
  });
	
		function valideInput(data, inputHelp, inputForm, input){
		if(data == false || data == 0){
			$(inputHelp).html("Champ non valide !");
			$(inputForm).addClass("has-error");
			$(inputForm).removeClass("has-success");
			
		}else{
			$(inputHelp).html("Valide !");
			$(inputForm).addClass("has-success");
			$(inputForm).removeClass("has-error");
			$(input).val(data);

		}
	}
  
  setTimeout(function(){
    $('body').load("content/lock_screen.php");
    document.cookie = "expire=true"; 
  }, <?php echo expiresession; ?>);

</script>
</body>
</html>