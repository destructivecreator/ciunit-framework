<?php

require_once '/home/agop/CIUnit/workspace/ciunit/ciunit/class_loader.php';
require_once 'PHPUnit/Framework/TestCase.php';
 
/**
 * CIUnit_Assert test case.
 */
class AssertTest extends PHPUnit_Framework_TestCase
{

	
    /**
     * @covers CIUnit_Assert::assetArrayHasKey()
     */
    public function testAssertArrayHasIntegerKey ()
    { 
        CIUnit_Assert::assertArrayHasKey(0, array('foo'));
        
        try {
            CIUnit_Assert::assertArrayHasKey(1, array('foo'));
        } catch (CIUnit_AssertionFailedException $e) {
            return;
        }
        
        
        $this->fail();
    }

    /**
     * @covers CIUnit_Assert::assetArrayHasKey()
     */
    public function testAssertArrayHasStringKey ()
    {
        CIUnit_Assert::assertArrayHasKey('foo', array('foo' => 'bar'));
        
        try {
            CIUnit_Assert::assertArrayHasKey('bar', array('foo' => 'bar'));
        } catch (CIUnit_AssertionFailedException $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers CIUnit_Assert::assetArrayHasKey()
     */
    public function testAssertArrayHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
 
        CIUnit_Assert::assertArrayHasKey('foo', $array);
    }

    /**
     * @covers CIUnit_Assert::assetArrayHasKey()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function testAssertArrayHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
         
        CIUnit_Assert::assertArrayHasKey('bar', $array);
    }

    /**
     * @covers CIUnit_Assert::assetArrayHasKey()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function tetsAssertArrayHasKeyThrowsException ()
    {
         CIUnit_Assert::assertArrayHasKey(null, array());
    }

    /**
     * @covers Tests CIUnit_Assert::assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasIntegerKey ()
    {
        CIUnit_Assert::assertArrayNotHasKey( 1, array('foo'));
        
        try{
            CIUnit_Assert::assertArrayNotHasKey( 0, array('foo'));
        }
        catch(CIUnit_AssertionFailedException $e){
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests CIUnit_Assert::assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasStringKey ()
    {
        CIUnit_Assert::assertArrayNotHasKey('foo', array(1 => 'bar'));
        
        try{
            CIUnit_Assert::assertArrayNotHasKey('foo', array('foo' => 'bar'));
        }
        catch(CIUnit_AssertionFailedException $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests CIUnit_Assert::assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        CIUnit_Assert::assertArrayNotHasKey(1, $array);
    }

    /**
     * @covers CIUnit_Assert::assetArrayNotHasKey()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function testAssertArrayNotHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        CIUnit_Assert::assertArrayNotHasKey('foo', $array);
    }

    /**
     * @covers CIUnit_Assert::assetArrayNotHasKey()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function tetsAssertArrayNotHasKeyThrowsException ()
    {
        CIUnit_Assert::assertArrayNotHasKey('foo', array('foo' => 'bar'));
    }

    
    /**
     * @covers Tests CIUnit_Assert::assetCount()
     */
    public function testAssertCount()
    {
    	CIUnit_Assert::assertCount(0, array());
    	
    	try {
    		CIUnit_Assert::assertCount(0, array('one', 'two'));
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assetCount()
     * @expectedException CIUnit_InvalidArgumentException
     */
    public function testAssertCountThrowsExceptionIfNotCountable()
    {
        CIUnit_Assert::assertCount(2, new stdClass());
    }
    
    /**
     * @covers CIUnit_Assert::assetCount()
     * @expectedException CIUnit_InvalidArgumentException
     */
    public function testAssertCountThrowsExceptionIfExpectedNotInteger()
    {
        CIUnit_Assert::assertCount('dd', array());
    }
    
    /**
     * @covers CIUnit_Assert::assertEmpty() 
     */
    public function testAssertEmpty()
    {
    	CIUnit_Assert::assertEmpty(array());
    	
    	try {
    		CIUnit_Assert::assertEmpty('String');
    	}
    	catch (CIUnit_AssertionFailedException $e)
    	{
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertNotEmpty()
     */
    public function testAssertNotEmpty()
    {
        CIUnit_Assert::assertNotEmpty('String');
    	
    	try {
    		CIUnit_Assert::assertNotEmpty(array());
    	}
    	catch (CIUnit_AssertionFailedException $e)
    	{
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertFalse()
     */
    public function testAssertFalse()
    {
    	CIUnit_Assert::assertFalse(FALSE);
    	 
    	try {
    		CIUnit_Assert::assertFalse(TRUE);
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	 
    	$this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertTrue()
     */
    public function testAssertTrue()
    {
    	CIUnit_Assert::assertTrue(TRUE);
    	
    	try {
    		CIUnit_Assert::assertTrue(FALSE);
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsForIntegers()
    {
         CIUnit_Assert::assertEquals(1, 1); 
         
         try {
             CIUnit_Assert::assertEquals(1, 3); 
         }
         catch (CIUnit_AssertionFailedException $e) {
             return;
         }
		 
         $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsForIntegersWithDelta()
    {
        CIUnit_Assert::assertEquals(1, 3, 5);
         
        try {
            CIUnit_Assert::assertEquals(21, 3, 7);
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsForDoubles()
    {
        CIUnit_Assert::assertEquals(1.24, 1.24);
         
        try { 
            CIUnit_Assert::assertEquals(1.22, 1.223);
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsForDoublesWithDelta()
    {
        CIUnit_Assert::assertEquals(1.24, 4.24, 3.001);
         
        try {
            CIUnit_Assert::assertEquals(1.22, 8.223, 0.123);
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
         
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsForArrays()
    {
        $actual = array('a', 'b', 'c');
        $expected = array('a', 'b', 'c');
        
        CIUnit_Assert::assertEquals($actual, $expected); 
         
        try {
            $expected = array('a', 'b', 'd');
            
            CIUnit_Assert::assertEquals($actual, $expected);
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
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
    
            CIUnit_Assert::assertEquals($actual, $expected);
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
         
        $this->fail();
    }
    
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsWithDifferentTypes()
    {    
        try { 
            CIUnit_Assert::assertEquals(1, 'ss');
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
         
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertEquals()
     */
    public function testAssertEqualsForExceptions()
    {     
        $this->assertEquals(new Exception(), new Exception());
         
        try {  
            $this->assertEquals(new stdClass(), new Exception());
        }
        catch (CIUnit_AssertionFailedException $e) {
            return;
        }
         
        $this->fail();
    }
    
    
    /**
     * @covers CIUnit_Assert::assertInstanceOf()
     */
    public function testAssertThatIsInstanceOf()
    {
    	CIUnit_Assert::assertInstanceOf('RuntimeException', new RuntimeException());
    	
    	try {
    		CIUnit_Assert::assertInstanceOf('CIUnit_Assert', new Exception());
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertNotInstanceOf()
     */
    public function testAssertThatIsNotInstanceOf()
    {
        CIUnit_Assert::assertNotInstanceOf('RuntimeException', new Exception());
    	
    	try {
    		CIUnit_Assert::assertNotInstanceOf('Exception', new Exception());
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertNull()
     */
    public function testAssertNull()
    {
    	CIUnit_Assert::assertNull(null);
    	
    	try {
    		CIUnit_Assert::assertNull('string');
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Assert::assertNotNull()
     */
    public function testAssertNotNull()
    {
        CIUnit_Assert::assertNotNull(123);
    	
    	try {
    		CIUnit_Assert::assertNotNull(null);
    	}
    	catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    
    public function testAssertInternalType()
    {
    	$this->assertInternalType('integer', 1);
    	
    	try {
    		CIUnit_Assert::assertInternalType('string', 111);
    	} catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	$this->fail();
    }
    
    public function testAssertNotInternalType()
    {
    	CIUnit_Assert::assertNotInternalType('integer', 'ww');
    	 
    	try {
    		CIUnit_Assert::assertNotInternalType('string', 'sasa');
    	} catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	$this->fail();
    }
    
    public function testAssertSameSize()
    {
    	CIUnit_Assert::assertSameSize(array('one'), array(1));
    	
    	try {
    		CIUnit_Assert::assertSameSize(array('one'), array());
    	} catch (CIUnit_AssertionFailedException $e) {
    		return;
    	}
    	
    	$this->fail();
    }
}

