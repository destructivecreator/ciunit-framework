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
 * Class collects a the result of all test run.
 *
 * @package CIUnit
 * @subpackage Core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_TestResult implements Countable
{

    /**
     *
     * @var array
     */
    protected $passed = array();

    /**
     *
     * @var array
     */
    protected $errors = array();

    /**
     *
     * @var array
     */
    protected $failures = array();

    /**
     *
     * @var array
     */
    protected $skipped = array();

    /**
     *
     * @var array
     */
    protected $notImplemented = array();

    /**
     *
     * @var integer
     */
    protected $totalNuberOfTestsToRun = 0;

    /**
     *
     * @var integer
     */
    protected $assertionsCount = 0;

    /**
     *
     * @var integer
     */
    protected $executionTime;

    /**
     * Adds an error to the list of errors
     *
     * @param
     *            CIUnit_Framework_TestInterface$test
     * @param Exception $exception            
     * @param float $time            
     * @since version 1.0.0
     */
    public function addError (CIUnit_Framework_TestInterface $test, 
            Exception $exception, $time)
    {
        // Check if incomplete
        if ($exception instanceof CIUnit_Framework_Exception_IncompleteTest) {
            $this->notImplemented[] = new CIUnit_Framework_TestFailure($test, 
                    $exception);
        }         

        // Check if skipped
        else 
            if ($exception instanceof CIUnit_Framework_Exception_SkippedTest) {
                $this->skipped[] = new CIUnit_Framework_TestFailure($test, 
                        $exception);
            }             

            // Check if TestFailure
            else {
                $this->errors[] = new CIUnit_Framework_TestFailure($test, 
                        $exception);
            }
        
        $this->executionTime += $time;
    }

    public function addSuccess (CIUnit_Framework_TestInterface $test, $time)
    {
        $this->passed[] = new CIUnit_Framework_TestSuccess($test);
        $this->executionTime += $time;
    }

    /**
     * Adds a fauilure to the list of failures
     *
     * @param
     *            CIUnit_Framework_TestInterface$test
     * @param CIUnit_Framework_Exception_AssertionFailed $exception            
     * @param float $time            
     * @since version 1.0.0
     */
    public function addFailure (CIUnit_Framework_TestInterface $test, 
            CIUnit_Framework_Exception_AssertionFailed $exception, $time)
    {
        // Check if incomplete
        if ($exception instanceof CIUnit_Framework_Exception_IncompleteTest) {
            $this->notImplemented[] = new CIUnit_Framework_TestFailure($test, 
                    $exception);
        }         

        // Check if skipped
        else 
            if ($exception instanceof CIUnit_Framework_Exception_SkippedTest) {
                $this->skipped[] = new CIUnit_Framework_TestFailure($test, 
                        $exception);
            }             

            // Check if TestFailure
            else {
                $this->failures[] = new CIUnit_Framework_TestFailure($test, 
                        $exception);
            }
        
        $this->executionTime += $time;
    }

    /**
     * Runs a TestCase
     *
     * @param
     *            CIUnit_Framework_TestInterface$test
     * @since version 1.0.0
     */
    public function run (CIUnit_Framework_TestInterface $test)
    {
        // Reset the number of assertions in CIUnit_Framework_Assert
        // class
        CIUnit_Framework_Assert::resetAssertionCount();
        
        // Create local flags for error, skipped incomplete and failure = FALSE
        $error = FALSE;
        $failure = FALSE;
        $incomplete = FALSE;
        $skipped = FALSE;
        
        // Start php timer PHP_Timer::start()
        CIUnit_Util_Timer::start();
        // Call runBare or use invoker class
        try {
            $test->runTestSequence();
        }        

        // Catch exceptions and set flags to TRUE
        catch (CIUnit_Framework_Exception_AssertionFailed $e) {
            $failure = TRUE;
            
            if ($e instanceof CIUnit_Framework_Exception_SkippedTest) {
                $skipped = TRUE;
            } else 
                if ($e instanceof CIUnit_Framework_Exception_IncompleteTest) {
                    $incomplete = TRUE;
                }
        } 

        catch (Exception $e) {
            $error = TRUE;
        }
        
        // Stop PHP timer
        $executionTime = CIUnit_Util_Timer::stop();
        
        // Add the current Asset class assertion count to TestCase assertions
        // count
        $test->addAssertionCount(
                CIUnit_Framework_Assert::getAssertionCount());
        
        $this->totalNuberOfTestsToRun += $test->count();
        $this->assertionsCount += $test->getNumberOfAssertions();
        
        // Call $this->addError or $this->addFailure
        if ($error === TRUE) {
            $this->addError($test, $e, $executionTime);
        } else 
            if ($failure === TRUE) {
                $this->addFailure($test, $e, $executionTime);
            } else 
                if ($test->getNumberOfAssertions() == 0) {
                    $this->addFailure($test, 
                            new CIUnit_Framework_Exception_IncompleteTest(
                                    'Test did not perform any assertions'), 
                            $executionTime);
                } else {
                    $this->addSuccess($test, $executionTime);
                }
    }

    /**
     * Gets the number of skipped tests
     *
     * @return number
     * @since version 1.0.0
     */
    public function getSkippedCount ()
    {
        return count($this->skipped);
    }

    /**
     * Returns all skipped test
     *
     * @return multitype:
     * @since version 1.0.0
     */
    public function getSkipped ()
    {
        return $this->skipped;
    }

    /**
     * Gets the number of failed tests
     *
     * @return number
     * @since version 1.0.0
     */
    public function getFailureCount ()
    {
        return count($this->failures);
    }

    /**
     * Returns all failed tests
     * 
     * @return multitype:
     * @since version 1.0.0
     */
    public function getFailures ()
    {
        return $this->failures;
    }

    /**
     * Gets the number of errors in test
     *
     * @return number
     * @since version 1.0.0
     */
    public function getErrorCount ()
    {
        return count($this->errors);
    }

    /**
     * Retunrns the test with errors
     *
     * @since version 1.0.0
     */
    public function getErrors ()
    {
        return $this->errors;
    }

    /**
     * Gets the number of passed tests
     * 
     * @return number
     * @since version 1.0.0
     */
    public function getPassedCount ()
    {
        return count($this->passed);
    }

    /**
     * Returns all passed tests
     * 
     * @return array
     * @since version 1.0.0
     */
    public function getPassed ()
    {
        return $this->passed;
    }

    /**
     * Get all not implemented tests
     * 
     * @return array
     */
    public function getNotImplemented ()
    {
        return $this->notImplemented;
    }

    /**
     * Returns the number of not implemented tests
     * 
     * @return number
     */
    public function getNotImplementedCount ()
    {
        return count($this->notImplemented);
    }

    /**
     * Returns the total number of test
     * 
     * @return integer
     */
    public function count ()
    {
        return $this->totalNuberOfTestsToRun;
    }

    /**
     * Returns the total amount of time for executing test in milisecounds
     * 
     * @return integer
     */
    public function getExecutionTime ()
    {
        return $this->executionTime;
    }

    /**
     * Returns the number of assertions performed
     * 
     * @return ineger
     */
    public function getAssertionsCount ()
    {
        return $this->assertionsCount;
    }

    /**
     * Returns whether the entire test was successful or not
     * 
     * @return boolean
     * @since version 1.0.0
     */
    public function wasSuccessful ()
    {
        return (empty($this->errors) && empty($this->failures));
    }

    public function hasWarnings ()
    {
        return (!empty($this->notImplemented) || !empty($this->skipped));
    }
}

?>