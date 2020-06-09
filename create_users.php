<?php 
session_start();
$page = array(3,2);

include_once('include/function.php');
expireSession();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Gestionnaire d'Intervention sur Véhicules - GIV">
<meta name="keyword" content="gestionnaire, intervention, vehicules, giv">
<title>Créer un utilisateur - Gestion des utilisateurs - GIV</title>

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
        <h3><i class="fa fa-angle-right"></i> Créer un utilisateur</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Formulaire de création d'un utilisateur</h4>
              <div class="form-horizontal style-form">
               <form enctype="multipart/form-data" id="form">
                <div class="form-group" id="form_name">
                  <label class="col-sm-2 control-label">Nom (Complet)</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name">
                    <p class="help-block" id="help_name"></p>
                  </div>
                </div>
                <div class="form-group" id="form_email">
                  <label class="col-sm-2 control-label">E-Mail</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email" >
                    <p class="help-block" id="help_email"></p>
                  </div>
                </div>
                <div class="form-group" id="form_password">
                  <label class="col-sm-2 control-label">Mot de passe</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" id="password">
                    <p class="help-block" id="help_password"></p>
                  </div>
                </div>
                <div class="form-group" id="form_function">
                  <label class="col-sm-2 control-label">Fonction</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" name="function1" id="function1" placeholder="'Informaticien', 'Technicien', etc..">
                    <p class="help-block" id="help_function"></p>
                  </div>
                </div>
                <div class="form-group" id="form_privilege">
                  <label class="col-sm-2 control-label">Privilége</label>
                  <div class="col-sm-10">
                     <select name="privilege" id="privilege" class="default">
                       <?php 
					    require_once ('include/db_private/db_connection.php');
						$mysqli = OpenCon();
						$query = 'SELECT * FROM giv_privilege';
						$result = $mysqli->query($query);
						
						while($row = $result->fetch_array())
						{
							$rows[] = $row;
						}
						
						foreach($rows as $row)
						{
							echo '<option value="'.$row['id'].'">'.$row['name'].' </option>';
						}
						
					   ?>
                    </select>
                    <p class="help-block" id="help_privilege"></p>
                  </div>
                </div>
                <div class="form-group" id="form_photo">
                  <label class="control-label col-md-3">Photo de profil au format JPG</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new">
                      <input type="file" class="default" name="photo" id="photo"/>                      
                      <p class="help-block" id="help_photo"></p><br />
                    </div>
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
               </form>
              </div>
            </div>
          </div>
          <!-- col-lg-12-->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
  <!--main content end-->
  
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
<script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="lib/advanced-form-components.js"></script>

<script>

$(document).ready(function(e){
    $("#form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'include/form_create_users.php',
            data: new FormData(this),
			dataType: "json",
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#valider').attr("disabled","disabled");
                $('#form').css("opacity",".5");
            },
            success: function(data){               
				
				valideInput(data.name, '#help_name', '#form_name', '#name');
				valideInput(data.email, '#help_email', '#form_email', '#email');
				valideInput(data.password, '#help_password', '#form_password', '#password');
				valideInput(data.function1, '#help_function', '#form_function', '#function1');
				valideInput(data.privilege, '#help_privilege', '#form_privilege', '#privilege');			
				
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