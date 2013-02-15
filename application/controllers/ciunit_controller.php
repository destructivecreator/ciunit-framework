<?php
  

class CIUnit_Controller extends CI_Controller
{

    public function index ($testCase = '')
    {   
        // Add ciunit package to codeigniter path
        $this->load->add_package_path(APPPATH.'third_party/ciunit', FALSE);
        
        // Check against environment 
        if(ENVIRONMENT != 'production') { 
            
            // Load library
            $this->load->library('ciunit'); 
            

            $data['testcases'] = $this->ciunit->buildTestTree();
            if($testCase != '') {
                $this->ciunit->run($testCase);
                
                if($this->ciunit->runWasSuccessful()) {
                    $data['runner'] = $this->ciunit->getRunner();  
                    
                    $this->load->view('index', $data);
                    return;
                }
            }
            else {
                $this->load->view('index', $data);
                return;
            }  
            
            $data['run_failure'] = sprintf("Error: %s", $this->ciunit->getRunFailure());
            $this->load->view('error', $data);
            
            return;
        }  
        
        $data['run_failure'] = "Unit Testing is not available in production environment!";
        $this->load->view('error', $data);
        
        // Restore path
        $this->load->remove_package_path(APPPATH.'third_party/ciunit');
    }
}

?>