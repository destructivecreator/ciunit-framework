<?php 

class GreenTest extends CIUnit_Framework_TestCase
{
    public function testStringComparison()
    {
        $this->assertEquals("Brave new world", "Brave new world..");
    }
}

?>