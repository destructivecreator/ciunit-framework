<?php

/**
 * CIUnit_Framework_Assert test case.
 */
class IncompleteTest extends CIUnit_Framework_TestCase
{
    public function testCIInstance()
    {
       // $this->assertNotNull($this->get_instance(), 'It doesn\'t work here....');
    }
    

//     /**
//      * @covers $this->assetArrayHasKey()
//      */
//     public function testAssertArrayHasIntegerKey ()
//     {
//         $this->assertArrayHasKey(1, array(
//                 'foo'
//         ));
//     }

//     /**
//      * @covers $this->assetArrayHasKey()
//      */
//     public function testAssertArrayHasStringKey ()
//     {
//         $this->assertArrayHasKey('bar', array(
//                 'foo' => 'bar'
//         ));
//     }

//     /**
//      * @covers $this->assetArrayHasKey()
//      */
//     public function testAssertArrayHasKeyAcceptsArrayAccessValue ()
//     {
//         $array = new ArrayObject();
//         $array['foo'] = 'bar';
        
//         $this->assertArrayHasKey('foo', $array);
//     }

//     /**
//      * @covers $this->assetArrayHasKey()
//      * @expectedException CIUnit_Framework_Exception_AssertionFailed
//      */
//     public function testAssertArrayHasKeyProperlyFailsWithArrayAccessValue ()
//     {
//         $array = new ArrayObject();
//         $array['bar'] = 'foo';
        
//         $this->assertArrayHasKey('bar', $array);
//     }

//     /**
//      * @covers $this->assetArrayHasKey()
//      * @expectedException CIUnit_Framework_Exception_AssertionFailed
//      */
//     public function tetsAssertArrayHasKeyThrowsException ()
//     {
//         $this->assertArrayHasKey(null, array());
//     }

//     /**
//      * @covers Tests $this->assetArrayNotHasKey()
//      */
//     public function testAssertArrayNotHasIntegerKey ()
//     {
//         $this->assertArrayNotHasKey(0, array(
//                 'foo'
//         ));
//     }

//     /**
//      * @covers Tests $this->assetArrayNotHasKey()
//      */
//     public function testAssertArrayNotHasStringKey ()
//     {
//         $this->assertArrayNotHasKey('foo', array(
//                 'foo' => 'bar'
//         ));
//     }

//     /**
//      * @covers Tests $this->assetArrayNotHasKey()
//      */
//     public function testAssertArrayNotHasKeyAcceptsArrayAccessValue ()
//     {
//         $array = new ArrayObject();
//         $array['foo'] = 'bar';
        
//         $this->assertArrayNotHasKey(1, $array);
//     }

//     /**
//      * @covers $this->assetArrayNotHasKey()
//      * @expectedException CIUnit_Framework_Exception_AssertionFailed
//      */
//     public function testAssertArrayNotHasKeyProperlyFailsWithArrayAccessValue ()
//     {
//         $array = new ArrayObject();
//         $array['foo'] = 'bar';
        
//         $this->assertArrayNotHasKey('bar', $array);
//     }

//     /**
//      * @covers $this->assetArrayNotHasKey()
//      * @expectedException CIUnit_Framework_Exception_AssertionFailed
//      */
//     public function tetsAssertArrayNotHasKeyThrowsException ()
//     {
//         $this->assertArrayNotHasKey('foo', array(
//                 'foo' => 'bar'
//         ));
//     }

//     /**
//      * @covers Tests $this->assetCount()
//      */
//     public function testAssertCount ()
//     {
//         $this->assertCount(0, array(
//                 'one',
//                 'two'
//         ));
//     }

//     /**
//      * @covers $this->assetCount()
//      */
//     public function testAssertCountThrowsExceptionIfNotCountable ()
//     {
//         $this->setExpectedException(
//                 'CIUnit_Framework_Exception_InvalidArgument');
//         $this->assertCount(2, new stdClass());
//     }

//     /**
//      * @covers $this->assetCount()
//      */
//     public function testAssertCountThrowsExceptionIfExpectedNotInteger ()
//     {
//         $this->setExpectedException(
//                 'CIUnit_Framework_Exception_InvalidArgument');
//         $this->assertCount('dd', array());
//     }

//     /**
//      * @covers $this->assertEmpty()
//      */
//     public function testAssertEmpty ()
//     {
//         $this->assertEmpty('String');
//     }

//     /**
//      * @covers $this->assertNotEmpty()
//      */
//     public function testAssertNotEmpty ()
//     {
//         $this->assertNotEmpty(array());
//     }

//     /**
//      * @covers $this->assertFalse()
//      */
//     public function testAssertFalse ()
//     {
//         $this->assertFalse(TRUE);
//     }

//     /**
//      * @covers $this->assertTrue()
//      */
//     public function testAssertTrue ()
//     {
//         $this->assertTrue(FALSE);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEquals ()
//     {
//         $this->assertEquals('Integer', 'String');
//     }
    
//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsForIntegers ()
//     {
//         $this->assertEquals(1, 3);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsForIntegersWithDelta ()
//     {
//         $this->assertEquals(21, 3, 7);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsForDoubles ()
//     {
//         $this->assertEquals(1.22, 1.223);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsForDoublesWithDelta ()
//     {
//         $this->assertEquals(1.22, 8.223, 0.123);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsForArrays ()
//     {
//         $actual = array(
//                 'a',
//                 'b',
//                 'c'
//         );
        
//         $expected = array(
//                 'a',
//                 'b',
//                 'd'
//         );
        
//         $this->assertEquals($actual, $expected);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsForObjects ()
//     {
//         $expected = new stdClass();
//         $expected->name = "John";
//         $expected->age = 11;
        
//         $actual = new stdClass();
//         $actual->name = "John";
//         $actual->age = 11;
        
//         $expected->age = '19';
        
//         $this->assertEquals($actual, $expected);
//     }

//     /**
//      * @covers $this->assertEquals()
//      */
//     public function testAssertEqualsWithDifferentTypes ()
//     {
//         $this->assertEquals(1, 'ss');
//     }

    

    /**
//      * @covers $this->assertInstanceOf()
//      */
//     public function testAssertThatIsInstanceOf ()
//     {
//         $this->assertInstanceOf('CIUnit_Framework_Assert', new Exception());
//     }

//     /**
//      * @covers $this->assertNotInstanceOf()
//      */
//     public function testAssertThatIsNotInstanceOf ()
//     {
//         $this->assertNotInstanceOf('Exception', new Exception());
//     }

//     /**
//      * @covers $this->assertNull()
//      */
//     public function testAssertNull ()
//     {
//         $this->assertNull('string');
//     }

//     /**
//      * @covers $this->assertNotNull()
//      */
//     public function testAssertNotNull ()
//     {
//         $this->assertNotNull(null);
//     }

//     public function testAssertInternalType ()
//     {
//         $this->assertInternalType('string', 111);
//     }

//     public function testAssertNotInternalType ()
//     {
//         $this->assertNotInternalType('string', 'sasa');
//     }

//     public function testAssertSameSize ()
//     {
//         $this->assertSameSize(array(
//                 'one'
//         ), array());
//     }
    
    
}

