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
<link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
<link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">
<link href="css/style-responsive.css" rel="stylesheet">
<script src="lib/chart-master/Chart.js"></script>
</head>

<body>
<section id="container">
  <header class="header black-bg"> 
    <!--logo start--> 
    <a href="index.php" class="logo">
    <div title="GIV"><span>Gestionnaire d'Intervention sur Véhicules</span></div>
    </a> 
    <!--logo end--> 
  </header>
  <!--header end--> 
  
  <!--main content start-->
  <section id="content">
    <section class="wrapper"> 
    
      <!-- Connexion -->      
      <div class="form-panel">
        <h4 class="mb"><i class="fa fa-angle-right"></i> Connexion</h4>
        <form class="form-inline" role="form" method="post" action="include/form_login.php">
          <div class="form-group">
            <label class="sr-only" for="email">Adresse Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label class="sr-only" for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
          </div>
          <button type="submit" class="btn btn-theme">Se connecter</button>
        </form>
      </div>
      <!-- /form-panel --> 
      
      <!-- Message Erreur --> 
      <div class="row mt" hidden="true">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Input Messages</h4>
              <form class="form-horizontal tasi-form" method="get">
                <div class="form-group has-success">
                  <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Input with success</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputSuccess">
                  </div>
                </div>
                <div class="form-group has-warning">
                  <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Input with warning</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputWarning">
                  </div>
                </div>
                <div class="form-group has-error">
                  <label class="col-sm-2 control-label col-lg-2" for="inputError">Input with error</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputError">
                  </div>
                </div>
              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
        <!-- /Message Erreur -->
      
    </section>
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
<script src="lib/sparkline-chart.js"></script> 
<script src="lib/zabuto_calendar.js"></script> 
<script type="text/javascript">




    $(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashio!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo.',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });
  </script> 
<script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
  setTimeout(function(){
   $('body').load("content/lock_screen.php");
   document.cookie = "expire=true"; 
}, <?php echo expiresession; ?>);

</script> 
</body>
</html>
