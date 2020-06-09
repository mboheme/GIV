<?php 
session_start();
$page = array(7,0);

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
<title>Calendrier - GIV</title>

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
      <div class="row">
        <div class="col-lg-12 main-chart"> 
          <!--CUSTOM CHART START -->
          <div class="border-head">
            <h3><i class="fa fa-angle-right"></i> Calendrier de <?php echo $_SESSION['info']['name']; ?></h3>
          </div>
        </div>
      </div>
      <!-- page start-->
      <div class="row mt">
        <aside class="col-lg-3 mt">
        <h4><i class="fa fa-angle-right"></i> Ajouter un évènement</h4>
        <div id="external-events">
        <form action="include/create_event.php" method="post" class="form-horizontal style-form">
         <div class="form-group">         
          <div class="input-group input-large">
            <span class="input-group-addon">Titre</span>
              <input type="text" name="title" class="form-control">
          </div>
         </div>
         <div class="form-group">         
          <div class="input-group input-large">
            <span class="input-group-addon">Couleur</span>
              <input type="color" name="backgroundColor" class="form-control" value="#c0c0c0">
          </div>
         </div>
          <div class="form-group">            
              <div class="input-group input-large" data-date="<?php echo time(); ?>" data-date-format="mm/dd/yyyy"> <span class="input-group-addon">Du </span>
                <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="from">
                <span class="input-group-addon"> à </span>
                <div class="input-group bootstrap-timepicker">
                  <input type="text" name="from-time" class="form-control timepicker-24">
                  <span class="input-group-btn">
                  <button class="btn btn-theme04" type="button"><i class="fa fa-clock-o"></i></button>
                  </span> </div>
              </div>
            
          </div>
          <div class="form-group">
            <div class="input-group input-large" data-date="<?php echo time(); ?>" data-date-format="mm/dd/yyyy"> <span class="input-group-addon">Au </span>
              <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="to">
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
            	<select multiple class="form-control multiple " name="jour[]" id="jour">
                  <option>Lundi</option>
                  <option>Mardi</option>
                  <option>Mercredi</option>
                  <option>Jeudi</option>
                  <option>Vendredi</option>
                  <option>Samedi</option>
                  <option>Dimanche</option>
                </select>
            </div>
          </div>
          <div class="form-group" id="week" hidden="true">
            <div class="input-group input-large"> <span class="input-group-addon">Semaines</span>
				      <input class="form-control" name="semaine" id="semaine" type="number" min="0" value="0"/>
            </div>
          </div>
          <div class="form-group" id="month" hidden="true">
            <div class="input-group input-large"> <span class="input-group-addon">Mois</span>
            	<select multiple class="form-control multiple" name="mois[]" id="mois">
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
          		<input class="form-control" name="annee" id="annee" type="number" min="0" value="0"/>
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
      </aside>
      <aside class="col-lg-9 mt">
        <section class="panel">
          <div class="panel-body">
            <div id="calendar"></div>
            <div class="slider"></div>
          </div>
        </section>
      </aside>
      </div>
      <!-- page end--> 
    </section>
    <!-- /wrapper --> 
  </section>
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
<script src='lib/fullcalendar/moment.min.js'></script> 
<script src='lib/fullcalendar/fullcalendar.min.js'></script> 
<script src='lib/fullcalendar/lang-all.js'></script> 
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
<script>

$(document).ready(function() {

	var currentLangCode = 'fr';
	
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'year, month, agendaWeek, agendaDay, list'
		},
		footer:{
			center: 'year'
		},
		defaultDate: new Date(),//'2015-07-04',
		lang: currentLangCode,
		editable: false,
		eventLimit: true, // allow "more" link when too many events
		events: {
			url: '/giv/include/get-events.php'
		}
		
	});
});

$("#valider").click(
	$('#calendar').fullCalendar('refetchEventSources', '/giv/include/get-events.php')
)

function addRepeat(){
  var repeat = document.getElementById("repeat");
  //alert(myselect.options[myselect.selectedIndex].value);
  switch (repeat.selectedIndex){
	case 1: 
		document.getElementById("day").hidden = false;
	break;
	case 2: 
		document.getElementById("week").hidden = false;
	break;
	case 3: 
		document.getElementById("month").hidden = false;
	break;
	case 4: 
		document.getElementById("year").hidden = false;
	break;
	  
  }
  
  
}

</script> 
<script>
setTimeout(function(){
   $('body').load("content/lock_screen.php");
   document.cookie = "expire=true"; 
}, <?php echo expiresession; ?>);

</script> 
</body>
</html>