<?php

/**
 * CIUnit
 *
 * Copyright (c) 2013, Agop Seropyan <agopseropyan@gmail.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Agop Seropyan nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    CIUnit
 * @subpackage Core
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * A TestCase defines the fixture to run multiple tests.
 *
 * Each test is run in its own fixture so there are no side effects in other
 * tests.
 *
 * @package CIUnit
 * @subpackage Core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_TestSuite implements CIUnit_Framework_TestInterface, 
        IteratorAggregate
{

    /**
     *
     * @var string
     */
    protected $name = '';

    /**
     *
     * @var array
     */
    public $testInSuite = array();

    /**
     *
     * @var integer
     */
    protected $testsCount = 0;

    /**
     *
     * @var boolean
     */
    protected $validTestCase = FALSE;

    /**
     *
     * @param mixed $class            
     * @param string $name            
     * @throws CIUnit_Framework_Exception_CIUnitException
     */
    public function __construct ($class = '', $name = '')
    {
        $valid = FALSE;
        
        // Check for passed object
        if (is_object($class) && $class instanceof ReflectionClass) {
            $valid = true;
        }
        
        $ref = new ReflectionClass($this);
        // Handle if suite instance
        if($ref->isSubclassOf('CIUnit_Framework_TestSuite')) {
            
            $declaredClasses = get_declared_classes();

            // Suites can be made just from one test class using the class constructor,
            // in that case make sure the name of the suite is not a real class.
            if(!in_array($class, $declaredClasses)) {
                if($ref->getName() != $class ) {
                    $name = $class;
                    $class = $ref->getName();
                }
            }
        }
        
        if (is_string($class) && $class !== '' && class_exists($class, FALSE)) {
            $valid = true;
            if ($name == '') {
                $this->name = $class;
            }
            // Create reflection for class
            $class = new ReflectionClass($class);
        } else {
            if (is_string($class)) {
                $this->name = $class;
                
                throw new CIUnit_Framework_Exception_CIUnitException(
                        "Class " . $class . " does not exist.");
                
                return;
            }
        }
        // Throw exception if the class argument is not valid
        if (! $valid) {
            throw new CIUnit_Framework_Exception_CIUnitException(
                    'class argument is not valid');
        }
        
        // Throw exception if the class does not extend
        // CIUnit_Framework_TestCase
        if (! $class->isSubclassOf('CIUnit_Framework_TestCase') && ! $class->isSubclassOf('CIUnit_Framework_TestSuite')) {
            throw new CIUnit_Framework_Exception_CIUnitException(
                    "Class " . $class->name .
                             " does not extend CIUnit_Framework_TestCase nor CIUnit_Framework_TestSuite");
        }
        
        // Set the name of the suite
        if ($name != '') {
            $this->name = $name;
        } else {
            $this->name = $class->getName();
        }
        
        // Get class constructor trough reflection
        $classConstructor = $class->getConstructor();
        
        // Check if constructor not NULL and is public
        if ($classConstructor !== NULL && ! $classConstructor->isPublic()) {
            // Add warning class must have a public constructor
            $this->addTest(
                    new CIUnit_Framework_TestWarning(
                            "Warning class must have a public constructor"));
        }
        
        
        // Get all class methods and add them to test
        foreach ($class->getMethods() as $method) {
            $this->addTestMethod($class, $method);
        }
        
        // Check if there are any test in the class
        if (empty($this->testInSuite)) {
            if(!$class->isSubclassOf('CIUnit_Framework_TestSuite'))
            // Add warning class has no methods
            $this->addTest(
                    new CIUnit_Framework_TestWarning(sprintf("Warning class %s has no test methods", $class->getName())));
        }
        
        $this->validTestCase = TRUE;
    }

    public function addTestMethod (ReflectionClass $class, 
            ReflectionMethod $method)
    {
        $methodName = $method->getName();
        // Check mehtod is public and is test*
        if (self::isPublicTestMethod($method)) {
            $test = self::createNewTest($class, $method);
            // Add to list
            $this->addTest($test);
        }
    }

    /**
     * Add method to test suite
     *
     * @param
     *            CIUnit_Framework_TestInterface$test
     * @since version 1.0.0
     */
    public function addTest (CIUnit_Framework_TestInterface $test)
    {
        $class = new ReflectionClass($test);
        
        if (! $class->isAbstract()) { 
            $this->testInSuite[] = $test;
            $this->testsCount = 0;
        }
    }
    
    /**
     * Adds test from a given class to the current suite 
     *
     * @param mixed $testClass
     * @throws CIUnit_Framework_Exception_InvalidArgument
     * @throws CIUnit_Framework_Exception_CIUnitException
     */
    public function addTestSuite($testClass)
    {
        if(is_string($testClass) && class_exists($testClass)) {
            $testClass = new ReflectionClass($testClass);
        }
    
        if(!is_object($testClass)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 'class name or object');
        }
    
        if($testClass instanceof ReflectionClass) {
            $testSuiteAdded = FALSE;
            // Check for suite method defined in test case class
            // Make sure class is not abstract so can instantiate it
            if(!$testClass->isAbstract()) {
                // Check if there is a suite method declared
                if($testClass->hasMethod('suite')) {
                    $suiteMethod = $testClass->getMethod('suite');
    
                    // Method suite must be static
                    if($suiteMethod->isStatic()) {
                        // suite method is to return a suite object
                        // use reflection invoke method to invoke the suite() to return a suite object
                        // pass null as it is static method
                        $this->addTest($suiteMethod->invoke(null, $suiteMethod->getName()));
                        $testSuiteAdded = TRUE;
                    }
                }
    
                // If for some reason suite has not been found or added add the class itself to the suite
                if(!$testSuiteAdded) {
                    $this->addTest(new CIUnit_Framework_TestSuite($testClass));
                }
            }
        }
        else if ($testClass instanceof CIUnit_Framework_TestSuite) {
            $this->addTest($testClass);
        }
        else {
            throw new CIUnit_Framework_Exception_CIUnitException;
        }
    }
    

    /**
     * Creates new instance of the test class requested
     *
     * @param ReflectionClass $class            
     * @param string $method            
     * @throws CIUnit_Framework_Exception_CIUnitException
     * @return CIUnit_Framework_Exception_CIUnitException
     *         CIUnit_Framework_TestCase
     */
    public static function createNewTest (ReflectionClass $class, $method)
    {
        // get class name
        $className = $class->getName();
        // is instantiable
        if (! $class->isInstantiable()) {
            return new CIUnit_Framework_Exception_CIUnitException(
                    "Cannot instantiate class " . $className);
        }
        // Get constructor
        $constructor = $class->getConstructor();
        
        if ($constructor !== NULL) {
            $parameters = $constructor->getParameters();
            
            // TestCase() or TestCase($name)
            if (count($parameters) < 2) {
                // print "Instantiating new " . $class->getName();
                // $theClass = $class->getName();
                $test = new $className();
            }
        }
        
        // Check if $test isset
        if (! isset($test)) {
            throw new CIUnit_Framework_Exception_CIUnitException(
                    "No valid test provided");
        }
        
        // Is test instance of CIUnit_Framework_TestCase
        if ($test instanceof CIUnit_Framework_TestCase) {
            $test->setName($method);
            $test->setClass($class->getName());
        }
        
        return $test;
    }

    /**
     * Checks if the processed method is test method
     *
     * @param string $method            
     * @return boolean
     */
    public static function isTestMethod ($method)
    {
        return (substr($method->name, 0, 4) == 'test');
    }

    /**
     * Checks if method is public
     *
     * @param string $method            
     * @return boolean
     */
    public static function isPublicTestMethod (ReflectionMethod $method)
    {
        return self::isTestMethod($method) && ($method->isPublic() || $method->isProtected());
    }

    public function getIterator ()
    {
        return new ArrayIterator($this);
    }
    
    /*
     * (non-PHPdoc) @see CIUnit_Framework_Test::run()
     */
    public function run (CIUnit_Framework_TestResult $result = NULL)
    {
        // Check result object
        if (NULL == $result) {
            $result = $this->createResult();
        }
        
        // Try setUp
        try {
            $this->setUp(); 
        }
        catch (Exception $e) {
            $numTests = count($this);
            for ($i = 0; $i < $numTests; $i++) {
                $result->addError($this, $e, 0);
            }
        
            return $result;
        }
        
        
        // $test = $this->tests
        $tests = $this->testInSuite;
        // foreach tests as test
        foreach ($tests as $test) {
            // Check if test is a test or a suite of tests
            if ($test instanceof CIUnit_Framework_TestSuite) {
                // test instance of Suite
                // call $test->run()
                $test->run($result);
            }             // test instanceof testcase
            else {
                if ($test instanceof CIUnit_Framework_TestCase) {
                    // call $this->invoke...($test)
                    $this->invokeTestRunMethod($test, $result);
                }
            }
        }
        // do tearDownA
        $this->tearDown();
        
        return $result;
    }

    public function invokeTestRunMethod (CIUnit_Framework_TestInterface $test, 
            CIUnit_Framework_TestResult $result)
    {
        $test->run($result);
    }

    public function setName ($name)
    {
        $this->name = $name;
    }

    public function getName ()
    {
        return $this->name;
    }
    
    /*
     * (non-PHPdoc) @see Countable::count()
     */
    public function count ()
    {
        if ($this->testsCount > 0)
            return $this->testsCount;
        
        foreach ($this->testInSuite as $test) {
            $this->testsCount ++;
        }
        
        return $this->testsCount;
    }

    /**
     * Creates a default TestResult object.
     *
     * @return PHPUnit_Framework_TestResult
     */
    protected function createResult ()
    {
        return new CIUnit_Framework_TestResult();
    }
    
    /**
     * Template Method that is called before the tests
     * of this test suite are run.
     *
     * @since  Method available since Release 1.0.0
     */
    protected function setUp()
    {
    }
    
    /**
     * Template Method that is called after the tests
     * of this test suite have finished running.
     *
     * @since  Method available since Release 1.0.0
     */
    protected function tearDown()
    {
    }
}

?>