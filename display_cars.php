<?php
session_start();
$page = array(2, 1);
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
<meta name="keyword" content="gestionnaire, intervention, vehicules, giv">
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
      <h3><i class="fa fa-angle-right"></i> Affichage des voitures</h3>
      <div class="row mb"> 
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
              <thead>
                <tr>
                  <th hidden="true">id</th>
                  <th>Nom</th>
                  <th>Modèle</th>
                  <th>Marque</th>
                  <th>Carburant</th>
                  <th>Plaque</th>
                  <th hidden="true" class="hidden-phone">Kilometres</th>
                  <th hidden="true" class="hidden-phone">Litre au 100</th>
                  <th class="hidden-phone">Carte Grise</th>
                  <th class="hidden-phone">Photographie</th>
                  <th hidden="true" class="hidden-phone">Date mise en service</th>
                </tr>
              </thead>
              <tbody>
				<?php
				require_once ('include/db_private/db_connection.php');
				$mysqli = OpenCon();
				$queryVehicule = "SELECT giv_vehicule.*, id_carburant AS id_c, giv_carburant.name AS c_name, giv_carburant.value AS c_value FROM giv_vehicule INNER JOIN giv_carburant ON giv_vehicule.id_carburant = giv_carburant.id";
				$resultVehicule = $mysqli->query($queryVehicule);
				if ($resultVehicule->num_rows !== 0) {
					while ($rowVehicule = $resultVehicule->fetch_array()) {
						$rowsVehicule[] = $rowVehicule;
					}
					foreach ($rowsVehicule as $rowVehicule) {
				?>
					<tr class="gradeA">
					  <?php
						echo '<td hidden="true" class="sorting_1 center">' . $rowVehicule['id'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowVehicule['name'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowVehicule['model'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowVehicule['mark'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowVehicule['c_name'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowVehicule['plaque'] . '</td>';
						echo '<td hidden="true" class="sorting_1 center">' . $rowVehicule['kilometre'] . '</td>';
						echo '<td hidden="true" class="sorting_1 center">' . $rowVehicule['litre_cent'] . '</td>';
						echo '<td class="sorting_1 center"><img width="50px" src="upload/carte_grise/' . $rowVehicule['id'] . '" onClick="openFullscreen(this.src)"></td>';
						echo '<td class="sorting_1 center"><img width="50px" src="upload/photo/' . $rowVehicule['id'] . '" onClick="openFullscreen(this.src)"></td>';
						echo '<td hidden="true" class="sorting_1 center">' . dateFr($rowVehicule['date'], false) . '</td>';
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
if ($resultVehicule->num_rows !== 0) {
    $queryCarburant = 'SELECT id, name FROM giv_carburant';
    $resultCarburant = $mysqli->query($queryCarburant);
    while ($rowCarburant = $resultCarburant->fetch_array()) {
        $rowsCarburant[] = $rowCarburant;
    }
    foreach ($rowsVehicule as $key => $rowVehicule) {
?>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-<?php echo $rowVehicule['id']; ?>" aria-labelledby="modal-label-<?php echo $rowVehicule['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data" id="formMod-<?php echo $rowVehicule['id']; ?>">
          <input type="hidden" value="modAction" id="modAction" name="modAction">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Modification du véhicule</h4>
            </div>
            <div class="modal-body">
              <div class="form-group hidden" id="form_id_vehicule">
                <label class="col-sm-2 col-sm-2 control-label">Id</label>
                <div class="col-sm-10">
                  <input class="form-control" name="id_vehicule" id="id_vehicule" value="<?php echo $rowVehicule['id']; ?>">
                  <p class="help-block" id="help_id_vehicule"></p>
                </div>
              </div>
              <div class="form-group" id="form_name">
                <label class="col-sm-2 col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" id="name" value="<?php echo $rowVehicule['name']; ?>">
                  <p class="help-block" id="help_name"></p>
                </div>
              </div>
              <div class="form-group" id="form_model">
                <label class="col-sm-2 col-sm-2 control-label">Modèle</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="model" id="model" value="<?php echo $rowVehicule['model']; ?>">
                  <p class="help-block" id="help_model"></p>
                </div>
              </div>
              <div class="form-group" id="form_mark">
                <label class="col-sm-2 col-sm-2 control-label">Marque</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="mark" id="mark" value="<?php echo $rowVehicule['mark']; ?>">
                  <p class="help-block" id="help_mark"></p>
                </div>
              </div>
              <div class="form-group" id="form_plaque">
                <label class="col-sm-2 col-sm-2 control-label">Plaque</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" name="plaque" id="plaque" placeholder="'F 524-AA-75' ou 'F AA-229-AA 01'" value="<?php echo $rowVehicule['plaque']; ?>">
                  <p class="help-block" id="help_plaque"></p>
                </div>
              </div>
              <div class="form-group" id="form_carburant">
                <label class="col-sm-2 col-sm-2 control-label">Carburant</label>
                <div class="col-sm-10">
                  <select name="carburant" id="carburant" class="default">
                    <?php
						foreach ($rowsCarburant as $rowCarburant) {
							if ($rowVehicule['id_c'] === $rowCarburant['id']) {
								$selected = "selected='selected'";
							} else {
								$selected = '';
							}
							echo '<option ' . $selected . ' value="' . $rowCarburant['id'] . '">' . $rowCarburant['name'] . '</option>';
						}
					?>
                  </select>
                  <p class="help-block" id="help_carburant"></p>
                </div>
              </div>
              <div class="form-group" id="form_litre_cent">
                <label class="col-sm-2 col-sm-2 control-label">Litre au 100</label>
                <div class="col-sm-10">
                  <input class="form-control" step="0.001" min="0" name="litre_cent" id="litre_cent" type="number" value="<?php echo $rowVehicule['litre_cent']; ?>">
                  <p class="help-block" id="help_litre_cent"></p>
                </div>
              </div>
              <div class="form-group" id="form_kilometre">
                <label class="col-sm-2 col-sm-2 control-label">Kilomètre</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" min="0" max="9999999999" name="kilometre" id="kilometre" value="<?php echo $rowVehicule['kilometre']; ?>">
                  <p class="help-block" id="help_kilometre"></p>
                </div>
              </div>
              <div class="form-group" id="form_photo">
                <label class="control-label col-md-3">Photo au format JPG, facultatif</label>
                <div class="controls col-md-9">
                  <div class="fileupload fileupload-new">
                    <input type="file" class="default" name="photo" id="photo"/>
                    <p class="help-block" id="help_photo"></p>
                    <br />
                  </div>
                </div>
              </div>
              <div class="form-group" id="form_carte_grise">
                <label class="control-label col-md-3">Carte grise au format JPG, facultatif</label>
                <div class="controls col-md-9">
                  <div class="fileupload fileupload-new">
                    <input type="file" class="default" name="carte_grise" id="carte_grise"/>
                    <p class="help-block" id="help_carte_grise"></p>
                    <br />
                  </div>
                </div>
              </div>
              <div class="form-group" id="form_date_mise_service">
                <label class="col-lg-2 col-sm-2 control-label">Date mise en service</label>
                <div class="controls col-md-9">
                  <input type="date" class="default" name="date_mise_service" id="date_mise_service" value="<?php echo $rowVehicule['date']; ?>"/>
                  <p class="help-block" id="help_date_mise_service"></p>
                </div>
              </div>
              <div class="form-group" id="form_status_msg">
                <div class="controls col-md-9">
                  <div class="statusMsg"></div>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalDel-<?php echo $rowVehicule['id']; ?>" aria-labelledby="modal-label-<?php echo $rowVehicule['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data" id="formDel-<?php echo $rowVehicule['id']; ?>">
            <input type="hidden" value="delAction" id="delAction" name="delAction">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Suppression du véhicule</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input hidden="hidden" class="hidden" name="id_vehicule" id="id_vehicule" value="<?php echo $rowVehicule['id']; ?>">
                <h3>Etes-vous sur de vouloir supprimer <?php echo $rowVehicule['name']; ?> [<?php echo $rowVehicule['plaque']; ?>] ?</h3>
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
		sOut += '    <td><h4>Information complémentaire pour la ' + aData[2] + ' [' + aData[1] + ']</h4></td>';
		sOut += '    <td></td>';
		sOut += '    <td></td>';
		sOut += '  </tr>';
		sOut += '  <tr>';
		sOut += '    <td>Nombre de kilomètre : <strong>' + aData[7] + ' km</td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '  </tr>';
		sOut += '  <tr>';
		sOut += '    <td>Litre au 100 : <strong>' + aData[8] + ' l</td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '    <td>&nbsp;</td>';
		sOut += '  </tr>';
		sOut += '  <tr>';
		sOut += '    <td>Date de mise en service : <strong>' + aData[11] + '</td>';
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
if ($resultVehicule->num_rows !== 0) {
    foreach ($rowsVehicule as $key => $rowVehicule) {
?>

	$('#formMod-<?php echo $rowVehicule['id']; ?>').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'include/form_display_cars.php',
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
				
				
				valideInput(data.name, '#help_name', '#form_name', '#name');
				valideInput(data.model, '#help_model', '#form_model', '#model');
				valideInput(data.mark, '#help_mark', '#form_mark', '#mark');
				valideInput(data.plaque, '#help_plaque', '#form_plaque', '#plaque');
				valideInput(data.carburant, '#help_carburant', '#form_carburant', '#carburant');
				valideInput(data.litre_cent, '#help_litre_cent', '#form_litre_cent', '#litre_cent');
				valideInput(data.kilometre, '#help_kilometre', '#form_kilometre', '#kilometre');
				valideInput(data.date_mise_service, '#help_date_mise_service', '#form_date_mise_service', '#date_mise_service');
				valideInput(data.id_vehicule, '#help_id_vehicule', '#form_id_vehicule', '#id_vehicule');			
				//alert(data.nb_error);
				
				if(data.nb_error == 0){                    
					$('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
					$('#form_status_msg').addClass('has-success');
				}else{
					$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
					$('#form_status_msg').addClass('has-error');
				}
				$('#formMod-<?php echo $rowVehicule['id']; ?>').css("opacity","");
				$("#valider").removeAttr("disabled");
				
				
				document.location.reload(true);				
			},
			error: function() {
				$('#formMod-<?php echo $rowVehicule['id']; ?>').css("opacity","1");
				alert('Une erreur est survenue !');
			}
		});
	});
	
	$('#formDel-<?php echo $rowVehicule['id']; ?>').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'include/form_display_cars.php',
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

				valideInput(data.id_vehicule, '#help_id_vehicule', '#form_id_vehicule', '#id_vehicule');			
								
				if(data.nb_error == 0){                    
					$('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
					$('#form_status_msg').addClass('has-success');
				}else{
					$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
					$('#form_status_msg').addClass('has-error');
				}
				$('#formMod-<?php echo $rowVehicule['id']; ?>').css("opacity","");
				$("#valider").removeAttr("disabled");
				
				
				document.location.reload(true);				
			},
			error: function() {
				$('#formMod-<?php echo $rowVehicule['id']; ?>').css("opacity","1");
				alert('Une erreur est survenue !');
			}
		});
	});

	<?php
    }
}
?>

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