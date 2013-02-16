<?php
 

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'OneCaseTest.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'InheritedTest.php'; 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'NoTestCases.php'; 

class SuiteTest extends CIUnit_TestCase
{
    protected $result;
    
    protected function setUp()
    {
        $this->result = new CIUnit_TestResult();
    } 
    
    public function testAddTestSuite()
    {
//         $suite = new CIUnit_TestSuite('OneTestCase');
//         $suite->run($this->result);
    
        $this->assertEquals(1, 2);
    }
    
//     public function testInheritedTest()
//     {
//         $suite = new CIUnit_TestSuite('InheritedTest');
//         $suite->run($this->result);
        
//         $this->assertTrue($this->result->wasSuccessful());
//         $this->assertEquals(2, count($this->result));
//     }
     
    
//     public function testNoTestCases()
//     {
//         $suite = new CIUnit_TestSuite('NoTestCases');
//         $suite->run($this->result);
        
//         $this->assertTrue(!$this->result->wasSuccessful());
//         $this->assertEquals(1, $this->result->getFailureCount());
//         $this->assertEquals(1, count($this->result));
//     }
}

?>