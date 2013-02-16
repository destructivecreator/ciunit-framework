<?php

require_once 'TwoMehodTest.php';
require_once 'GreenTest.php';
require_once 'AssertTest.php';
require_once 'TestUserModel.php';

class ProjectPackage extends CIUnit_Framework_TestCase
{

    public static function suite()
    {
        $suite = new CIUnit_Framework_TestSuite('ProjectPackage');
        $suite->addTestSuite('GreenTest');
        $suite->addTestSuite('TwoMehodTest');
        $suite->addTestSuite('AssertTest'); 
        $suite->addTestSuite('TestUserModel');   
        
        return $suite;
    }
    
}

?>