<?php
class ExceptionInSetUpTest extends CIUnit_Framework_TestCase
{
    public $setUp = FALSE;
    public $assertPreConditions = FALSE;
    public $assertPostConditions = FALSE;
    public $tearDown = FALSE;
    public $testSomething = FALSE;

    protected function setUp()
    {
        $this->setUp = TRUE;
        throw new Exception;
    }

    

    public function testSomething()
    {
        $this->testSomething = TRUE;
    }

    

    protected function tearDown()
    {
        $this->tearDown = TRUE;
    }
}
