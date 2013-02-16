<?php

require_once '/home/agop/CIUnit/workspace/ciunit/ciunit/class_loader.php';
require_once 'PHPUnit/Framework/TestCase.php';


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'OneCaseTest.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'InheritedTest.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NoTestCases.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NoTestCaseClass.php'; 

class SuiteTest extends PHPUnit_Framework_TestCase
{
    protected $result;
    
    protected function setUp()
    {
        $this->result = new CIUnit_TestResult();
    } 
    
    public function testAddTestSuite()
    {
        $suite = new CIUnit_TestSuite('OneTestCase');
        $suite->run($this->result);
    
        $this->assertEquals(1, count($this->result));
    }
    
    public function testInheritedTest()
    {
        $suite = new CIUnit_TestSuite('InheritedTest');
        $suite->run($this->result);
        
        $this->assertTrue($this->result->wasSuccessful());
        $this->assertEquals(2, count($this->result));
    }
     
    
    public function testNoTestCases()
    {
        $suite = new CIUnit_TestSuite('NoTestCases');
        $suite->run($this->result);
        
        $this->assertTrue(!$this->result->wasSuccessful());
        $this->assertEquals(1, $this->result->getFailureCount());
        $this->assertEquals(1, count($this->result));
    }
     
    
    public function testNoTestCaseClass()
    {
        try {
    		$suite = new CIUnit_TestSuite('NoTestCaseClass');
    	}
    	catch (CIUnit_Exception $e) {
    		return;
    	}
    	
        $this->fail();
    }
}

?>