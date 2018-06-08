<!DOCTYPE HTML>
<html ng-app="cartify">
<head>
<title>Cartify</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!-- <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet"> -->

<link href="<?php echo base_url(); ?>assets/css/style.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet"> 
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"> </script>
<!-- Mainly scripts -->
<script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
<!-- Custom and plugin javascript -->
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/screenfull.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<link href="<?php echo base_url(); ?>assets/css/bootstrap-select.min.css" rel='stylesheet' type='text/css' />

<link href="<?php echo base_url(); ?>assets/lib/jqueryui/jquery-ui.css" rel='stylesheet' type='text/css' />
<link href="<?php echo base_url(); ?>assets/lib/jqueryui/jquery-ui.theme.css" rel='stylesheet' type='text/css' />
<script type="<?php echo base_url(); ?>assets/text/javascript" src="lib/jqueryui/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>assets/lib/bootstrap-switch/bootstrap-switch.min.css" rel='stylesheet' type='text/css' />
<script type="<?php echo base_url(); ?>assets/text/javascript" src="lib/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/upload.js"></script>

<!-- ANGULAR -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/loader/loader.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/angular-switch/style.css">
<link href="<?php echo base_url(); ?>public/libs/angular-strap/libs.min.css" rel='stylesheet' type='text/css' />
<link rel='stylesheet' href='<?php echo base_url(); ?>/bower_components/textAngular/dist/textAngular.css'>

<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
</script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.css">



<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/libs/pikaday/pikaday.css">

<link href="<?php echo base_url(); ?>assets/css/app.css" rel='stylesheet' type='text/css' />
</head>
<style type="text/css">
    div#preloader { position: fixed; left: 0; top: 0; z-index: 999; width: 100%; height: 100%; overflow: visible; background: #fff url('<?php echo base_url();?>assets/images/load2.gif') no-repeat center center; }
</style>
<body>
<div id="preloader"></div>

<div id="wait" class="alert alert-info"><i class="fa fa-cog fa-spin"></i> Please Wait</div>
<div id="error" class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> An error occoured</div>
<div id="success" class="alert alert-success"><i class="fa fa-check"></i> Successful</div>
<div id="snackbar" style=""><small style=" color:#fff!important;" id="sd-msg">Some text some message..</small></div>

<div id="main-status" style="position: fixed; right: 50px; top:50px; z-index: 999; display:none">
</div>
<div id="wrapper">
       <!--- -->
        <nav class="navbar-default navbar-static-top" role="navigation">
             <div class="navbar-header"  style="background: #446a81;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <h1 style="background: #446a81;"> <a class="navbar-brand" href="javascript:void(0)"><center><!--img src="./images/logo.png" style="height:30px; width: auto; padding-right: 3px;"--><small style="color:#fff!important;" class="hidden-xs"><i class="fa fa-shopping-basket"></i></small> <tt>cartify</tt></center></a></h1>         
			   </div>
			 <div class=" border-bottom">
        	<div class="full-left">
        	  <section class="full-top">
				<!-- <button id="toggle"><i class="fa fa-arrows-alt"></i></button>	 -->
			</section>
			
            <div class="clearfix"> </div>
           </div>
     
       
            <!-- Brand and toggle get grouped for better mobile display -->
		 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="drop-men" >
		        <ul class=" nav_1">
		           
					<li class="dropdown">
		              <a href="javascript:void(0)" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><span id="storeName"><?php echo $store_name; ?></span>&nbsp;<i class="caret"></i></span><img src="<?php echo base_url(); ?>assets/images/admin.png" style="height:50px; width: auto; padding-top: 8px; padding-right: 8px"></a>
		              <ul class="dropdown-menu " role="menu">
		                <li><a href="<?php echo base_url(); ?>/app/logout"><i class="fa fa-sign-out"></i>Logout</a></li>
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
                        <a href="javascript:void(0)" ui-sref="home" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('home')}" id="nav-dashboard"><i class="fa fa-home nav_icon "></i><span class="nav-label">Home</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="customers" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('customers')}" id="nav-dashboard"><i class="fa fa-users nav_icon "></i><span class="nav-label">Customers</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="categories" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('categories')}" id="nav-dashboard"><i class="fa fa-tag nav_icon "></i><span class="nav-label">Categories</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="products" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('products')}" id="nav-dashboard"><i class="fa fa-cube nav_icon "></i><span class="nav-label">Products</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="collections" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('collections')}" id="nav-dashboard"><i class="fa fa-sitemap nav_icon "></i><span class="nav-label">Collections</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="coupons" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('coupons')}" id="nav-dashboard"><i class="fa fa-ticket nav_icon "></i><span class="nav-label">Coupons</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="taxes" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('taxes')}" id="nav-dashboard"><i class="fa fa-bank nav_icon "></i><span class="nav-label">Taxes</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="pages" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('pages')}" id="nav-dashboard"><i class="fa fa-text-width nav_icon "></i><span class="nav-label">Pages</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="shippings" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('shippings')}" id="nav-dashboard"><i class="fa fa-ship nav_icon "></i><span class="nav-label">Shippings</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="orders" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('orders')}" id="nav-dashboard"><i class="fa fa-file-text-o nav_icon "></i><span class="nav-label">Orders</span> </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" ui-sref="api" class=" hvr-bounce-to-right nav-link" ng-class="{activex: $state.includes('api')}" id="nav-dashboard"><i class="fa fa-cloud nav_icon "></i><span class="nav-label">API</span> </a>
                    </li>

                        



                   			
                </ul>
            </div>
			</div>
        </nav>
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">

<div class="blank">
	

<div id="app-content" class="blank-page">
	<ui-view></ui-view>

	<div class="clearfix"></div>
</div>


</div>
	
	<!--//faq-->
		<!---->
<div class="copy">
            <p> &copy; <?php echo date('Y'); ?> Cartify. All Rights Reserved | Powered by <a href="http://shopdesk.co/" target="_blank">Shopdesk</a> </p>	    </div>
		</div>
		</div>
		<div class="clearfix"> </div>
       </div>
     
	<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>

<!-- ANGULAR -->
<script src="<?php echo base_url(); ?>public/libs/angular.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-ui-router.js"></script>
<script src="<?php echo base_url(); ?>public/libs/ngStorage.js"></script>
<script src="<?php echo base_url(); ?>public/libs/loader/loader.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.js"></script>
<script src="<?php echo base_url(); ?>public/libs/trix.min.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-switch/script.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-strap/angular-animate.min.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-strap/angular-sanitize.min.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-strap/angular-strap.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-strap/angular-strap.tpl.js"></script>
<script src="<?php echo base_url(); ?>public/libs/angular-strap/angular-strap.docs.tpl.js"></script>
<script src="<?php echo base_url(); ?>public/libs/voucher_codes.js"></script>
<script src="<?php echo base_url(); ?>public/libs/pikaday/pikaday.js"></script>
<script src='<?php echo base_url(); ?>/bower_components/textAngular/dist/textAngular-rangy.min.js'></script>
<script src='<?php echo base_url(); ?>/bower_components/textAngular/dist/textAngular-sanitize.min.js'></script>
<script src='<?php echo base_url(); ?>/bower_components/textAngular/dist/textAngular.min.js'></script>

<script src="<?php echo base_url(); ?>public/app.js"></script>
<script src="<?php echo base_url(); ?>public/routes.js"></script>
<!-- CONTROLLERS -->
<script src="<?php echo base_url(); ?>public/controllers/home.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/categories.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/products.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/collections.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/coupons.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/taxes.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/shippings.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/orders.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/customers.controller.js"></script>
<script src="<?php echo base_url(); ?>public/controllers/pages.controller.js"></script>

</body>
</html>
