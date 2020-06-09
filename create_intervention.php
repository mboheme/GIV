<?php 
session_start();
$page = array(4,2);

include_once('include/function.php');
expireSession();

require_once ('include/db_private/db_connection.php');
$mysqli = OpenCon();
$queryVehicule = "SELECT giv_vehicule.*, id_carburant AS id_c, giv_carburant.name AS c_name, giv_carburant.value AS c_value FROM giv_vehicule INNER JOIN giv_carburant ON giv_vehicule.id_carburant = giv_carburant.id";
$resultVehicule = $mysqli->query($queryVehicule);
while ($rowVehicule = $resultVehicule->fetch_array()) {
	$rowsVehicule[] = $rowVehicule;
} 

$queryCategorie = "select * from giv_categorie";
$sqlCategorie = mysqli_query($mysqli,$queryCategorie);

while($rowCategorie = mysqli_fetch_array($sqlCategorie))
{
	$rowsCategorie[] = $rowCategorie;
}

$id_categorie = 1;
$querySousCategorie = 'SELECT * FROM giv_sous_categorie ORDER BY id_categorie; '; //WHERE id_categorie='.$id_categorie_temp.';'
$sqlSousCategorie = mysqli_query($mysqli,$querySousCategorie);

while($rowSousCategorie = mysqli_fetch_assoc($sqlSousCategorie))
{
	$rowsSousCategorie[] = $rowSousCategorie;
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
<title>Créer une intervention - Intervention - GIV</title>

<!-- Favicons -->
<link href="img/favicon.png" rel="icon">
<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Bootstrap core CSS -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--external css-->
<link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />


<!-- jsCalendar -->
<link rel="stylesheet" type="text/css" href="lib/jscalendar/jsCalendar.css">
<link rel="stylesheet" type="text/css" href="lib/jscalendar/jsCalendar.clean.css">
<script type="text/javascript" src="lib/jscalendar/jsCalendar.js"></script>

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
      <div class="col-lg-12 mt">
        <div class="row">
          <div class="col-lg-10">
            <div class="invoice-body">
              <div class="pull-left">
                <h1>Intervention sur un véhicule</h1>
                <h2>Sélectionner un véhicule</h2>
                <h3>Liste des véhicules</h3>
                <select name="vehicule" id="vehicule" class="default">
                  <option value="0">Choix d'un véhicule</option>
                  <?php
                  foreach ($rowsVehicule as $rowVehicule) {
                    if(isGetMethode('car') === $rowVehicule['id'])
                      $selected = " selected ";
                    else 
                      $selected = "";


                    echo '<option '.$selected.' value="' . $rowVehicule['id'] . '">' . $rowVehicule['name'] .'  ['. $rowVehicule['plaque'] .']</option>';
                  }
                  ?>
                </select>
				<div class="clearfix"></div>
              	<?php
				foreach ($rowsVehicule as $rowVehicule) 
				{
          if(isGetMethode('car') === $rowVehicule['id']) 
            $visibled = " ";
          else  
            $visibled = " hidden=\"true\" ";

              	?>
				<div class="pull-left tohide" id="info-<?php echo $rowVehicule['id']; ?>" <?php echo $visibled; ?>>
					<div class="pull-left">
					<h3>Information sur <?php echo $rowVehicule['name']; ?></h3>
					<h4>Son id : <?php echo $rowVehicule['id']; ?></h4>
					<h4>Le model : <?php echo $rowVehicule['model']; ?></h4>
					<h4>La marque : <?php echo $rowVehicule['mark']; ?></h4>
					<h4>Son kilométrage : <?php echo $rowVehicule['kilometre']; ?> Km</h4>
					</div>
                	<div class="col-md-2 col-md-offset-2"> <img width="150px" src="upload/photo/<?php echo $rowVehicule['id']; ?>" onClick="openFullscreen(this.src)"> <img width="150px" src="upload/carte_grise/<?php echo $rowVehicule['id']; ?>" onClick="openFullscreen(this.src)"> </div>
             	</div>
              	<?php
                }
              	?>
	            <div class="clearfix"></div>
              <hr>
            </div>
            <!--/col-lg-12 mt --> 
            <?php if (isGetMethode('car') > 0) {
              $visibled = " visibled ";
            } ?>
            <form enctype="multipart/form-data" id="formIntervention" <?php echo $visibled; ?>>
			<!-- BASIC FORM ELELEMNTS -->
            <div class="row mt" >
            
              <div class="col-lg-12 carousel slide">
			        	<div class="form-panel">
              	<h4 class="mb"><i class="fa fa-angle-right"></i> Remplir les informations</h4>					
                <div class="form-group" id="form_name">
                  <label class="col-sm-2 control-label">Nom</label>
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
                <div class="form-group" id="form_kilometre">
                  <label class="col-sm-2 control-label">Kilomètre</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" min="0" max="9999999999" name="kilometre" id="kilometre">
                    <p class="help-block" id="help_kilometre"></p>
                  </div>
                </div>
                <div class="form-group" id="form_date">
                  <label class="col-lg-2 col-sm-2 control-label">Date de l'intervention</label>
                  <div class="controls col-md-9">
                      <input type="date" class="default" name="date" id="date"/>
                      <p class="help-block" id="help_date"></p>
                  </div>
                </div>
                <div class="form-group" id="form_devis">
                  <label class="control-label col-md-3">Devis, facultatif</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new">
                      <input type="file" class="default" name="devis" id="devis"/>                      
                      <p class="help-block" id="help_devis"></p><br />
                    </div>
                  </div>
                </div>
                <div class="form-group" id="form_facture">
                  <label class="control-label col-md-3">Facture, facultatif</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new">
                      <input type="file" class="default" name="facture" id="facture"/>
                      <p class="help-block" id="help_facture"></p><br />
                    </div>
                  </div>
                </div>
                <div class="form-group" id="form_status_msg">
                   <div class="controls col-md-9">
                     <div class="statusMsg"></div>
                   </div>
                </div>
                <button type="submit" class="add-on btn-theme" style="width: 100%; margin-top: 15px; margin-bottom: 10px;">Valider</button>
				  <div class="carousel-inner">
          <?php
          
          foreach($rowsCategorie as $categorie)
          {
          ?>
					<div style="width: 310px; height: 650px;" class="col-lg-4 text-center border-radius-theme sc" id="select-<?php echo $categorie['id']; ?>"> 
						<a href="#" title=""> <img src="upload/composant/<?php echo $categorie['id'].'.png'; ?>" class="imgresponsive" alt="<?php echo $categorie['name']; ?>"/>
							<h3><?php echo $categorie['name']; ?></h3>
						</a>
					<?php
					
					foreach($rowsSousCategorie as $sousCategorie)
					{
						if($sousCategorie['id_categorie'] === $categorie['id'])
						{
					?>
						<h4><input class="ez-checkbox" type="checkbox" id="horns-"<?php echo $sousCategorie['id']; ?>" value="<?php echo $sousCategorie['id']; ?>" name="horns[]"><a href="modal-"><?php echo "\r".$sousCategorie['name']; ?></a></h4>
					<?php
						}
					}
					echo '</div>';
				  }
				  ?>
					</div>
				</div>
      </div>
      <button type="submit" class="add-on btn-theme" style="width: 100%; margin-top: 15px; margin-bottom: 10px;">Valider</button>
			<!-- col-lg-12--> </div>
      </form>
      
            
            	</div>
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
<script type="text/javascript" src="lib/wow-slider/wowslider.js"></script> 
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
<script type="application/javascript">  





  $(document).ready(function() {
    
    $("#formIntervention").on('submit', function(e){
    
     
    var val = [];
    $(':checkbox:checked').each(function(i){
      val[i] = $(this).val();
    });
    //alert(val);


    var formData = new FormData(this);
		var id_vehicule = $('#vehicule option:selected').val();
		formData.append("id_vehicule", id_vehicule);
    formData.append("id_sous_categorie", val);
    
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'include/form_create_intervention.php',
        data: formData,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(){
            $('#valider').attr("disabled","disabled");
            $('#form').css("opacity",".5");
    },
    success: function(data){		

      alert(data.nb_error);

      valideInput(data.name, '#help_name', '#form_name', '#name');
      valideInput(data.desciption, '#help_desciption', '#form_desciption', '#desciption');
      valideInput(data.kilometre, '#help_kilometre', '#form_kilometre', '#kilometre');
      valideInput(data.date, '#help_date', '#form_date', '#date');
      valideInput(data.devis, '#help_devis', '#form_devis', '#devis');
      valideInput(data.facture, '#help_facture', '#form_facture', '#facture');
    if(data.nb_error == 0)
    {                    
      $('.statusMsg').html('<p class="help-block has-success">Enregistrement réussit.</p>');
      $('#form_status_msg').addClass('has-success');
    }else{
      $('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
      $('#form_status_msg').addClass('has-error');
    }
    $('#form').css("opacity","");
    //reinitialise();
    },
    error: function() 
    {
      $('#form').css("opacity","1");
      $("#valider").removeAttr("disabled");
      $('.statusMsg').html('<p class="help-block has-error">Une erreur est survenue !.</p>');
    }
    });
  });



	$('.carousel').carousel({
      interval: 6000
    })

  


	$('#vehicule').on('change', function() {	  
	  if(this.value == 0)
	    document.getElementById("formIntervention").hidden = true;	
	  else	{  
	    document.getElementById("formIntervention").hidden = false;
	  
	    //var id_vehicule = this.value;
	  }
	  //$('.pull-right').attr("hidden",true);
	  $('#info-'+this.value).removeAttr('hidden');
	  
	  $('.tohide').attr("hidden",true);
	  $('#info-'+this.value).removeAttr('hidden');
	  
	  
	});

	$('#select').on('change', function() {	  
	  if(this.value == 0)
	    document.getElementsByClassName("sc").hidden = true;	
	  else	{  

		var elems = document.getElementsByClassName('sc');

		for(var i = 0; i != elems.length; ++i)
		{
			if(i === this.value)
				elems[i].style.visibility = "hidden"; // hidden has to be a string
				elems[i].hidden = true; // hidden has to be a string
		}
		
	    document.getElementById("select-"+this.value).hidden = false;
		
	  }
	  
	});

    
  });
  

  setTimeout(function(){
    $('body').load("content/lock_screen.php");
    document.cookie = "expire=true"; 
  }, <?php echo expiresession; ?>);

</script>
</body>
</html>