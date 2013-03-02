<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'application/third_party/ciunit/framework/autoload.php';
require_once 'PHPUnit/Framework/TestCase.php';


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'OneTestCase.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'InheritedTest.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NoTestCases.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NoTestCaseClass.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NotPublicTestCase.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NotVoidTestCase.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'OverrideTestCase.php'; 

class SuiteTest extends PHPUnit_Framework_TestCase
{
    protected $result;
    
    protected function setUp()
    {
        $this->result = new CIUnit_Framework_TestResult();
    }
    
    public function testAddTestSuite()
    {
        $suite = new CIUnit_Framework_TestSuite(
                'OneTestCase'
        );
    
        $suite->run($this->result);
    
        $this->assertEquals(1, count($this->result));
    }
    
    public function testInheritedTests()
    {
        $suite = new CIUnit_Framework_TestSuite(
                'InheritedTestCase'
        );
    
        $suite->run($this->result);
    
        $this->assertTrue($this->result->wasSuccessful());
        $this->assertEquals(2, count($this->result));
    }
    
    public function testNoTestCases()
    {
        $suite = new CIUnit_Framework_TestSuite(
                'NoTestCases'
        );
    
        $suite->run($this->result);
    
        $this->assertTrue(!$this->result->wasSuccessful());
        $this->assertEquals(1, $this->result->getFailureCount());
        $this->assertEquals(1, count($this->result));
    }
    
    /**
     * @expectedException CIUnit_Framework_Exception_CIUnitException
     */
    public function testNoTestCaseClass()
    {
        $suite = new CIUnit_Framework_TestSuite('NoTestCaseClass');
    }
    
    /**
     * @expectedException CIUnit_Framework_Exception_CIUnitException
     */
    public function testNotExistingTestCase()
    {
        $suite = new CIUnit_Framework_TestSuite('notExistingMethod');
    
        $suite->run($this->result);

    }
    
    public function testNotPublicTestCase()
    {
        $suite = new CIUnit_Framework_TestSuite(
                'NotPublicTestCase'
        );
    
        $this->assertEquals(2, count($suite));
    }
    
//     public function testNotVoidTestCase()
//     {
//         $suite = new CIUnit_Framework_TestSuite(
//                 'NotVoidTestCase'
//         );
    
//         $this->assertEquals(1, count($suite));
//     }
    
    public function testOneTestCase()
    {
        $suite = new CIUnit_Framework_TestSuite(
                'OneTestCase'
        );
    
        $suite->run($this->result);
    
        $this->assertEquals(0, $this->result->getErrorCount());
        $this->assertEquals(0, $this->result->getFailureCount());
        $this->assertEquals(1, count($this->result));
        $this->assertTrue($this->result->wasSuccessful());
    }
    
    public function testShadowedTests()
    {
        $suite = new CIUnit_Framework_TestSuite(
                'OverrideTestCase'
        );
    
        $suite->run($this->result);
    
        $this->assertEquals(1, count($this->result));
    }
}

?>