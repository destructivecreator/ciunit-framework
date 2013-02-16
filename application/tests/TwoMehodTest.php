<?php 

class TwoMehodTest extends CIUnit_Framework_TestCase
{ 
    public function testIntegerComparison()
    {
        $this->assertEquals(1, 2);
    }
    
    public function testArrayHasKey()
    {
        $this->assertArrayHasKey(2, array(1,2));
    }
    
    public function testArrayHasKeySuccess()
    {
        $this->assertArrayHasKey(1, array(1,2));
    }
}

?>