<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'application/third_party/ciunit/framework/autoload.php';
require_once 'PHPUnit/Framework/TestCase.php';
 
/**
 * CIUnit_Framework_Assert test case.
 */
class AssertTest extends PHPUnit_Framework_TestCase
{

	
    /**
     * @covers CIUnit_Framework_Assert::assetArrayHasKey()
     */
    public function testAssertArrayHasIntegerKey ()
    {  
        CIUnit_Framework_Assert::assertArrayHasKey(0, array('foo'));
        
        try {
            CIUnit_Framework_Assert::assertArrayHasKey(1, array('foo'));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        
        $this->fail();
    }

    /**
     * @covers CIUnit_Framework_Assert::assetArrayHasKey()
     */
    public function testAssertArrayHasStringKey ()
    {
        CIUnit_Framework_Assert::assertArrayHasKey('foo', array('foo' => 'bar'));
        
        try {
            CIUnit_Framework_Assert::assertArrayHasKey('bar', array('foo' => 'bar'));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers CIUnit_Framework_Assert::assetArrayHasKey()
     */
    public function testAssertArrayHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
 
        CIUnit_Framework_Assert::assertArrayHasKey('foo', $array);
    }

    /**
     * @covers CIUnit_Framework_Assert::assetArrayHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertArrayHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
         
        CIUnit_Framework_Assert::assertArrayHasKey('bar', $array);
    }

    /**
     * @covers CIUnit_Framework_Assert::assetArrayHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function tetsAssertArrayHasKeyThrowsException ()
    {
         CIUnit_Framework_Assert::assertArrayHasKey(null, array());
    }

    /**
     * @covers Tests CIUnit_Framework_Assert::assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasIntegerKey ()
    {
        CIUnit_Framework_Assert::assertArrayNotHasKey( 1, array('foo'));
        
        try{
            CIUnit_Framework_Assert::assertArrayNotHasKey( 0, array('foo'));
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e){
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests CIUnit_Framework_Assert::assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasStringKey ()
    {
        CIUnit_Framework_Assert::assertArrayNotHasKey('foo', array(1 => 'bar'));
        
        try{
            CIUnit_Framework_Assert::assertArrayNotHasKey('foo', array('foo' => 'bar'));
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests CIUnit_Framework_Assert::assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        CIUnit_Framework_Assert::assertArrayNotHasKey(1, $array);
    }

    /**
     * @covers CIUnit_Framework_Assert::assetArrayNotHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertArrayNotHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        CIUnit_Framework_Assert::assertArrayNotHasKey('foo', $array);
    }

    /**
     * @covers CIUnit_Framework_Assert::assetArrayNotHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function tetsAssertArrayNotHasKeyThrowsException ()
    {
        CIUnit_Framework_Assert::assertArrayNotHasKey('foo', array('foo' => 'bar'));
    }

    
    /**
     * @covers Tests CIUnit_Framework_Assert::assetCount()
     */
    public function testAssertCount()
    {
    	CIUnit_Framework_Assert::assertCount(0, array());
    	
    	try {
    		CIUnit_Framework_Assert::assertCount(0, array('one', 'two'));
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfNotCountable()
    {
        CIUnit_Framework_Assert::assertCount(2, new stdClass());
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfExpectedNotInteger()
    {
        CIUnit_Framework_Assert::assertCount('dd', array());
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEmpty() 
     */
    public function testAssertEmpty()
    {
    	CIUnit_Framework_Assert::assertEmpty(array());
    	
    	try {
    		CIUnit_Framework_Assert::assertEmpty('String');
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e)
    	{
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertNotEmpty()
     */
    public function testAssertNotEmpty()
    {
        CIUnit_Framework_Assert::assertNotEmpty('String');
    	
    	try {
    		CIUnit_Framework_Assert::assertNotEmpty(array());
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e)
    	{
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertFalse()
     */
    public function testAssertFalse()
    {
    	CIUnit_Framework_Assert::assertFalse(FALSE);
    	 
    	try {
    		CIUnit_Framework_Assert::assertFalse(TRUE);
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	 
    	$this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertTrue()
     */
    public function testAssertTrue()
    {
    	CIUnit_Framework_Assert::assertTrue(TRUE);
    	
    	try {
    		CIUnit_Framework_Assert::assertTrue(FALSE);
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForIntegers()
    {
         CIUnit_Framework_Assert::assertEquals(1, 1); 
         
         try {
             CIUnit_Framework_Assert::assertEquals(1, 3); 
         }
         catch (CIUnit_Framework_Exception_AssertionFailed $e) {
             return;
         }
		 
         $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForIntegersWithDelta()
    {
        CIUnit_Framework_Assert::assertEquals(1, 3, 5);
         
        try {
            CIUnit_Framework_Assert::assertEquals(21, 3, 7);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForDoubles()
    {
        CIUnit_Framework_Assert::assertEquals(1.24, 1.24);
         
        try { 
            CIUnit_Framework_Assert::assertEquals(1.22, 1.223);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForDoublesWithDelta()
    {
        CIUnit_Framework_Assert::assertEquals(1.24, 4.24, 3.001);
         
        try {
            CIUnit_Framework_Assert::assertEquals(1.22, 8.223, 0.123);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForArrays()
    {
        $actual = array('a', 'b', 'c');
        $expected = array('a', 'b', 'c');
        
        CIUnit_Framework_Assert::assertEquals($actual, $expected); 
         
        try {
            $expected = array('a', 'b', 'd');
            
            CIUnit_Framework_Assert::assertEquals($actual, $expected);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForObjects()
    {
       
       $expected = new stdClass();
       $expected->name = "John";
       $expected->age = 11;
       
       $actual = new stdClass();  
       $actual->name = "John";
       $actual->age = 11;  
    
    
        CIUnit_Framework_Assert::assertEquals($actual, $expected);
         
        try {
            $expected->age = '19';
    
            CIUnit_Framework_Assert::assertEquals($actual, $expected);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsWithDifferentTypes()
    {    
        try { 
            CIUnit_Framework_Assert::assertEquals(1, 'ss');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertEquals()
     */
    public function testAssertEqualsForExceptions()
    {     
        CIUnit_Framework_Assert::assertEquals(new Exception(), new Exception());
         
        try {  
            CIUnit_Framework_Assert::assertEquals(new stdClass(), new Exception());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
         
        $this->fail();
    }
    
    
    /**
     * @covers CIUnit_Framework_Assert::assertInstanceOf()
     */
    public function testAssertThatIsInstanceOf()
    {
    	CIUnit_Framework_Assert::assertInstanceOf('RuntimeException', new RuntimeException());
    	
    	try {
    		CIUnit_Framework_Assert::assertInstanceOf('CIUnit_Framework_Assert', new Exception());
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertNotInstanceOf()
     */
    public function testAssertThatIsNotInstanceOf()
    {
        CIUnit_Framework_Assert::assertNotInstanceOf('RuntimeException', new Exception());
    	
    	try {
    		CIUnit_Framework_Assert::assertNotInstanceOf('Exception', new Exception());
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertNull()
     */
    public function testAssertNull()
    {
    	CIUnit_Framework_Assert::assertNull(null);
    	
    	try {
    		CIUnit_Framework_Assert::assertNull('string');
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertNotNull()
     */
    public function testAssertNotNull()
    {
        CIUnit_Framework_Assert::assertNotNull(123);
    	
    	try {
    		CIUnit_Framework_Assert::assertNotNull(null);
    	}
    	catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertInternalType()
     */
    public function testAssertInternalType()
    {
    	$this->assertInternalType('integer', 1);
    	
    	try {
    		CIUnit_Framework_Assert::assertInternalType('string', 111);
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	$this->fail();
    }
    /**
     * @covers CIUnit_Framework_Assert::assertNotInternalType()
     */
    public function testAssertNotInternalType()
    {
    	CIUnit_Framework_Assert::assertNotInternalType('integer', 'ww');
    	 
    	try {
    		CIUnit_Framework_Assert::assertNotInternalType('string', 'sasa');
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	$this->fail();
    }
    /**
     * @covers CIUnit_Framework_Assert::assertSameSize()
     */
    public function testAssertSameSize()
    {
    	CIUnit_Framework_Assert::assertSameSize(array('one'), array(1));
    	
    	try {
    		CIUnit_Framework_Assert::assertSameSize(array('one'), array());
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    	
    	$this->fail();
    }
    
    
    /**
     * @covers CIUnit_Framework_Assert::assertGreaterThan()
     */
    public function testAssertGreaterThan()
    {
        CIUnit_Framework_Assert::assertGreaterThan(1, 2);
        
        try {
            CIUnit_Framework_Assert::assertGreaterThan(2, 1);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertGreaterThanOrEqual()
     */
    public function testAssertGreaterThanOrEqual()
    {
        CIUnit_Framework_Assert::assertGreaterThanOrEqual(12, 12);
        CIUnit_Framework_Assert::assertGreaterThanOrEqual(2, 12);
        
        try {
            CIUnit_Framework_Assert::assertGreaterThanOrEqual(2, 1);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertLessThan()
     */
    public function testAssertLessThan()
    {
        CIUnit_Framework_Assert::assertLessThan(13, 2);
    
        try {
            CIUnit_Framework_Assert::assertLessThan(2, 11);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertLessThanOrEqual()
     */
    public function testAssertLessThanOrEqual()
    {
        CIUnit_Framework_Assert::assertLessThanOrEqual(13, 13);
        CIUnit_Framework_Assert::assertLessThanOrEqual(13, 3);
    
        try {
            CIUnit_Framework_Assert::assertLessThanOrEqual(1, 11);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
}

