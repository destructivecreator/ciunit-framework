<?php
class Error extends CIUnit_Framework_TestCase
{
    protected function runTest()
    {
        throw new Exception;
    }
}