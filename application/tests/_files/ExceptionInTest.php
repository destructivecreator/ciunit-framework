<?php
class ExceptionInTest extends CIUnit_Framework_TestCase
{
    public $setUp = FALSE;
    public $assertPreConditions = FALSE;
    public $assertPostConditions = FALSE;
    public $tearDown = FALSE;
    public $testSomething = FALSE;

    protected function setUp()
    {
        $this->setUp = TRUE;
    } 

    public function testSomething()
    {
        $this->testSomething = TRUE;
        throw new Exception;
    } 

    protected function tearDown()
    {
        $this->tearDown = TRUE;
    }
}
