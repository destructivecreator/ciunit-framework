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
        $this->assertArrayHasKey(0, array(
                'foo'
        ));
        
        try {
            $this->assertArrayHasKey(1, array(
                    'foo'
            ));
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
        $this->assertArrayHasKey('foo', array(
                'foo' => 'bar'
        ));
        
        try {
            $this->assertArrayHasKey('bar', array(
                    'foo' => 'bar'
            ));
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
        $array['foo'] = 'bar';
        
        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        
        $this->assertArrayHasKey('bar', $array);
    }

    /**
     * @covers $this->assetArrayHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function tetsAssertArrayHasKeyThrowsException ()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        $this->assertArrayHasKey(null, array());
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasIntegerKey ()
    {
        $this->assertArrayNotHasKey(1, array(
                'foo'
        ));
        
        try {
            $this->assertArrayNotHasKey(0, array(
                    'foo'
            ));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasStringKey ()
    {
        $this->assertArrayNotHasKey('foo', array(
                1 => 'bar'
        ));
        
        try {
            $this->assertArrayNotHasKey('foo', array(
                    'foo' => 'bar'
            ));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
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
        
        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        
        $this->assertArrayNotHasKey('foo', $array);
    }

    /**
     * @covers $this->assetArrayNotHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function tetsAssertArrayNotHasKeyThrowsException ()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        $this->assertArrayNotHasKey('foo', array(
                'foo' => 'bar'
        ));
    }

    /**
     * @covers Tests $this->assetCount()
     */
    public function testAssertCount ()
    {
        $this->assertCount(0, array());
        
        try {
            $this->assertCount(0, array(
                    'one',
                    'two'
            ));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfNotCountable ()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount(2, new stdClass());
    }

    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfExpectedNotInteger ()
    {
        $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount('dd', array());
    }

    /**
     * @covers $this->assertEmpty()
     */
    public function testAssertEmpty ()
    {
        $this->assertEmpty(array());
        
        try {
            $this->assertEmpty('String');
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotEmpty()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertNotEmpty ()
    {
        $this->assertNotEmpty('String');
        
        try {
            $this->assertNotEmpty(array());
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertFalse()
     */
    public function testAssertFalse ()
    {
        $this->assertFalse(FALSE);
        
        try {
            $this->assertFalse(TRUE);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertTrue()
     */
    public function testAssertTrue ()
    {
        $this->assertTrue(TRUE);
        
        try {
            $this->assertTrue(FALSE);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForIntegers ()
    {
        $this->assertEquals(1, 1);
        
        try {
            $this->assertEquals(1, 3);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForIntegersWithDelta ()
    {
        $this->assertEquals(1, 3, 5);
        
        try {
            $this->assertEquals(21, 3, 7);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForDoubles ()
    {
        $this->assertEquals(1.24, 1.24);
        
        try {
            $this->assertEquals(1.22, 1.223);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForDoublesWithDelta ()
    {
        $this->assertEquals(1.24, 4.24, 3.001);
        
        try {
            $this->assertEquals(1.22, 8.223, 0.123);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForArrays ()
    { 
        $actual = array(0, array(1), array(5), 3);
        $expected = array(0, array(1), array(2), 3);
         

        $this->assertEquals($actual, $expected);
        
        try {
            $expected = array(
                    'a',
                    'b',
                    'd'
            );
            
            $this->assertEquals($actual, $expected);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForRecursiveArrays ()
    {
    	$actual = array(0, array(1), array(2), 3); 
    	$expected =  array(0, array(1), array(2), 32); 
    	
    	$this->assertEquals($actual, $expected);
    
    	try {
    		$actual[] = &$actual;
    
    		$this->assertEquals($actual, $expected);
    	} catch (CIUnit_Framework_Exception_AssertionFailed $e) {
    		return;
    	}
    
    	$this->fail();
    }
    
    /**
    * @covers $this->assertEquals()
    */
    public function testAssertEqualsForObjects()
    {    	
        $objC = new stdClass;
        $objC->foo = 'bar';
        $objC->int = 1;
        $objC->array = array(0, array(1), array(2), 3);
        $objC->related = new stdClass;
        $objC->self = $objC;
        $objC->c = $objC;
        
        $objD = new stdClass;
        $objD->foo = 'bar';
        $objD->int = 1;
        $objD->array = array(0, array(1), array(2), 3);
        $objD->related = new stdClass;
        $objD->self = $objD;
        $objD->c = $objC;
        
        $this->assertEquals($objC, $objD);
        
        try {

            $objD->int =2;
            $this->assertEquals($objC, $objD);
        }
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers $this->assertEquals()
     */
//     public function testAssertEqualsForExceptions()
//     {    	
//     	$this->assertEquals(new Exception(), new Exception());
    		
//     	try {
//     		$this->assertEquals(new stdClass(), new Exception());
//     	}
//     	catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
//     		return;
//     	}
    		
//     	$this->fail();
//     }
    
    
    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForIntegers ()
    {
        $this->assertNotEquals(1, 2);
        
        try {
            $this->assertNotEquals(3, 3);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForIntegersWithDelta ()
    {
        $this->assertNotEquals(2, 3, 0);
        
        try {
            $this->assertNotEquals(2, 3, 1);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForDoubles ()
    {
        $this->assertNotEquals(1.24, 21.24);
        
        try {
            $this->assertNotEquals(1.223, 1.223);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForDoublesWithDelta ()
    {
        $this->assertNotEquals(11.24, 4.24, 3.001);
        
        try {
            $this->assertNotEquals(1.22, 1.223, 0.123);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForArrays ()
    {
        $actual = array(
                'a',
                'b',
                'c'
        );
        $expected = array(
                'a',
                'b',
                'd'
        );
        
        $this->assertNotEquals($actual, $expected);
        
        try {
            $expected = array(
                    'a',
                    'b',
                    'c'
            );
            
            $this->assertNotEquals($actual, $expected);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForObjects ()
    {
        $expected = new stdClass();
        
        $actual = new stdClass();
        $actual->foo = 'foo';
        
        $this->assertNotEquals($expected, $actual);
        
        try {
            $actual = new stdClass();
            $this->assertNotEquals($actual, $expected);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsWithDifferentTypes ()
    {
        $this->assertEquals('string', 'string');
        try {
            $this->assertEquals("d", 'string');
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertInstanceOf()
     */
    public function testAssertThatIsInstanceOf ()
    {
        $this->assertInstanceOf('RuntimeException', new RuntimeException());
        
        try {
            $this->assertInstanceOf('CIUnit_Framework_Assert', new Exception());
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotInstanceOf()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertThatIsNotInstanceOf ()
    {
        $this->assertNotInstanceOf('RuntimeException', new Exception());
        
        try {
            $this->assertNotInstanceOf('Exception', new Exception());
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNull()
     */
    public function testAssertNull ()
    {
        $this->assertNull(null);
        
        try {
            $this->assertNull('string');
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotNull()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertNotNull ()
    {
        $this->assertNotNull(123);
        
        try {
            $this->assertNotNull(null);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertInternalType()
     */
    public function testAssertInternalType ()
    {
        $this->assertInternalType('integer', 21);
        
        try {
            $this->assertInternalType('string', 111);
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotInternalType()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertNotInternalType ()
    {
        $this->assertNotInternalType('integer', '12');
        
        try {
            $this->assertNotInternalType('string', 'string');
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertSameSize()
     */
    public function testAssertSameSize ()
    {
        $this->assertSameSize(array(
                'one'
        ), array(
                1
        ));
        
        try {
            $this->assertSameSize(array(
                    'one'
            ), array());
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

    /**
     * @covers $this->assertNotSameSize()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertNotSameSize ()
    {
        $this->assertNotSameSize(array(), array(
                1
        ));
        
        try {
            $this->assertNotSameSize(array(
                    'one'
            ), array(
                    1
            ));
        } catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            return;
        }
        
        $this->fail();
    }

 

    public function testSkipTest ()
    {
        //$this->setExpectedException('CIUnit_Framework_Exception_SkippedTest');
        
        $this->skip('Custom message for skipped test');
    }

    /**
     * @covers $this->setExpectedException()
     */
    public function testExpectedException ()
    {
        $this->setExpectedException('RunTimeException');
        
        throw new RuntimeException('This is my RunTimeException');
    }
    
    public function testExpectedExceptionFailure()
    {
        $this->setExpectedException('Exception');
        
        throw new RuntimeException('This is my RunTimeException');
    }
} 

