<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');
    
/*
 |--------------------------------------------------------------------------
 | CIUnit Framework Tests Directory                                        
 |--------------------------------------------------------------------------
 |
 | The folder your tests are located in, with a trailing slash: 
 |
 |	$config['CIUnit_Framework_Tests']	= 'tests/';  
 |
 | By default CIUnit will look for a folder "tests" under the application folder.
 */

$config['tests_path'] = APPPATH .'tests/';

/*
 |--------------------------------------------------------------------------
 | CIUnit Framework Resources Directory
 |--------------------------------------------------------------------------
 |
 | Typically this will be a folder named resources located in the root of your project, 
 | unless you've renamed it to something else. If you are not to put them in the root of your 
 | project you would have to modify both views located uder the ciunit package and make the 
 | used assets available to them.
 |
 */

$config['resources_path'] = 'resources/';

/* End of file config.php */
/* Location: ./application/third_party/ciunit/config/config.php */
