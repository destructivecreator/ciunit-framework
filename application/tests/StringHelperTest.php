<?php

class StringHelperTest extends CIUnit_Framework_TestCase
{

    protected function setUp() 
    {
        // Load heper 
        $this->get_instance()->load->helper('string');
    }
    
    public function testTrimSlashes() 
    {
        $actualString = "/this/that/theother/";
        $expectedString = "this/that/theother";
        $this->assertEquals($expectedString, trim_slashes($actualString));
    }
    
    public function testRepeater()
    {
        $actualString = "a";
        $expectedString = "aaaaaaaaaa";
        $this->assertEquals($expectedString, repeater($actualString, 10));
    }
    
    public function testReduceDoubleSlashes()
    {
        $actualString = "http://example.com//index.php";
        $expectedString = "http://example.com/index.php";
        $this->assertEquals($expectedString, reduce_double_slashes($actualString));
    }
    
    public function testReduceMultiples()
    {
        $actualString = "Fred, Bill,, Joe, Jimmy";
        $expectedString = "Fred, Bill, Joe, Jimmy";
        $this->assertEquals($expectedString, reduce_multiples($actualString));
    }
    
    public function testQuotesToEntities()
    {
        $actualString = "Joe's \"dinner\"";
        $expectedString = "Joe&#39;s &quot;dinner&quot;";
        $this->assertEquals($expectedString, quotes_to_entities($actualString));
    }
    
    public function testStripQuotes()
    {
        $actualString = "Joe's \"dinner\"";
        $expectedString = "Joes dinner";
        $this->assertEquals($expectedString, strip_quotes($actualString));
    }
    
    public function testRandomString()
    {
        $this->assertNotEquals(random_string(), random_string());
    }
}

?>