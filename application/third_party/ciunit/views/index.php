<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CIUnit Web Interface</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link	href="<?php print base_url() . $resources_path . "css/bootstrap.css" ; ?>"	rel="stylesheet"> 
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
				<?php echo anchor('ciunit', 'CIUnit Framework ' . CIUNIT_VERSION, array('class' => 'brand')); ?>
			</div>
			<!-- /.navbar-inner -->
		</div>
		<!-- /.navbar -->

	</div>

	<div class="container">
		<div class="row-fluid">
			<div class="span3">
				<ul class="nav nav-list">

					<li class="nav-header"><i class="icon-folder-open"></i>Tests</li> 
                       <?php
                    
                    sort($test_tree);
                    
                    foreach ($test_tree as $branch => $leaf) {
                        print 
                                "<li " .
                                         (($this->uri->segment(2) == $leaf) ? "class=\"active\"" : '') .
                                         ">" . anchor('ciunit/' . $leaf, $leaf) .
                                         "</li>";
                    }
                    
                    ?> 
                        
                         
          </ul>
			</div>

			<div class="span9">
			<?php if (isset($ciunit_warning)) { ?>
			    <div class="alert alert-info">
					<strong>Warning!</strong> <?php echo $ciunit_warning; ?>
                </div> 
			 <?php
}
?>
			 
			 <?php
                if (isset($runner)) {
                    
            
                    if($runner->getPresenter()->wasSuccessful()) {
                        if($runner->getPresenter()->hasWarnings()) {
                            $bar = 'warning';
                        }
                        else {
                            $bar = 'success';
                        }
                    } 
                    else {
                        $bar = 'danger';
                    }
            
                    ?>
			
				<div class="progress">
					<div
						class="bar bar-<?php echo $bar;?>"
						style="width: 100%;"></div>
				</div>

				<b><?php  print str_replace("\n", "<br/>", $runner->getPresenter()->getHeader());?></b>

				<hr class="divider">

				<div class="">
					<span class="pull-left">
						<h4><?= $runner->getClassName();?></h4>
					</span> <span class="pull-right">
						<button class="btn btn-small  btn-inverse pull-right"
							type="button" onClick="document.location.reload(true)">
							<i class="icon-refresh icon-white"></i> Run again
						</button>
					</span>
				</div>
				<table class="table">
					<tbody>
                      	<?php
        $failures = $runner->getPresenter()->getFailures();
        foreach ($failures as $defect => $d) {
            ?> 
                        	    <tr class="error">
							<td><b><?php print $d['header']?></b> <span
								class="label label-important pull-right">Failure</span><br /> <br />
								<div id="info">
									<pre><code><?php print $d['trace'];?></code></pre>
								</div></td>
						</tr>
                        				
                        <?php
        }
        
        $errors = $runner->getPresenter()->getErrors();
        foreach ($errors as $defect => $d) {
            ?>
				
        						<tr class="error">
							<td><b><?php print $d['header']?></b> <span
								class="label label-important pull-right">Error</span><br /> <br />
								<div id="info">
									<pre><code><?php print $d['trace'];?></code></pre>
								</div></td>
						</tr>
        				<?php
        }
        
        $skipped = $runner->getPresenter()->getSkipped();
        foreach ($skipped as $defect => $d) {
            ?>
				
						        <tr class="warning">
							<td><b><?php print $d['header']?></b> <span
								class="label label-warning pull-right">Skipped</span><br /> <br />
                                <div id="info">
									<pre><code><?php print $d['trace'];?></code></pre>
								</div></td>
						</tr>
                    	<?php
        }
        
        $incomplete = $runner->getPresenter()->getIncompletes();
        foreach ($incomplete as $defect => $d) {
            ?>
        				
        						        <tr class="warning">
        							<td><b><?php print $d['header']?></b> <span
        								class="label label-warning pull-right">Incomplete</span><br /> <br />
                                        <div id="info">
        									<pre><code>Test did not perform any assertions </code></pre>
        								</div></td>
        						</tr>
                            	<?php
                }
        ?>
				     </tbody>
				</table>

                <?php
    } 

    else {
        print 
                "<h2>Happy testing with CIUnit</h2><h4>Please, select a test from the left side menu.</h4>";
    }
    
    ?>
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
</body>
</html>