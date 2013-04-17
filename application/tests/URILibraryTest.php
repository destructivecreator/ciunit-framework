<?php

class URILibraryTest extends CIUnit_Framework_TestCase
{

    private $uri;

    protected function setUp ()
    {
        $this->get_instance()->load->library('uri');
        $this->uri = get_instance()->uri;
    }


    // Test pass when default routing configuration is used 
    // example: http://www.example.com/index.php/ciunit/URILibraryTest or
    // http://www.example.com/ciunit/URILibraryTest
    
    public function testSegment ()
    {
        $segmentOne = "ciunit";
        $segmentTwo = "URILibraryTest";
        
        $this->assertEquals($segmentOne, $this->uri->segment(1));
        $this->assertEquals($segmentTwo, $this->uri->segment(2));
        $this->assertFalse($this->uri->segment(3));
    }

    public function testSlashSegment ()
    { 

        $this->assertEquals('ciunit/', $this->uri->slash_segment(1));
        $this->assertEquals('/ciunit', $this->uri->slash_segment(1, 'leading'));
        $this->assertEquals('/ciunit/', $this->uri->slash_segment(1, 'both'));
    }

    public function testUriToAssoc ()
    {
        $array = array(
                'ciunit' => 'URILibraryTest'
        );
        $uri = "index.php/ciunit/URILibraryTest";
        
        $this->assertEquals($array, $this->uri->uri_to_assoc(1));
    }

    public function testAssocToUri ()
    {
        $array = array(
                'ciunit' => 'URILibraryTest'
        );
        $uri = "ciunit/URILibraryTest";
        
        $this->assertEquals($uri, $this->uri->assoc_to_uri($array));
    }

    public function testUriString ()
    {
        $uriAsString = "ciunit/URILibraryTest";
        $this->assertEquals($uriAsString, $this->uri->uri_string());
    }

    public function testTotalSegments ()
    {
        $totalSegments = 2;
        
        $this->assertEquals($totalSegments, $this->uri->total_segments());
    }

    public function testSegmentArray ()
    {
        $segmentsArray = array(
                1 => 'ciunit',
                2 => 'URILibraryTest'
        );
        
        $this->assertEquals($segmentsArray, $this->uri->segment_array());
    }
}

?>