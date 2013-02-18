<?php
 
 
/**
 * CIUnit_Framework_Assert test case.
 */
class AssertTest extends CIUnit_Framework_TestCase
{

	
    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasIntegerKey ()
    { 
        $this->assertArrayHasKey(0, array('foo'));
        
        try {
            $this->assertArrayHasKey(1, array('foo'));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        
        $this->fail();
    }

    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasStringKey ()
    {
        $this->assertArrayHasKey('foo', array('foo' => 'bar'));
        
        try {
            $this->assertArrayHasKey('bar', array('foo' => 'bar'));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
 
        $this->assertArrayHasKey('foo', $array);
    }

    /**
     * @covers $this->assetArrayHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertArrayHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['bar'] = 'foo';
         
        $this->assertArrayHasKey('bar', $array);
    }

    /**
     * @covers $this->assetArrayHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function tetsAssertArrayHasKeyThrowsException ()
    {
         $this->assertArrayHasKey(null, array());
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasIntegerKey ()
    {
        $this->assertArrayNotHasKey( 1, array('foo'));
        
        try{
            $this->assertArrayNotHasKey( 0, array('foo'));
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e){
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasStringKey ()
    {
        $this->assertArrayNotHasKey('foo', array(1 => 'bar'));
        
        try{
            $this->assertArrayNotHasKey('foo', array('foo' => 'bar'));
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->assertArrayNotHasKey(1, $array);
    }

    /**
     * @covers $this->assetArrayNotHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertArrayNotHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->assertArrayNotHasKey('bar', $array);
    }

    /**
     * @covers $this->assetArrayNotHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function tetsAssertArrayNotHasKeyThrowsException ()
    {
        $this->assertArrayNotHasKey('foo', array('foo' => 'bar'));
    }

    
    /**
     * @covers Tests $this->assetCount()
     */
    public function testAssertCount()
    {
    	$this->assertCount(0, array());
    	
    	try {
    		$this->assertCount(0, array('one', 'two'));
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assetCount() 
     */
    public function testAssertCountThrowsExceptionIfNotCountable()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount(2, new stdClass());
    }
    
    /**
     * @covers $this->assetCount() 
     */
    public function testAssertCountThrowsExceptionIfExpectedNotInteger()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount('dd', array());
    }
    
    /**
     * @covers $this->assertEmpty() 
     */
    public function testAssertEmpty()
    {
    	$this->assertEmpty(array());
    	
    	try {
    		$this->assertEmpty('String');
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e)
    	{
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assertNotEmpty()
     */
    public function testAssertNotEmpty()
    {
        $this->assertNotEmpty('String');
    	
    	try {
    		$this->assertNotEmpty(array());
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e)
    	{
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assertFalse()
     */
    public function testAssertFalse()
    {
    	$this->assertFalse(FALSE);
    	 
    	try {
    		$this->assertFalse(TRUE);
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	 
    	$this->fail();
    }
    
    /**
     * @covers $this->assertTrue()
     */
    public function testAssertTrue()
    {
    	$this->assertTrue(TRUE);
    	
    	try {
    		$this->assertTrue(FALSE);
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForIntegers()
    {
         $this->assertEquals(1, 1); 
         
         try {
             $this->assertEquals(1, 3); 
         }
         catch (CIUnit_Framework_Exception_AssertionFailed $e) {
             return;
         }
		 
         $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForIntegersWithDelta()
    {
        $this->assertEquals(1, 3, 5);
         
        try {
            $this->assertEquals(21, 3, 7);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForDoubles()
    {
        $this->assertEquals(1.24, 1.24);
         
        try { 
            $this->assertEquals(1.22, 1.223);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForDoublesWithDelta()
    {
        $this->assertEquals(1.24, 4.24, 3.001);
         
        try {
            $this->assertEquals(1.22, 8.223, 0.123);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForArrays()
    {
        $actual = array('a', 'b', 'c');
        $expected = array('a', 'b', 'c');
        
        $this->assertEquals($actual, $expected); 
         
        try {
            $expected = array('a', 'b', 'd');
            
            $this->assertEquals($actual, $expected);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForObjects()
    {
       
       $expected = new stdClass();
       $expected->name = "John";
       $expected->age = 11;
       
       $actual = new stdClass();  
       $actual->name = "John";
       $actual->age = 11;  
    
    
        $this->assertEquals($actual, $expected);
         
        try {
            $expected->age = '19';
    
            $this->assertEquals($actual, $expected);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsWithDifferentTypes()
    {    
        try { 
            $this->assertEquals(1, 'ss');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForExceptions()
    {     
        $this->assertEquals(new Exception(), new Exception());
         
        try {  
            $this->assertEquals(new stdClass(), new Exception());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    
    /**
     * @covers $this->assertInstanceOf()
     */
    public function testAssertThatIsInstanceOf()
    {
    	$this->assertInstanceOf('RuntimeException', new RuntimeException());
    	
    	try {
    		$this->assertInstanceOf('CIUnit_Framework_Assert', new Exception());
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assertNotInstanceOf()
     */
    public function testAssertThatIsNotInstanceOf()
    {
        $this->assertNotInstanceOf('RuntimeException', new Exception());
    	
    	try {
    		$this->assertNotInstanceOf('Exception', new Exception());
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assertNull()
     */
    public function testAssertNull()
    {
    	$this->assertNull(null);
    	
    	try {
    		$this->assertNull('string');
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers $this->assertNotNull()
     */
    public function testAssertNotNull()
    {
        $this->assertNotNull(123);
    	
    	try {
    		$this->assertNotNull(null);
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    
    public function testAssertInternalType()
    {
    	$this->assertInternalType('integer', 1);
    	
    	try {
    		$this->assertInternalType('string', 111);
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	$this->fail();
    }
    
    public function testAssertNotInternalType()
    {
    	$this->assertNotInternalType('integer', 'ww');
    	 
    	try {
    		$this->assertNotInternalType('string', 'sasa');
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	$this->fail();
    }
    
    public function testAssertSameSize()
    {
    	$this->assertSameSize(array('one'), array(1));
    	
    	try {
    		$this->assertSameSize(array('one'), array());
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
    	$this->fail();
    }
}

