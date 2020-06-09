<?php
session_start();
$page = array(3, 1);
include_once ('include/function.php');
expireSession();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Gestionnaire d'Intervention sur Véhicules - GIV">
<meta name="keyword" content="gestionnaire, intervention, Utilisateurs, giv">
<title>Afficher - Gestion des véhicules - GIV</title>

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
  <?php include ('content/header.php') ?>
  <?php include ('content/sidebar.php') ?>
  
  <!--main content start-->
  <section id="main-content">
    <section class="wrapper">
      <h3><i class="fa fa-angle-right"></i> Affichage des Utilisateurs</h3>
      <div class="row mb"> 
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
              <thead>
                <tr>
                  <th hidden="true">id</th>
                  <th>Nom</th>
                  <th>E-Mail</th>
                  <th hidden="true">Mot de passe</th>
                  <th>Fonction</th>
                  <th hidden="true">Privilège</th>
                  <th>Photo</th>
                </tr>
              </thead>
              <tbody>
				<?php
				require_once ('include/db_private/db_connection.php');
				$mysqli = OpenCon();
				$queryUtilisateur = "SELECT giv_utilisateur.*, giv_privilege.name AS p_name FROM giv_utilisateur INNER JOIN giv_privilege ON giv_utilisateur.id_privilege = giv_privilege.id";
				$resultUtilisateur = $mysqli->query($queryUtilisateur);
				if ($resultUtilisateur->num_rows !== 0) {
					while ($rowUtilisateur = $resultUtilisateur->fetch_array()) {
						$rowsUtilisateur[] = $rowUtilisateur;
					}
					foreach ($rowsUtilisateur as $rowUtilisateur) {
				?>
					<tr class="gradeA">
					  <?php
						echo '<td hidden="true" class="sorting_1 center">' . $rowUtilisateur['id'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowUtilisateur['name'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowUtilisateur['email'] . '</td>';
						echo '<td hidden="true" class="sorting_1 center">' . $rowUtilisateur['password'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowUtilisateur['function'] . '</td>';
						echo '<td hidden="true" class="sorting_1 center">' . $rowUtilisateur['p_name'] . '</td>';
						echo '<td class="sorting_1 center"><img src="upload/picture/' . $rowUtilisateur['id'] . '.jpg" width="50px"></img></td>';
					?>
					</tr>
                <?php
					}
				}
				?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- page end--> 
      <!-- /row --> 
    </section>													
    <!-- /wrapper -->
    
    <?php
if ($resultUtilisateur->num_rows !== 0) {
    $queryUtilisateur = 'SELECT * FROM giv_utilisateur';
    $resultUtilisateur = $mysqli->query($queryUtilisateur);
    while ($rowUtilisateur = $resultUtilisateur->fetch_array()) {
        $rowsUtilisateur[] = $rowUtilisateur;
    }
	
	$queryPrivilege = 'SELECT * FROM giv_privilege';
	$resultPrivilege = $mysqli->query($queryPrivilege);
	while ($rowPrivilege = $resultPrivilege->fetch_array()) {
		$rowsPrivilege[] = $rowPrivilege;
	}
	
    foreach ($rowsUtilisateur as $key => $rowUtilisateur) {
?>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-<?php echo $rowUtilisateur['id']; ?>" aria-labelledby="modal-label-<?php echo $rowUtilisateur['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data" id="formMod-<?php echo $rowUtilisateur['id']; ?>">
            <input type="hidden" value="modAction" id="modAction" name="modAction">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Modification du véhicule</h4>
            </div>
            <div class="modal-body">
              <div class="form-group hidden" id="form_id_utilisateur">
                <label class="col-sm-2 col-sm-2 control-label">Id</label>
                <div class="col-sm-10">
                  <input class="form-control" name="id_utilisateur" id="id_utilisateur" value="<?php echo $rowUtilisateur['id']; ?>">
                  <p class="help-block" id="help_id_utilisateur"></p>
                </div>
              </div>
              <div class="form-group" id="form_name">
                <label class="col-sm-2 col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" id="name" value="<?php echo $rowUtilisateur['name']; ?>">
                  <p class="help-block" id="help_name"></p>
                </div>
              </div>
              <div class="form-group" id="form_email">
                <label class="col-sm-2 col-sm-2 control-label">E-Mail</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" id="email" value="<?php echo $rowUtilisateur['email']; ?>">
                  <p class="help-block" id="help_email"></p>
                </div>
              </div>
              <div class="form-group" id="form_password">
                <label class="col-sm-2 col-sm-2 control-label">Mot de passe</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" id="password" value="<?php echo $rowUtilisateur['password']; ?>">
                  <p class="help-block" id="help_password"></p>
                </div>
              </div>
              <div class="form-group" id="form_function_utilisateur">
                <label class="col-sm-2 col-sm-2 control-label">Function</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="function_utilisateur" id="function_utilisateur" placeholder="'F 524-AA-75' ou 'F AA-229-AA 01'" value="<?php echo $rowUtilisateur['function']; ?>">
                  <p class="help-block" id="help_function_utilisateur"></p>
                </div>
              </div>
              <div class="form-group" id="form_privilege">
                <label class="col-sm-2 col-sm-2 control-label">Privilège</label>
                <div class="col-sm-10">
                  <select name="privilege" id="privilege" class="default">
                    <?php					
					foreach ($rowsPrivilege as $rowPrivilege) {
						if ($rowUtilisateur['id_privilege'] === $rowPrivilege['id']) {
							$selected = "selected='selected'";
						} else {
							$selected = '';
						}
						echo '<option ' . $selected . ' value="' . $rowPrivilege['id'] . '">' . $rowPrivilege['name'] . '</option>';
					}
					?>
                  </select>
                  <p class="help-block" id="help_privilege"></p>
                </div>
              </div>
                   
            </div>
            <div class="modal-footer">
              <div class="form-group">
                <div class="controls col-md-9">
                  <button class="btn btn-theme btn-small btn-theme" type="submit">Modifier</button>
                  <button class="btn btn-theme btn-small btn-theme02" type="button"  data-dismiss="modal">Annuler</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
    
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalDel-<?php echo $rowUtilisateur['id']; ?>" aria-labelledby="modal-label-<?php echo $rowUtilisateur['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data" id="formDel-<?php echo $rowUtilisateur['id']; ?>">
            <input type="hidden" value="delAction" id="delAction" name="delAction">          
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Suppression du véhicule</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input hidden="hidden" class="hidden" name="id_utilisateur" id="id_utilisateur" value="<?php echo $rowUtilisateur['id']; ?>">
                <h3>Etes-vous sur de vouloir supprimer <?php echo $rowUtilisateur['name']; ?> [<?php echo $rowUtilisateur['function']; ?>] ?</h3>
              </div>              
            </div>
            <div class="modal-footer">
              <div class="form-group">
                <div class="controls col-md-9">
                  <button class="btn btn-theme btn-small btn-theme" type="submit">Oui</button>
                  <button class="btn btn-theme btn-small btn-theme02" type="button"  data-dismiss="modal">Non</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
	<?php
    }
}
?>
    <?php include ('content/footer.php') ?>
  </section>
  <!-- /MAIN CONTENT --> 
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

    // Formating function for row details 
    function fnFormatDetails(oTable, nTr) {
      	var aData = oTable.fnGetData(nTr);
      	var sOut = '<form id="formDetails">';
		sOut += '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
		sOut += '  <tr>';
		sOut += '    <td><h4>' + aData[2] + ' [' + aData[1] + ']</h4></td>';
		sOut += '    <td></td>';
		sOut += '    <td></td>';
		sOut += '  </tr>';
		sOut += '  <tr>';
		sOut += '    <td>Privilége : <strong>' + aData[6] + '</strong></strong></td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '  </tr>';
		sOut += '  <tr>';
		sOut += '    <td>Mot de passe : <strong>' + aData[4] + '</strong></strong></td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '  </tr>';
		sOut += '  <tr>';
		sOut += '<td colspan="3"><button type="button" class="btn btn-theme btn-small btn-theme" data-toggle="modal" data-target="#modal-' + aData[1] + '">Modifier</button> <button type="button" class="btn btn-danger btn-small" data-toggle="modal" data-target="#modalDel-' + aData[1] + '">Supprimer</button></td></tr>';

		sOut += '  </tr>';
		sOut += '</table>';
		sOut += '</form>';
		return sOut;
    }

    
    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";
    
      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });
    
      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });
    
      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });
    
      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td:first-child img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "lib/advanced-datatable/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }		
      });						


    <?php
if ($resultUtilisateur->num_rows !== 0) {
    foreach ($rowsUtilisateur as $key => $rowUtilisateur) {
?>

	$('#formMod-<?php echo $rowUtilisateur['id']; ?>').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'include/form_display_users.php',
			data: new FormData(this),
			dataType: "json",
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$('#valider').attr("disabled","disabled");
				$(this).css("opacity",".5");
				$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'envoie.</p>');
			},
			success: function(data){
				valideInput(data.id_utilisateur, '#help_id_utilisateur', '#form_id_utilisateur', '#id_utilisateur');
				valideInput(data.name, '#help_name', '#form_name', '#name');
				valideInput(data.email, '#help_email', '#form_email', '#email');
				valideInput(data.password, '#help_password', '#form_password', '#password');
				valideInput(data.function_utilisateur, '#help_function_utilisateur', '#form_function_utilisateur', '#function_utilisateur');
				valideInput(data.privilege, '#help_privilege', '#form_privilege', '#privilege');
							
				if(data.nb_error == 0){                    
					$('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
					$('#form_status_msg').addClass('has-success');
				}else{
					$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
					$('#form_status_msg').addClass('has-error');
				}
				$('#formMod-<?php echo $rowUtilisateur['id']; ?>').css("opacity","");
				$("#valider").removeAttr("disabled");
        
				document.location.reload(true);				
			},
			error: function() {
				$('#formMod-<?php echo $rowUtilisateur['id']; ?>').css("opacity","1");
				alert('Une erreur est survenue !');
			}
		});
	});
	




	$('#formDel-<?php echo $rowUtilisateur['id']; ?>').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'include/form_display_users.php',
			data: new FormData(this),
			dataType: "json",
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){
				$('#valider').attr("disabled","disabled");
				$(this).css("opacity",".5");
				$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'envoie.</p>');
			},
			success: function(data){

				valideInput(data.id_utilisateur, '#help_id_utilisateur', '#form_id_utilisateur', '#id_utilisateur');			
				
				if(data.nb_error == 0){                    
					$('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
					$('#form_status_msg').addClass('has-success');
				}else{
					$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
					$('#form_status_msg').addClass('has-error');
				}
				$('#formMod-<?php echo $rowUtilisateur['id']; ?>').css("opacity","");
				$("#valider").removeAttr("disabled");
				
				
				document.location.reload(true);				
			},
			error: function() {
				$('#formMod-<?php echo $rowUtilisateur['id']; ?>').css("opacity","1");
				alert('Une erreur est survenue !');
			}
		});
	});

	<?php
    }
}
?>

});    

    function openFullscreen(src){
         window.open(src);
    }
    
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