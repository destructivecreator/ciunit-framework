<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
/**
 * CodeIgniter controller for displaying the web interface of CIUnit
 *
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @since      File available since Release 1.0.0
 */
class CIUnit_Controller extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index ($testCase = '')
    {   
        // Add ciunit package to codeigniter path
        $this->load->add_package_path(APPPATH.'third_party/ciunit', FALSE);
        $this->load->config('config');
        

        // Load library
        $this->load->library('ciunit');
        $this->load->helper('url');
        
        $data['test_tree'] = $this->ciunit->getTestCollection();
        
        $data['resources_path'] = $this->config->item('resources_path');
        $data['run_failure'] = '';
        
        // Version 2.0.0 has no ENVIRONMENT support
        if(!defined('ENVIRONMENT')) {
            // Apply hack by defining ENVIRONMENT and set it to undefined
            define('ENVIRONMENT', 'testing');
            $data['ciunit_warning'] = "Your version of CodeIgniter does not support environments. Simulating testing environment !";
        }
        
        // Check CI version 
         if(!defined('CI_VERSION')) {
              $data['run_failure'] = "CIUnit can't detect the version of your CodeIgniter application.";
              $this->load->view('error', $data);
              
              return;
         }
            
         // Check versions 
         if(substr(CI_VERSION, 0, 3) == '2.0') { 
             // Apply fix for versions >= 2.0.0 && < 2.1.0
             $orig_view_path = $this->load->_ci_view_path;
             $this->load->_ci_view_path = APPPATH.'third_party/ciunit/views/';
         }
        
        // Check against environment 
        if(ENVIRONMENT == 'testing' || ENVIRONMENT == 'development') { 
            
            if($testCase != '') {
                $this->ciunit->run($testCase);
                
                if($this->ciunit->runWasSuccessful()) {
                    $data['runner'] = $this->ciunit->getRunner();  
                    
                    $this->load->view('index', $data);
                    return;
                }
            }
            else {
                if($this->ciunit->getRunFailure() == NULL) { 
                    $this->load->view('index', $data);
                    return;
                }
            }  
            
             $data['run_failure'] = sprintf("Error: %s", $this->ciunit->getRunFailure());
   
        } 
        else if(ENVIRONMENT == 'production') {  
             $data['run_failure'] = "Unit Testing is not available in production environment!";
        } 
         
         
        $this->load->view('error', $data);
        
        // Restore view path for versions < 2.1.0
        if(substr(CI_VERSION, 0, 3) == '2.0') {
            $this->load->_ci_view_path = $orig_view_path;
        }
        
        // Restore paths
        $this->load->remove_package_path(APPPATH.'third_party/ciunit');
    }
}


/* End of file ciunit_controller.php */
/* Location: ./application/controllers/ciunit_controller.php */