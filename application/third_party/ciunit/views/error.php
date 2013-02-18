<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CIUnit Web Interface</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="<?php print base_url() . $resources_path . "css/bootstrap.css" ; ?>"  rel="stylesheet">
<link href="<?php print base_url() . $resources_path . "css/bootstrap-responsive.css" ; ?>" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>

	<!-- NAVBAR -->
	<div class="navbar-wrapper">

		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<?php echo anchor('ciunit', 'CIUnit Framework 1.0', array('class' => 'brand')); ?>
			</div>
			<!-- /.navbar-inner -->
		</div>
		<!-- /.navbar -->

	</div>
	<!-- /.container -->

	<div class="container">


		<div class="row-fluid">
		
		<div class="span3">
				<ul class="nav nav-list"> 
					
					<li class="nav-header"><i class="icon-folder-open"></i>Tests</li> 
                       <?php
                           
                           sort($test_tree);
                       
                            foreach ($test_tree as $branch => $leaf) {
                                print 
                                        "<li " . (($this->uri->segment(2) == $leaf) ? "class=\"active\"" : '') . ">" . anchor('ciunit/' . $leaf, $leaf) . "</li>";
                            }
                    
                        ?> 
                        
                         
          </ul>
			</div>
			<div class="span9">
				<h1><?php print $run_failure; ?></h1>

			</div>
		</div>


		<hr class="divider">
		<footer>
			<p class="pull-right">
				<a href="#">Back to top</a>
			</p>
			<p>&copy; 2013 CIUnit.</p>
		</footer>

	</div>
	<!-- /.container -->



	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!--     <script src="../assets/js/bootstrap-transition.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-alert.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-modal.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-dropdown.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-scrollspy.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-tab.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-tooltip.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-popover.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-button.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-carousel.js"></script> -->
	<!--     <script src="../assets/js/bootstrap-typeahead.js"></script> -->
</body>
</html>