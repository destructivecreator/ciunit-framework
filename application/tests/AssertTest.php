<?php


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ClassWithAttributes.php';
/**
 * CIUnit_Framework_Assert test case.
 */
class AssertTest extends CIUnit_Framework_TestCase
{

    /**
     * @covers CIUnit_Framework_TestCase::setExpectedException()
     */
    public function testSetExpectedException()
    {
        $this->setExpectedException('Exception', 'I am exception 400', 400);
        throw new Exception('I am exception 400', 400);     
    }
    
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
        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        
        $array = new ArrayObject();
        $array['foo'] = 'bar';
         
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

        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->assertArrayNotHasKey('foo', $array);
    }

    /**
     * @covers $this->assetArrayNotHasKey() 
     */
    public function tetsAssertArrayNotHasKeyThrowsException ()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        
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
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfNotCountable()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount(2, new stdClass());
    }
    
    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
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
     * @covers $this->assertFalse()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertFalseProperlyFailsWithNotBoolean()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertFalse('FALSE');
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
     * @covers $this->assertTrue()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertTrueProperlyFailsWithNotBoolean()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertTrue('TRUE');
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
     * @covers $this->assertInstanceOf() 
     */
    public function testAssertThatIsInstanceOfProperlyFailsWithInvalidArgumentTwo()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 has to be an object
        $this->assertInstanceOf('RuntimeException', 'RuntimeException');
         
        
    }
    
    public function testAssertThatIsInstanceOfProperlyFailsWithInvalidArgumentOne()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 has to be string or object
        $this->assertInstanceOf(array(), new RuntimeException());
        
        
         
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
    
    /**
     * @covers $this->assertInternalType()
     */
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
    /**
     * @covers $this->assertNotInternalType()
     */
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
    /**
     * @covers $this->assertSameSize()
     */
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
    
    /**
     * @covers $this->assertSameSize()
     */
    public function testAssertSameSizeProperlyFailsWithInvalidFirstParam()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 Countable, Iterator,or Array
        $this->assertSameSize(1920, array());
         
    }  
    
    public function testAssertSameSizeProperlyFailsWithInvalidSecondParam()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 Countable, Iterator,or Array
        $this->assertSameSize(array('one'), new stdClass());
         
         
        $this->fail();
    }
    
    
    /**
     * @covers $this->assertGreaterThan()
     */
    public function testAssertGreaterThan()
    {
        $this->assertGreaterThan(1, 2);
        
        try {
            $this->assertGreaterThan(2, 1);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers $this->assertGreaterThanOrEqual()
     */
    public function testAssertGreaterThanOrEqual()
    {
        $this->assertGreaterThanOrEqual(12, 12);
        $this->assertGreaterThanOrEqual(2, 12);
        
        try {
            $this->assertGreaterThanOrEqual(2, 1);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers $this->assertLessThan()
     */
    public function testAssertLessThan()
    {
        $this->assertLessThan(13, 2);
    
        try {
            $this->assertLessThan(2, 11);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertLessThanOrEqual()
     */
    public function testAssertLessThanOrEqual()
    {
        $this->assertLessThanOrEqual(13, 13);
        $this->assertLessThanOrEqual(13, 3);
    
        try {
            $this->assertLessThanOrEqual(1, 11);
        }
        catch(CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertStringStartsWith()
     */
    public function testAssertStringStartsWith()
    {
        $this->assertStringStartsWith('pre', 'presentation');
        
        try {
            $this->assertStringStartsWith('abc', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers $this->assertStringStartsWith()
     */
    public function testAssertStringStartsWithProperlyFailsWithInvalidFirstParam()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 must be string
        $this->assertStringStartsWith(array(1), 'presentation');
         
    }
   
   public function testAssertStringStartsWithProperlyFailsWithInvalidSecondParam()
   {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');   
        // #2 String as well
        $this->assertStringStartsWith('abc', array('abc'));
    }
    
    /**
     * @covers $this->assertStringNotStartsWith()
     */
    public function testAssertStringNotStartsWith()
    {
        $this->assertStringNotStartsWith('abv', 'presentation');
    
        try {
            $this->assertStringNotStartsWith('prese', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertStringEndsWith()
     */
    public function testAssertStringEndsWith()
    {
        $this->assertStringEndsWith('tation', 'presentation');
    
        try {
            $this->assertStringEndsWith('abc', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertStringEndsWith()
     */
    public function testAssertStringEndsWithProperlyFailsWithInvalidTypeException()
    { 
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 must be string
        $this->assertStringEndsWith(array(1), 'presentation');
       
    }
    
    public function testAssertStringEndsWithProperlyFailsWithInvalidSecondParam()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 String as well
        $this->assertStringEndsWith('abc', array('abc'));
       
    }
    
    /**
     * @covers $this->assertStringNotEndsWith()
     */
    public function testAssertStringNotEndsWith()
    {
        $this->assertStringNotEndsWith('tationr', 'presentation');
    
        try {
            $this->assertStringNotEndsWith('ion', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    
    /**
     * @covers $this->assertStringMatchesRegex()
     */
    public function testAssertStringMatchesRegex()
    {
        $this->assertStringMatchesRegex('/^pre/', 'presentation');
        
        try {
            $this->assertStringMatchesRegex('/^def/', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers $this->assertStringMatchesRegex()
     */
    public function testAssertStringNotMatchesRegex()
    {
        $this->assertStringNotMatchesRegex('/^prez/', 'presentation');
    
        try {
            $this->assertStringNotMatchesRegex('/^pr/', 'presentation');
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertStringMatchesRegex()
     */
    public function testAssertStringMatchesRegexProperlyFailsWithInvalidFirstParam()
    {

        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 must be string
        $this->assertStringMatchesRegex(1, 'presentation');
         
    }
    
    public function testAssertStringMatchesRegexProperlyFailsWithInvalidSecondParam()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 String as well
        $this->assertStringMatchesRegex('/^pre/', array('a', 'b'));
    }
    
    /**
     * @covers $this->assertObjectHasAttribute()
     */
    public function testAssertObjectHasAttribute()
    {
        $this->assertObjectHasAttribute('publicAttribute', new  ClassWithAttributes());
    
        try {
            $this->assertObjectHasAttribute('notExistingObjectAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertObjectNotHasAttribute()
     */
    public function testAssertObjectNotHasAttribute()
    {
        $this->assertObjectNotHasAttribute('notExistingObjectAttribute', new  ClassWithAttributes());
    
        try {
            $this->assertObjectNotHasAttribute('privateAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertObjectHasAttribute()
     */
    public function testAssertObjectHasAttributeProperlyFailsIfAttributeIsNotValid()
    { 
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertObjectHasAttribute('1', 'ClassWithAttributes');
         
    }
    
    /**
     * @covers $this->assertObjectHasStaticAttribute()
     */
    public function testAssertObjectHasStaticAttribute()
    {
        $this->assertObjectHasStaticAttribute('publicStaticAttribute', new  ClassWithAttributes());
    
        try {
            $this->assertObjectHasStaticAttribute('publicAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertObjectNotHasStaticAttribute()
     */
    public function testAssertObjectNotHasStaticAttribute()
    {
        $this->assertObjectNotHasStaticAttribute('publicAttribute', new  ClassWithAttributes());
    
        try {
            $this->assertObjectNotHasStaticAttribute('publicStaticAttribute', new  ClassWithAttributes());
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers $this->assertObjectHasStaticAttribute()
     */
    public function testAssertObjectHasStaticAttributeProperlyFailsIfAttributeIsNotValid()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertObjectHasStaticAttribute('1', new  ClassWithAttributes());
         
    }
    
//     public function testDebugMessage()
//     {
//         $userA = new stdClass();
//         $userB = new stdClass();
//         $userB->name = 'Jack';
//         $userB->age = 21;
        
//         // Load user
//         try {
//             // Reading user data form a file
//             $userA->name = 'Jack'; 
//             $this->debug('name is set to Jack');
//             $userA->age = 11;
//             $this->debug('age is set to 11');
            
            
//             // Something went wrong while reading
//             throw new Exception('Error while loading user data');
//         }
//         catch (Exception $e) { 
//             $this->fail($e->getMessage());
//         }
        
//         $this->assertEquals($userA, $userB);
//     }
}

