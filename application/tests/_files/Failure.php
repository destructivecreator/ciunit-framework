<?php
class Failure extends CIUnit_Framework_TestCase
{
    protected function runTest()
    {
        $this->fail();
    }
}