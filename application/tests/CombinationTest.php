<?php

class CombinationTest extends CIUnit_Framework_TestCase
{
    public function testSuccess()
    {
        $this->assertTrue(TRUE);
    }
    
    public function testIncomplete()
    {
        
    }
    
    public function testSkipped()
    {
        $this->skip("I would like to skip this test for now.");
    }
    
    public function testFailure()
    {
        $this->assertSameSize(array(1,2), array());
    }
    
    public function testException()
    {
        $this->setExpectedException('CIUnit_Framework_TestCase');
        
        throw new RuntimeException();
    }
    
    public function testError()
    {
        $this->setExpectedException('Errorvd');
        throw new RuntimeException();
    }
}

?>