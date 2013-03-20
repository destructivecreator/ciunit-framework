<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CIUnit Web Interface</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <!-- Le styles -->
  <link type="text/css" rel="stylesheet" href="<?php echo base_url($resources_path . "css/bootstrap.css") ; ?>">
  
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
  <!-- /.navbar-wrapper -->
  
  <div class="container">
    <div class="row-fluid">
      <div class="span3">
        <ul class="nav nav-list">
          <li class="nav-header"><i class="icon-folder-open"></i>&nbsp;Tests</li>
          <?php
          
          sort($test_tree);
          
          foreach ($test_tree as $branch => $leaf)
          {
            echo '<li class="'
                  . ( ( $this->uri->segment(2) == $leaf ) ? 'active' : '' )
                  . '">'
                  . anchor('ciunit/' . $leaf, $leaf)
                  . "</li>";
          }

          ?>
        </ul>
      </div>
      
      <div class="span9">
        <?php if ( isset($ciunit_warning) ) : ?>
          <div class="alert alert-info">
            <strong>Warning!</strong> <?php echo $ciunit_warning; ?>
          </div>
        <?php endif; ?>
        
        <?php
          if ( isset($runner) ) :
            if( $runner->getPresenter()->wasSuccessful() )
            {
              if( $runner->getPresenter()->hasWarnings() )
              {
                $bar = 'warning';
              }
              else
              {
                $bar = 'success';
              }
            }
            else
            {
              $bar = 'danger';
            }
        ?>
        
        <div class="progress">
          <div class="bar bar-<?php echo $bar;?>" style="width: 100%;"></div>
        </div>
        
        <strong><?php echo nl2br($runner->getPresenter()->getHeader()); ?></strong>
        
        <hr class="divider" />
        
        <div class="">
          <span class="pull-right">
            <button class="btn btn-small btn-inverse pull-right" type="button" onClick="document.location.reload(true)">
              <i class="icon-refresh icon-white"></i>&nbsp;Run again
            </button>
          </span>
          
          <h4 class="pull-left"><?= $runner->getClassName();?></h4>
        </div>
        
        <table class="table">
          <tbody>
            <?php
            
            
            $failures = $runner->getPresenter()->getFailures();
            
            foreach ( $failures as $defect => $d ) : ?>
              <tr class="error">
                <td><strong><?php print $d['header']?></strong><span class="label label-important pull-right">Failure</span><br /><br />
                  <div id="info">
                    <pre><code><?php print $d['trace'];?></code></pre>
                  </div>
                </td>
              </tr>
            <?php endforeach;
            # END foreach ( $failures )
            
            
            $errors = $runner->getPresenter()->getErrors();
            
            foreach ( $errors as $defect => $d ) : ?>
              <tr class="error">
                <td><strong><?php print $d['header']?></strong> <span class="label label-important pull-right">Error</span><br /><br />
                  <div id="info">
                    <pre><code><?php print $d['trace'];?></code></pre>
                  </div>
                </td>
              </tr>
              <?php endforeach;
              # END foreach ( $errors )
              
              
              $skipped = $runner->getPresenter()->getSkipped();
              
              foreach ( $skipped as $defect => $d ) : ?>
                <tr class="warning">
                  <td><strong><?php print $d['header']?></strong> <span class="label label-warning pull-right">Skipped</span><br /><br />
                  <div id="info">
                    <pre><code><?php print $d['trace'];?></code></pre>
                    </div>
                  </td>
                </tr>
              <?php endforeach;
              # END foreach ( $skipped )
              
              
              $incomplete = $runner->getPresenter()->getIncompletes();
              
              foreach ( $incomplete as $defect => $d ) : ?>
                <tr class="warning">
                  <td><strong><?php print $d['header']?></strong> <span class="label label-warning pull-right">Incomplete</span><br /><br />
                    <div id="info">
                      <pre><code>Test did not perform any assertions </code></pre>
                    </div>
                  </td>
                </tr>
              <?php endforeach;
              # END foreach ( $incomplete )
              ?>
          </tbody>
        </table>
        
        <?php
        else : ?>
          <h2>Happy testing with CIUnit</h2>
          
          <h4>Please, select a test from the left side menu.</h4>
        <?php endif;
        # END isset($runner)
        ?>
      </div>
    </div>
    
    
    <hr class="divider" />
    
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
