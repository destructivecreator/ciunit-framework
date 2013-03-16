<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'application/third_party/ciunit/framework/autoload.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ClassWithAttributes.php';
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
     * @covers CIUnit_Framework_Assert::assertFalse()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertFalseProperlyFailsWithNotBoolean()
    {
        CIUnit_Framework_Assert::assertFalse('FALSE');
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
     * @covers CIUnit_Framework_Assert::assertTrue()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertTrueProperlyFailsWithNotBoolean()
    {
        CIUnit_Framework_Assert::assertTrue('TRUE');
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
     * @covers CIUnit_Framework_Assert::assertInstanceOf() 
     */
    public function testAssertThatIsInstanceOfProperlyFailsWithInvalidArgument()
    {
        // #2 has to be an object
        try {
            CIUnit_Framework_Assert::assertInstanceOf('RuntimeException', 'RuntimeException');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
         
        }
        
        // #1 has to be string or object
        try {
            CIUnit_Framework_Assert::assertInstanceOf(array(), new RuntimeException());
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
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
     * @covers CIUnit_Framework_Assert::assertSameSize()
     */
    public function testAssertSameSizeProperlyFailsWithInvalidTypeException()
    {
        // #1 Countable, Iterator,or Array
        try {
            CIUnit_Framework_Assert::assertSameSize(1920, array());
        } catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            
        }
        
        // #2 Countable, Iterator,or Array
        try {
            CIUnit_Framework_Assert::assertSameSize(array('one'), new stdClass());
        } catch (CIUnit_Framework_Exception_InvalidArgument $e) {
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
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringStartsWith()
     */
    public function testAssertStringStartsWith()
    {
        CIUnit_Framework_Assert::assertStringStartsWith('pre', 'presentation');
        
        try {
            CIUnit_Framework_Assert::assertStringStartsWith('abc', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringStartsWith()
     */
    public function testAssertStringStartsWithProperlyFailsWithInvalidTypeException()
    {
        // #1 must be string
        try {
            CIUnit_Framework_Assert::assertStringStartsWith(array(1), 'presentation');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            
        }
        
        // #2 String as well
        try {
            CIUnit_Framework_Assert::assertStringStartsWith('abc', array('abc'));
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringNotStartsWith()
     */
    public function testAssertStringNotStartsWith()
    {
        CIUnit_Framework_Assert::assertStringNotStartsWith('abv', 'presentation');
    
        try {
            CIUnit_Framework_Assert::assertStringNotStartsWith('prese', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringEndsWith()
     */
    public function testAssertStringEndsWith()
    {
        CIUnit_Framework_Assert::assertStringEndsWith('tation', 'presentation');
    
        try {
            CIUnit_Framework_Assert::assertStringEndsWith('abc', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringEndsWith()
     */
    public function testAssertStringEndsWithProperlyFailsWithInvalidTypeException()
    {
        // #1 must be string
        try {
            CIUnit_Framework_Assert::assertStringEndsWith(array(1), 'presentation');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
    
        }
    
        // #2 String as well
        try {
            CIUnit_Framework_Assert::assertStringEndsWith('abc', array('abc'));
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringNotEndsWith()
     */
    public function testAssertStringNotEndsWith()
    {
        CIUnit_Framework_Assert::assertStringNotEndsWith('tationr', 'presentation');
    
        try {
            CIUnit_Framework_Assert::assertStringNotEndsWith('ion', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringMatchesRegex()
     */
    public function testAssertStringMatchesRegex()
    {
        CIUnit_Framework_Assert::assertStringMatchesRegex('/^pre/', 'presentation');
        
        try {
            CIUnit_Framework_Assert::assertStringMatchesRegex('/^def/', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringMatchesRegex()
     */
    public function testAssertStringNotMatchesRegex()
    {
        CIUnit_Framework_Assert::assertStringNotMatchesRegex('/^prez/', 'presentation');
    
        try {
            CIUnit_Framework_Assert::assertStringNotMatchesRegex('/^pr/', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertStringMatchesRegex()
     */
    public function testAssertStringMatchesRegexProperlyFailsWithInvalidTypeException()
    {
        // #1 must be string
        try {
            CIUnit_Framework_Assert::assertStringMatchesRegex(1, 'presentation');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
    
        // #2 String as well
        try {
            CIUnit_Framework_Assert::assertStringMatchesRegex('/^pre/', array('a', 'b'));
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertClassHasAttribute()
     */
    public function testAssertClassHasAttribute()
    {
        CIUnit_Framework_Assert::assertClassHasAttribute('publicAttribute', 'ClassWithAttributes');
        
        try {

            CIUnit_Framework_Assert::assertClassHasAttribute('notExistingAttribute', 'ClassWithAttributes');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertClassNotHasAttribute()
     */
    public function testAssertClassNotHasAttribute()
    {
        CIUnit_Framework_Assert::assertClassNotHasAttribute('notExistingAttribute', 'ClassWithAttributes');
        
        try {

            CIUnit_Framework_Assert::assertClassNotHasAttribute('publicAttribute', 'ClassWithAttributes');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertClassHasStaticAttribute()
     */
    public function testAssertClassHasStaticAttribute()
    {
        CIUnit_Framework_Assert::assertClassHasStaticAttribute('publicStaticAttribute', 'ClassWithAttributes');
        
        try {

            CIUnit_Framework_Assert::assertClassHasStaticAttribute('privateAttribute', 'ClassWithAttributes');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertClassNotHasStaticAttribute()
     */
    public function testAssertClassNotHasStaticAttribute()
    {
        CIUnit_Framework_Assert::assertClassNotHasStaticAttribute('publicAttribute', 'ClassWithAttributes');
        
        try {
        
            CIUnit_Framework_Assert::assertClassNotHasStaticAttribute('privateStaticAttribute', 'ClassWithAttributes');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertClassNotHasStaticAttribute()
     */
    public function testAssertClassNotHasStaticAttributeProperlyFailsWithInvalidAttribute()
    {
        try {
            CIUnit_Framework_Assert::assertClassNotHasStaticAttribute('1', 'ClassWithAttributes');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertClassNotHasStaticAttribute()
     */
    public function testAssertClassNotHasStaticAttributeProperlyFailsWithInvalidClassName()
    {
        try {
            CIUnit_Framework_Assert::assertClassNotHasStaticAttribute('ab', 'NotExistingClassName');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertObjectHasAttribute()
     */
    public function testAssertObjectHasAttribute()
    {
        CIUnit_Framework_Assert::assertObjectHasAttribute('publicAttribute', new  ClassWithAttributes());
  
        try {
            CIUnit_Framework_Assert::assertObjectHasAttribute('notExistingObjectAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertObjectNotHasAttribute()
     */
    public function testAssertObjectNotHasAttribute()
    {
        CIUnit_Framework_Assert::assertObjectNotHasAttribute('notExistingObjectAttribute', new  ClassWithAttributes());
        
        try {
            CIUnit_Framework_Assert::assertObjectNotHasAttribute('privateAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertObjectHasAttribute()
     */
    public function testAssertObjectHasAttributeProperlyFailsIfAttributeIsNotValid()
    {
        try {
            CIUnit_Framework_Assert::assertObjectHasAttribute('1', 'ClassWithAttributes');
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
     
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertObjectHasStaticAttribute()
     */
    public function testAssertObjectHasStaticAttribute()
    {
        CIUnit_Framework_Assert::assertObjectHasStaticAttribute('publicStaticAttribute', new  ClassWithAttributes());
        
        try {
            CIUnit_Framework_Assert::assertObjectHasStaticAttribute('publicAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertObjectNotHasStaticAttribute()
     */
    public function testAssertObjectNotHasStaticAttribute()
    {
        CIUnit_Framework_Assert::assertObjectNotHasStaticAttribute('publicAttribute', new  ClassWithAttributes());
    
        try {
            CIUnit_Framework_Assert::assertObjectNotHasStaticAttribute('publicStaticAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Assert::assertObjectHasStaticAttribute()
     */
    public function testAssertObjectHasStaticAttributeProperlyFailsIfAttributeIsNotValid()
    { 
        try {
            CIUnit_Framework_Assert::assertObjectHasStaticAttribute('1', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_InvalidArgument $e) {
            return;
        }
    
        $this->fail();
    }
}

