<!DOCTYPE HTML>
<html>
<head>
<title>Shopdesk</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"> </script>
  
<!-- Mainly scripts -->
<script src="js/jquery.metisMenu.js"></script>
<script src="js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="css/custom.css" rel="stylesheet">
<script src="js/custom.js"></script>
<script src="js/screenfull.js"></script>
		<script>
		$(function () {
			$('#supported').text('Supported/allowed: ' + !!screenfull.enabled);

			if (!screenfull.enabled) {
				return false;
			}

			

			$('#toggle').click(function () {
				screenfull.toggle($('#container')[0]);
			});
			

			
		});
		$(document).ready(function() {
			
		})
		
		function mainS(){
			$('#main-status').html('<span class="alert alert-success"><i class="fa fa-check"></i> Successful</span>');
			$('#main-status').fadeToggle();
			$('#main-status').delay(1000).fadeToggle();
		}
		function mainE(){
			$('#main-status').html('<span class="alert alert-danger"><i class="fa fa-times"></i> Unsuccessful</span>');
			$('#main-status').fadeToggle();
			$('#main-status').delay(1000).fadeToggle();
		}
		function start() {
			$('#wait').fadeIn()
		}
		function end() {
			$('#wait').fadeOut()
		}
		function error() {
			end();
			$('#error').fadeIn()
			$('#error').delay(1500).fadeOut()
		}
		function success() {
			end();
			$('#success').fadeIn()
			$('#success').delay(1500).fadeOut()
		}
		function validateEmail(email) {
			var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}
		</script>



<link href="css/bootstrap-select.min.css" rel='stylesheet' type='text/css' />

<link href="lib/jqueryui/jquery-ui.css" rel='stylesheet' type='text/css' />
<link href="lib/jqueryui/jquery-ui.theme.css" rel='stylesheet' type='text/css' />
<script type="text/javascript" src="lib/jqueryui/jquery-ui.js"></script>
<link href="lib/bootstrap-switch/bootstrap-switch.min.css" rel='stylesheet' type='text/css' />
<script type="text/javascript" src="lib/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="./js/bootstrap-select.min.js"></script>
<link href="css/app.css" rel='stylesheet' type='text/css' />

</head>
<body>

<div id="wait" class="alert alert-info"><i class="fa fa-cog fa-spin"></i> Please Wait</div>
<div id="error" class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> An error occoured</div>
<div id="success" class="alert alert-success"><i class="fa fa-check"></i> Successful</div>

<div id="main-status" style="position: fixed; right: 50px; top:50px; z-index: 999; display:none">
</div>
<div id="wrapper">
       <!--- -->
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1 style="font-family: 'Comfortaa', cursive;">  <a class="navbar-brand" href="javascript:void(0)"><center><!--img src="./images/logo.png" style="height:30px; width: auto; padding-right: 3px;"-->shopdesk</center></a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<button id="toggle"><i class="fa fa-arrows-alt"></i></button>	
			</section>
			
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="drop-men" >
		        <ul class=" nav_1">
		           
					<li class="dropdown">
		              <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><span id="storeName">Shopdesk</span>&nbsp;<i class="caret"></i></span><img src="images/admin.png" style="height:50px; width: auto; padding-top: 8px; padding-right: 8px"></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="javascript:void(0)"><i class="fa fa-sign-out"></i>Logout</a></li>
		              </ul>
		            </li>
		           
		        </ul>
		     </div><!-- /.navbar-collapse -->
			<div class="clearfix">
       
     </div>
	  
		    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
				
                    <li>
                        <a href="./" class=" hvr-bounce-to-right nav-link activex" id="nav-dashboard"><i class="fa fa-home nav_icon "></i><span class="nav-label">Home</span> </a>
                    </li>
                   					
                </ul>
            </div>
			</div>
        </nav>
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">

<div class="blank">
	

<div id="app-content" class="blank-page">
	<h1>Shopdesk Admin Panel</h1>

	<div class="clearfix"></div>
</div>


</div>
	
	<!--//faq-->
		<!---->
<div class="copy">
            <p> &copy; <?php echo date('Y'); ?> Shopdesk. All Rights Reserved | Powered by <a href="http://shopdesk.co/" target="_blank">Shopdesk</a> </p>	    </div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     
	<script src="js/scripts.js"></script>


</body>
</html>
