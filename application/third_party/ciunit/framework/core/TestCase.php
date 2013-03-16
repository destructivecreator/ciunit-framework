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
 * Base class for creating test cases.
 *
 * @package CIUnit
 * @subpackage Core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
abstract class CIUnit_Framework_TestCase extends CIUnit_Framework_Assert implements 
        CIUnit_Framework_TestInterface
{ 

    private $result;

    private $name = null;

    private $class = null;

    private $numberOfAssertions = 0;

    private $status;

    private $statusMessage;

    private $expectedException = NULL;

    private $expectedExceptionMessage = NULL;

    private $expectedExceptionCode = NULL;

    /**
     *
     * @param string $name            
     */
    public function __construct ($name = NULL)
    {
        if (NULL !== $name) {
            $this->name = $name;
        }
        else {
            $name = new ReflectionClass($this);
            $this->name = $name->getName();
        }  
    }

    public function get_instance()
    {
        return $ci =& get_instance();
    }
    /**
     * Runs the test case and collects the results in a TestResult object.
     * If no TestResult object is passed a new one will be created.
     *
     * @see CIUnit_Framework_Test::run()
     */
    public function run (CIUnit_Framework_TestResult $result = NULL)
    {
        // Check for existing result object and create new if current is NULL
        if (NULL == $result) {
            $result = $this->createResult();
        }
        
        if (! $this instanceof CIUnit_Framework_TestWarning) {
            $this->result = $result;
        }
        
        // check for any dependencies ???
        
        $result->run($this);
        
        $this->result = NULL;
        
        return $result;
    }

    /**
     * Runs a test sequence
     * 
     * @throws Exception
     * @since version 1.0.0
     */
    public function runTestSequence ()
    {
        $this->numberOfAssertions = 0;
        
        try {
            // Run setup
            $this->setUp();
            
            // Run test
            $this->result = $this->runtest();
            
            $this->status = 0; // Passed
        }        // Catch for incomplete test
        catch (CIUnit_Framework_Exception_IncompleteTest $e) {
            $this->status = 2; // Incomplete
            $this->statusMessage = $e->getMessage();
        }        

        // Catch for skipped test
        catch (CIUnit_Framework_Exception_SkippedTest $e) {
            $this->status = 1; // Skipped
            $this->statusMessage = $e->getMessage();
        }        

        // Catch for Assertion Failure
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            $this->status = 3; // Failure
            $this->statusMessage = $e->getMessage();
        }        // Catch for Error
        catch (Exception $e) {
            $this->status = 4; // Error
            $this->statusMessage = $e->getMessage();
        }
        
        // revert fictures
        try {
            $this->tearDown();
        }        // catch any errors
        catch (Exception $error) {
            if (! isset($e))
                $e = $error;
        }
        
        // If there is exception caught throw it
        if (isset($e))
            throw $e;
    }

    /**
     * Override to run the test and assert its state.
     *
     * @since version 1.0.0
     */
    protected function runTest ()
    {
        
        // Check if test case has name, if not throw
        // CIUnit_Framework_Exception_CIUnitException
        if (NULL === $this->name) {
            throw new CIUnit_Framework_Exception_CIUnitException(
                    'name must not be null');
        }
        
        // Try to create new refection of this class and assign method
        try {
            
            $class = new ReflectionClass($this);
            $method = $class->getMethod($this->getName());
        } catch (ReflectionException $e) {
            $this->fail($e->getMessage());
        }
        
        // invoke method through reflection invokeArgs
        $testResult = NULL;
        try {
            $testResult = $method->invokeArgs($this, array());
            // $this->AddAssertionCount(CIUnit_Framework_Assert::getAssertionCount());
        }        // catch exception if thrown
        catch (Exception $e) {
            $check = FALSE;
            
            if (is_string($this->expectedException)) {
                $check = TRUE;
                
                if ($e instanceof CIUnit_Framework_Exception_CIUnitException) {
                    $check = FALSE;
                }
                
                $exceptionReflector = new ReflectionClass(
                        $this->expectedException);
                if ($exceptionReflector->isSubclassOf(
                        'CIUnit_Framework_Exception_CIUnitException') ||
                         $this->expectedException ==
                         'CIUnit_Framework_Exception_CIUnitException') {
                    $check = TRUE;
                }
            }
            
            if (TRUE == $check) {
                
                $constraint = new CIUnit_Framework_Constraint_Exception($this->expectedException);
                $this->assertThat($e, $constraint);
                 
                if(NULL != $this->expectedExceptionMessage) {
                    $messageConstraint = new CIUnit_Framework_Constraint_ExceptionMessage($this->expectedExceptionMessage);
                    $this->assertThat($e->getMessage(), $messageConstraint); 
                }
                
                if(NULL != $this->expectedExceptionCode) {
                    $codeConstraint = new CIUnit_Framework_Constraint_ExceptionCode($this->expectedExceptionCode);
                    $this->assertThat($e->getCode(), $codeConstraint);
                }
            } else {
                throw $e;
            }
        }
        
        // return test result
        
        return $testResult;
    }

    private function createResult ()
    {
        return new CIUnit_Framework_TestResult();
    }

    public function getName ()
    {
        if ($this->name instanceof ReflectionMethod) {
            return $this->name->getName();
        }
        
        return $this->name;
    }

    public function setName ($name)
    {
        $this->name = $name;
    }

    public function setClass ($class)
    {
        $this->class = $class;
    }

    public function getClass ()
    {
        return $this->class;
    }

    public function count ()
    {
        return 1;
    }

    public function AddAssertionCount ($count)
    {
        $this->numberOfAssertions += $count;
    }

    public function getNumberOfAssertions ()
    {
        return $this->numberOfAssertions;
    }

    /**
     *
     * @return string
     * @since version 1.0.0
     */
    public function getExpectedException ()
    {
        return $this->expectedException;
    }

    /**
     *
     * @param mixed $name            
     * @param string $message            
     * @param integer $code            
     * @since version 1.0.0
     */
    public function setExpectedException ($name, $message = NULL, $code = NULL)
    {
        $this->expectedException = $name;
        $this->expectedExceptionMessage = $message;
        $this->expectedExceptionCode = $code;
    } 

    public function getResult ()
    {
        return $this->result;
    }

    public function toString ()
    {
        $class = new ReflectionClass($this);
        
        $buffer = sprintf('%s::%s', 

        $class->name, $this->getName());
        
        return $buffer;
    }

    /**
     * This method is called before each test method
     *
     * @since version 1.0.0
     */
    protected function setUp ()
    {}


    /**
     * This method is called after each test method
     *
     * @since version 1.0.0
     */
    protected function tearDown ()
    {}
}
