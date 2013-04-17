<?php

/**
 * CIUnit_Framework_Assert test case.
 */
class FailuresTest extends CIUnit_Framework_TestCase
{

    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasIntegerKey ()
    {
        $this->assertArrayHasKey(1, array(
                'foo'
        ));
    }

    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasStringKey ()
    {
        $this->assertArrayHasKey('bar', array(
                'foo' => 'bar'
        ));
    }

    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->assertArrayHasKey('foo1', $array);
    }

    /**
     * @covers $this->assetArrayHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertArrayHasKeyProperlyFailsWithArrayAccessValue ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
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
        $this->assertArrayNotHasKey(0, array(
                'foo'
        ));
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasStringKey ()
    {
        $this->assertArrayNotHasKey('foo', array(
                'foo' => 'bar'
        ));
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->assertArrayNotHasKey(77, $array);
    }

    /**
     * @covers $this->assetArrayNotHasKey()
     * @expectedException CIUnit_Framework_Exception_AssertionFailed
     */
    public function testAssertArrayNotHasKeyProperlyFailsWithArrayAccessValue ()
    {
        
        // $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->assertArrayNotHasKey('foo', $array);
    }

    /**
     * @covers $this->assetArrayNotHasKey()
     */
    public function tetsAssertArrayNotHasKeyThrowsException ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_AssertionFailed');
        $this->assertArrayNotHasKey('foo', array(
                'foo' => 'bar'
        ));
    }

    /**
     * @covers Tests $this->assetCount()
     */
    public function testAssertCount ()
    {
        $this->assertCount(0, array(
                'one',
                'two'
        ));
    }

    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfNotCountable ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount(2, new stdClass());
    }

    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertCountThrowsExceptionIfExpectedNotInteger ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertCount('dd', array());
    }

    /**
     * @covers $this->assertEmpty()
     */
    public function testAssertEmpty ()
    {
        $this->assertEmpty('String');
    }

    /**
     * @covers $this->assertNotEmpty()
     */
    public function testAssertNotEmpty ()
    {
        $this->assertNotEmpty(array());
    }

    /**
     * @covers $this->assertFalse()
     */
    public function testAssertFalse ()
    {
        $this->assertFalse(TRUE);
    }

    /**
     * @covers $this->assertFalse()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertFalseProperlyFailsWithNotBoolean ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertFalse('FALSE');
    }

    /**
     * @covers $this->assertTrue()
     */
    public function testAssertTrue ()
    {
        $this->assertTrue(FALSE);
    }

    /**
     * @covers $this->assertTrue()
     * @expectedException CIUnit_Framework_Exception_InvalidArgument
     */
    public function testAssertTrueProperlyFailsWithNotBoolean ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        $this->assertTrue('TRUE');
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForIntegers ()
    {
        $this->assertEquals(1, 3);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForIntegersWithDelta ()
    {
        $this->assertEquals(21, 3, 7);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForDoubles ()
    {
        $this->assertEquals(1.22, 1.223);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForDoublesWithDelta ()
    {
        $this->assertEquals(1.22, 8.223, 0.123);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForArrays ()
    {
        $actual = array(
                'a',
                'b',
                'c'
        );
        $expected = array(
                'a',
                'b',
                'c'
        );
        
        $expected = array(
                'a',
                'b',
                'd'
        );
        
        $this->assertEquals($actual, $expected);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsForObjects ()
    {
        $expected = new stdClass();
        $expected->name = "John";
        $expected->age = 11;
        
        $actual = new stdClass();
        $actual->name = "John";
        $actual->age = 11;
        
        $expected->age = '19';
        
        $this->assertEquals($actual, $expected);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsWithDifferentTypes ()
    {
        $this->assertEquals(1, 'ss');
    }

    /**
     * @covers $this->assertEquals()
     */
//     public function testAssertEqualsForExceptions ()
//     {
//         $this->assertEquals(new stdClass(), new Exception());
//     }

    /**
     * @covers $this->assertInstanceOf()
     */
    public function testAssertThatIsInstanceOf ()
    {
        $this->assertInstanceOf('CIUnit_Framework_Assert', new Exception());
    }

    /**
     * @covers $this->assertInstanceOf()
     */
    public function testAssertThatIsInstanceOfProperlyFailsWithInvalidArgumentTwo ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 has to be an object
        $this->assertInstanceOf('RuntimeException', 'RuntimeException');
    }

    public function testAssertThatIsInstanceOfProperlyFailsWithInvalidArgumentOne ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 has to be string or object
        $this->assertInstanceOf(array(), new RuntimeException());
    }

    /**
     * @covers $this->assertNotInstanceOf()
     */
    public function testAssertThatIsNotInstanceOf ()
    {
        $this->assertNotInstanceOf('Exception', new Exception());
    }

    /**
     * @covers $this->assertNull()
     */
    public function testAssertNull ()
    {
        $this->assertNull('string');
    }

    /**
     * @covers $this->assertNotNull()
     */
    public function testAssertNotNull ()
    {
        $this->assertNotNull(null);
    }

    /**
     * @covers $this->assertInternalType()
     */
    public function testAssertInternalType ()
    {
        $this->assertInternalType('string', 111);
    }

    /**
     * @covers $this->assertNotInternalType()
     */
    public function testAssertNotInternalType ()
    {
        $this->assertNotInternalType('string', 'sasa');
    }

    /**
     * @covers $this->assertSameSize()
     */
    public function testAssertSameSize ()
    {
        $this->assertSameSize(array(
                'one'
        ), array());
    }

    /**
     * @covers $this->assertSameSize()
     */
    public function testAssertSameSizeProperlyFailsWithInvalidFirstParam ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 Countable, Iterator,or Array
        $this->assertSameSize(1920, array());
    }

    public function testAssertSameSizeProperlyFailsWithInvalidSecondParam ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 Countable, Iterator,or Array
        $this->assertSameSize(array(
                'one'
        ), new stdClass());
        
        $this->fail();
    }

    /**
     * @covers $this->assertGreaterThan()
     */
    public function testAssertGreaterThan ()
    {
        $this->assertGreaterThan(2, 1);
    }

    /**
     * @covers $this->assertGreaterThanOrEqual()
     */
    public function testAssertGreaterThanOrEqual ()
    {
        $this->assertGreaterThanOrEqual(2, 1);
    }

    /**
     * @covers $this->assertLessThan()
     */
    public function testAssertLessThan ()
    {
        $this->assertLessThan(2, 11);
    }

    /**
     * @covers $this->assertLessThanOrEqual()
     */
    public function testAssertLessThanOrEqual ()
    {
        $this->assertLessThanOrEqual(1, 11);
    }

    /**
     * @covers $this->assertStringStartsWith()
     */
    public function testAssertStringStartsWith ()
    {
        $this->assertStringStartsWith('abc', 'presentation');
    }

    /**
     * @covers $this->assertStringStartsWith()
     */
    public function testAssertStringStartsWithProperlyFailsWithInvalidFirstParam ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 must be string
        $this->assertStringStartsWith(array(
                1
        ), 'presentation');
    }

    public function testAssertStringStartsWithProperlyFailsWithInvalidSecondParam ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 String as well
        $this->assertStringStartsWith('abc', array(
                'abc'
        ));
    }

    /**
     * @covers $this->assertStringNotStartsWith()
     */
    public function testAssertStringNotStartsWith ()
    {
        $this->assertStringNotStartsWith('prese', 'presentation');
    }

    /**
     * @covers $this->assertStringEndsWith()
     */
    public function testAssertStringEndsWith ()
    {
        $this->assertStringEndsWith('abc', 'presentation');
    }

    /**
     * @covers $this->assertStringEndsWith()
     */
    public function testAssertStringEndsWithProperlyFailsWithInvalidTypeException ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 must be string
        $this->assertStringEndsWith(array(
                1
        ), 'presentation');
    }

    public function testAssertStringEndsWithProperlyFailsWithInvalidSecondParam ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 String as well
        $this->assertStringEndsWith('abc', array(
                'abc'
        ));
    }

    /**
     * @covers $this->assertStringNotEndsWith()
     */
    public function testAssertStringNotEndsWith ()
    {
        $this->assertStringNotEndsWith('ion', 'presentation');
    }

    /**
     * @covers $this->assertStringMatchesRegex()
     */
    public function testAssertStringMatchesRegex ()
    {
        $this->assertStringMatchesRegex('/^def/', 'presentation');
    }

    /**
     * @covers $this->assertStringMatchesRegex()
     */
    public function testAssertStringNotMatchesRegex ()
    {
        $this->assertStringNotMatchesRegex('/^pr/', 'presentation');
    }

    /**
     * @covers $this->assertStringMatchesRegex()
     */
    public function testAssertStringMatchesRegexProperlyFailsWithInvalidFirstParam ()
    {
        
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #1 must be string
        $this->assertStringMatchesRegex(1, 'presentation');
    }

    public function testAssertStringMatchesRegexProperlyFailsWithInvalidSecondParam ()
    {
        // $this->setExpectedException('CIUnit_Framework_Exception_InvalidArgument');
        // #2 String as well
        $this->assertStringMatchesRegex('/^pre/', array(
                'a',
                'b'
        ));
    }
}

