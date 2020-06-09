<?php
session_start();
$page = array(4, 1);
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
<title>Afficher - Interventions - GIV</title>

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
      <h3><i class="fa fa-angle-right"></i> Affichage des Interventions</h3>
      <div class="row mb"> 
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table">
            <table cellpadding="0" cellspacing="0" class="display table table-bordered" id="hidden-table-info">
              <thead>
                <tr>
                  <th hidden="true">id</th>
                  <th>Nom</th>
                  <th hidden="true">Composants</th>
                  <th>Description</th>
                  <th hidden="true">id</th>
                  <th>Véhicule</th>
                  <th hidden="true">Kilomètre</th>
                  <th>Date</th>
                  <th>Devis</th>
                  <th>Facture</th>
                  


                </tr>
              </thead>
              <tbody>
				<?php
				require_once ('include/db_private/db_connection.php');
				$mysqli = OpenCon();
				$queryIntervention = "SELECT giv_intervention.*, giv_vehicule.id AS v_id, giv_vehicule.name AS v_name FROM giv_intervention INNER JOIN giv_vehicule ON giv_intervention.id_vehicule = giv_vehicule.id ORDER BY giv_intervention.id DESC;";
				$resultIntervention = $mysqli->query($queryIntervention);
				if ($resultIntervention->num_rows !== 0) {
					while ($rowIntervention = $resultIntervention->fetch_array()) {
						$rowsIntervention[] = $rowIntervention;
					}
					foreach ($rowsIntervention as $rowIntervention) {
				?>
					<tr class="gradeA">
					  <?php
						echo '<td hidden="true" class="sorting_1 center">' . $rowIntervention['id'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowIntervention['name'] . '</td>';
            echo '<td hidden="true" class="sorting_1 center">';
            $querySC = 'SELECT * FROM `giv_sous_categorie_intervention` 
            INNER JOIN giv_sous_categorie ON giv_sous_categorie_intervention.id_sous_categorie = giv_sous_categorie.id
            WHERE giv_sous_categorie_intervention.id_intervention = '.$rowIntervention['id'].';';
            $resultSC = $mysqli->query($querySC);
            if ($resultSC->num_rows !== 0) {
              while ($rowSC = $resultSC->fetch_array()) {
                echo '<p><a>'.$rowSC['name'].'</a></p>';
              }
            }
            echo '</td>';
            echo '<td  class="sorting_1 center">' . $rowIntervention['description'] . '</td>';
            echo '<td hidden="true" class="sorting_1 center">' . $rowIntervention['v_id'] . '</td>';
						echo '<td class="sorting_1 center">' . $rowIntervention['v_name'] . '</td>';
						echo '<td hidden="true" class="sorting_1 center">' . $rowIntervention['kilometre'] . '</td>';
						echo '<td class="sorting_1 center">' . dateFr($rowIntervention['date'], true) . '</td>';
						echo '<td class="sorting_1 center"><img width="50px" src="upload/devis/' . $rowIntervention['id'] . '" onClick="openFullscreen(this.src)"></td>';
            echo '<td class="sorting_1 center"><img width="50px" src="upload/facture/' . $rowIntervention['id'] . '" onClick="openFullscreen(this.src)"></td>';
            

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
if ($resultIntervention->num_rows !== 0) {
    foreach ($rowsIntervention as $key => $rowIntervention) {
?>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-<?php echo $rowIntervention['id']; ?>" aria-labelledby="modal-label-<?php echo $rowIntervention['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data" id="formMod-<?php echo $rowIntervention['id']; ?>">
            <div class="modal-header">
              <input type="hidden" value="modAction" id="modAction" name="modAction">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Modification de l'intervention</h4>
            </div>
            <div class="modal-body">
              <div class="form-group hidden" id="form_id_intervention">
                <label class="col-sm-2 col-sm-2 control-label">Id</label>
                <div class="col-sm-10">
                  <input class="form-control" name="id_intervention" id="id_intervention" value="<?php echo $rowIntervention['id']; ?>">
                  <p class="help-block" id="help_id_intervention"></p>
                </div>
              </div>
              <div class="form-group" id="form_name">
                <label class="col-sm-2 col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" id="name" value="<?php echo $rowIntervention['name']; ?>">
                  <p class="help-block" id="help_name"></p>
                </div>
              </div>
              <div class="form-group" id="form_description">
                <label class="col-sm-2 col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="description" id="description"><?php echo $rowIntervention['description']; ?></textarea>
                  <p class="help-block" id="help_description"></p>
                </div>
              </div>
              <div class="form-group" id="form_v_id" hidden>
                <label class="col-sm-2 col-sm-2 control-label">Id du Véhicule </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="v_id" id="v_id" value="<?php echo $rowIntervention['v_id']; ?>">
                  <p class="help-block" id="help_v_iv"></p>
                </div>
              </div>
              <div class="form-group" id="form_kilometre">
                <label class="col-sm-2 col-sm-2 control-label">Kilomètre</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" min="0" max="9999999999" name="kilometre" id="kilometre" value="<?php echo $rowIntervention['kilometre']; ?>">
                  <p class="help-block" id="help_kilometre"></p>
                </div>
              </div>
              <div class="form-group" id="form_devis">
                <label class="control-label col-md-3">Devis au format JPG, facultatif</label>
                <div class="controls col-md-9">
                  <div class="fileupload fileupload-new">
                    <input type="file" class="default" name="devis" id="devis"/>
                    <p class="help-block" id="help_devis"></p>
                    <br />
                  </div>
                </div>
              </div>
              <div class="form-group" id="form_facture">
                <label class="control-label col-md-3">Facture au format JPG, facultatif</label>
                <div class="controls col-md-9">
                  <div class="fileupload fileupload-new">
                    <input type="file" class="default" name="facture" id="facture"/>
                    <p class="help-block" id="help_facture"></p>
                    <br />
                  </div>
                </div>
              </div>
              <div class="form-group" id="form_date_intervention">
                <label class="col-lg-2 col-sm-2 control-label">Date de l'intervention</label>
                <div class="controls col-md-9">
                  <input type="date" class="default" name="date_intervention" id="date_intervention" value="<?php echo $rowIntervention['date']; ?>"/>
                  <p class="help-block" id="help_date_intervention"></p>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalDel-<?php echo $rowIntervention['id']; ?>" aria-labelledby="modal-label-<?php echo $rowIntervention['id']; ?>" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form enctype="multipart/form-data" id="formDel-<?php echo $rowIntervention['id']; ?>">
            <div class="modal-header">
              <input type="hidden" value="delAction" id="delAction" name="delAction">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Suppression du véhicule</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input hidden="hidden" class="hidden" name="id_intervention" id="id_intervention" value="<?php echo $rowIntervention['id']; ?>">
                <h3>Etes-vous sur de vouloir supprimer <?php echo $rowIntervention['name']; ?> [<?php echo $rowIntervention['id']; ?>] ?</h3>
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
		sOut += '    <td><h4>Nom de l\'intervention : ' + aData[2] + ' [' + aData[1] + ']</h4></td>';
    sOut += '  </tr>';
    sOut += '  <tr>';
		sOut += '    <td>Le : <strong>' + aData[8] + '</strong></td>';
    sOut += '  </tr>';
    sOut += '  <tr>';
		sOut += '    <td>Composants : <strong>' + aData[3] + '</strong></td>';
    sOut += '  </tr>';
		sOut += '  <tr>';
    sOut += '    <td>Nombre de kilomètre : <strong>' + aData[7] + ' km </strong></td>';
    sOut += '  </tr>';

    // <th hidden="true">id</th>
    //               <th>Nom</th>

    //               <th>Description</th>
    //               <th hidden="true">id</th>
    //               <th>Véhicule</th>
    //               <th hidden="true">Kilomètre</th>
    //               <th>Date</th>
    //               <th>Carte grise</th>
    //               <th>Photo</th>

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
    foreach ($rowsIntervention as $key => $item) {
    ?>

	$('#formMod-<?php echo $item['id']; ?>').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'include/form_display_intervention.php',
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
				
				valideInput(data.id_intervention, '#help_id_intervention', '#form_id_intervention', '#id_intervention');
				valideInput(data.name, '#help_name', '#form_name', '#name');
				valideInput(data.description, '#help_description', '#form_description', '#description');
				valideInput(data.v_id, '#help_v_id', '#form_v_id', '#v_id');
				valideInput(data.kilometre, '#help_kilometre', '#form_kilometre', '#kilometre');
				valideInput(data.date_intervention, '#help_date_intervention', '#form_date_intervention', '#date_intervention');
				valideInput(data.id_vehicule, '#help_id_vehicule', '#form_id_vehicule', '#id_vehicule');			
				
				if(data.nb_error == 0){                    
					$('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
					$('#form_status_msg').addClass('has-success');
				}else{
					$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
					$('#form_status_msg').addClass('has-error');
				}
				$('#formMod-<?php echo $rowIntervention['id']; ?>').css("opacity","");
				$("#valider").removeAttr("disabled");
				
				alert(data.error);
				document.location.reload(true);				
			},
			error: function() {
				$('#formMod-<?php echo $item['id']; ?>').css("opacity","1");
				alert('Une erreur est survenue !');
			}
		});
	});
	
	$('#formDel-<?php echo $item['id']; ?>').on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'include/form_display_intervention.php',
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

				valideInput(data.id_intervention, '#help_id_intervention', '#form_id_intervention', '#id_intervention');			
								
				if(data.nb_error == 0){                    
					$('.statusMsg').html('<p class="help-block">Enregistrement réussit.</p>');
					$('#form_status_msg').addClass('has-success');
				}else{
					$('.statusMsg').html('<p class="help-block has-error">Erreur lors de l\'enregistrement. Celui-ci n\'a pas été sauvegardé.</p>');
					$('#form_status_msg').addClass('has-error');
				}
				$('#formMod-<?php echo $item['id']; ?>').css("opacity","");
				$("#valider").removeAttr("disabled");
				
        //alert(data.error);
				
				document.location.reload(true);				
			},
			error: function() {
				$('#formMod-<?php echo $item['id']; ?>').css("opacity","1");
				alert('Une erreur est survenue !');
			}
		});
	});

	<?php
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