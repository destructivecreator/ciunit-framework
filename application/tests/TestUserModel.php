<?php

class TestUserModel extends \CIUnit_TestCase
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
        $this->assertArrayHasKey('bar', 
                array(
                        'foo' => 'bar'
                ));
    }

    /**
     * @covers $this->assetArrayHasKey()
     */
    public function testAssertArrayHasKeyAcceptsArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['fooe'] = 'bar';
        
        $this->assertArrayHasKey('foo', $array);
    }

    /**
     * @covers $this->assetArrayHasKey()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function testAssertArrayHasKeyProperlyFailsWithArrayAccessValue ()
    {
        $array = new ArrayObject();
        $array['foo'] = 'bar';
        
        $this->setExpectedException('CIUnit_AssertionFailedException1');
        
        $this->assertArrayHasKey('bar', $array);
    }

    /**
     * @covers $this->assetArrayHasKey()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function tetsAssertArrayHasKeyThrowsException ()
    {
        $this->setExpectedException('CIUnit_AssertionFailedException');
        $this->assertArrayHasKey(array(), array());
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasIntegerKey ()
    {
        $this->assertArrayNotHasKey(0, 
                array(
                        'foo'
                ));
    }

    /**
     * @covers Tests $this->assetArrayNotHasKey()
     */
    public function testAssertArrayNotHasStringKey ()
    {
        $this->assertArrayNotHasKey('foo', 
                array(
                        'foo' => 'bar'
                ));
    }

    /**
     * @covers Tests $this->assetCount()
     */
    public function testAssertCount ()
    {
        $this->assertCount(0, 
                array(
                        'one',
                        'two'
                ));
    }

    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_InvalidArgumentException
     */
    public function testAssertCountThrowsExceptionIfNotCountable ()
    {
        $this->setExpectedException('CIUnit_InvalidArgumentException');
        $this->assertCount(2, new stdClass());
    }

    /**
     * @covers $this->assetCount()
     * @expectedException CIUnit_InvalidArgumentException
     */
    public function testAssertCountThrowsExceptionIfExpectedNotInteger ()
    {
        $this->setExpectedException('CIUnit_InvalidArgumentException');
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
     * @expectedException CIUnit_AssertionFailedException
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
     * @covers $this->assertTrue()
     */
    public function testAssertTrue ()
    {
        $this->assertTrue(FALSE);
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
                0,
                array(
                        1
                ),
                array(
                        2
                ),
                3
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
        $objC = new stdClass();
        $objC->foo = 'bar';
        $objC->int = 1;
        $objC->array = array(
                0,
                array(
                        1
                ),
                array(
                        2
                ),
                3
        );
        $objC->related = new stdClass();
        $objC->self = $objC;
        $objC->c = $objC;
        
        $objD = new stdClass();
        $objD->foo = 'bar';
        $objD->int = 1;
        $objD->array = array(
                0,
                array(
                        1
                ),
                array(
                        2
                ),
                3
        );
        $objD->related = new stdClass();
        $objD->self = $objD;
        $objD->c = $objC;
        
        $objD->int = 2;
        $this->assertEquals($objC, $objD);
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForIntegers ()
    {
        $this->assertNotEquals(3, 3);
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForIntegersWithDelta ()
    {
        $this->assertNotEquals(2, 3, 1);
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForDoubles ()
    {
        $this->assertNotEquals(1.223, 1.223);
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForDoublesWithDelta ()
    {
        $this->assertNotEquals(1.22, 1.223, 0.123);
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
                'c'
        );
        
        $this->assertNotEquals($actual, $expected);
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForObjects ()
    {
        $expected = new stdClass();
        
        $actual = new stdClass();
        
        $this->assertNotEquals($actual, $expected);
    }

    /**
     * @covers $this->assertEquals()
     */
    public function testAssertEqualsWithDifferentTypes ()
    {
        $this->assertEquals("d", 'string');
    }

    /**
     * @covers $this->assertInstanceOf()
     */
    public function testAssertThatIsInstanceOf ()
    {
        $this->assertInstanceOf('CIUnit_Assert', new Exception());
    }

    /**
     * @covers $this->assertNotInstanceOf()
     * @expectedException CIUnit_AssertionFailedException
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
     * @expectedException CIUnit_AssertionFailedException
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
     * @expectedException CIUnit_AssertionFailedException
     */
    public function testAssertNotInternalType ()
    {
        $this->assertNotInternalType('string', 'string');
    }

    /**
     * @covers $this->assertSameSize()
     */
    public function testAssertSameSize ()
    {
        $this->assertSameSize(
                array(
                        'one'
                ), array());
    }

    /**
     * @covers $this->assertNotSameSize()
     * @expectedException CIUnit_AssertionFailedException
     */
    public function testAssertNotSameSize ()
    {
        $this->assertNotSameSize(
                array(
                        'one'
                ), array(
                        1
                ));
    }

    public function testSkipTest ()
    {
        // $this->setExpectedException('CIUnit_SkippedTestException');
        $this->skip('Custom message for skipped test');
    }

    /**
     * @covers $this->setExpectedException()
     */
    public function testExpectedException ()
    {
        $this->setExpectedException('RunTimeException1');
        
        throw new RuntimeException('This is my RunTimeException');
    }

    public function testExpectedExceptionFailure ()
    {
        $this->setExpectedException('Exception');
        
        throw new Exception('This is my Exception');
    }

    public function testAssertNotEqualsForIntegers2 ()
    {
        $this->assertNotEquals(3, 3);
    }

    /**
     * @covers $this->assertNotEquals()
     */
    public function testAssertNotEqualsForIntegersWithDelta2 ()
    {
        $this->assertNotEquals(2, 3, 1);
    }
}

?>