<?php 

class GreenTest extends CIUnit_Framework_TestCaseAbstract
{
    private $actual;
    
    public function setUp()
    {
        $this->actual = "Brave new world...";
    }
    
    public function testStringComparison()
    {
        $expected = "Brave new world...";
        $this->assertEquals($expected, $this->actual);
        
        $this->actual = "Brave old world...";
    }
    
    public function testPHPError()
    {  
        $this->assertEquals(array(1,23,32), array(1,23,32));
    }
}

?>