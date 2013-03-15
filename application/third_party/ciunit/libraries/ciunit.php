<?php if (! defined('BASEPATH'))    exit('No direct script access allowed');

// Load the autoload file for t
require_once APPPATH . "third_party/ciunit/framework/autoload.php";

define('CIUNIT_VERSION', '1.2 Beta');

/**
 * CIUnit library class to use with CodeIgniter
 *
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

class Ciunit
{
    /** 
     * @var CIUnit_Framework_TestRunner
     */
    private $runner;

    /**
     * Exception message thrown during run
     * @var String
     */
    private $runFailure = NULL;

    /**
     * Instantiates a CIUnit_Framework_TestRunner with a testcase class
     * @param string $testCase
     */
    public function run ($testCase)
    {
        
        try {
            if ($this->runner == NULL) {
                $this->runner = new CIUnit_Framework_TestRunner($testCase);
            }
        
            $this->runner->run();
        } catch (CIUnit_Framework_Exception_CIUnitException $e) {
            $this->runFailure = $e->getMessage();
        }
    }

    /**
     * 
     * @return CIUnit_Framework_TestRunner
     */
    public function getRunner ()
    {
        return $this->runner;
    }

    /**
     * Returns an array containing all test that were found
     * @return Ambigous <boolean, multitype:string >
     */
    public function getTestCollection ()
    {
        try {
            return CIUnit_Util_FileLoader::collectTests();
        }
        catch (CIUnit_Framework_Exception_CIUnitException $e) {
            $this->runFailure = $e->getMessage();
        }
        
        return array();
    }

    /**
     * Returns the exception message
     * @return string
     */
    public function getRunFailure ()
    {
        return $this->runFailure;
    }

    /**
     * 
     * @return boolean
     */
    public function runWasSuccessful ()
    {
        return NULL == $this->runFailure;
    }
}

