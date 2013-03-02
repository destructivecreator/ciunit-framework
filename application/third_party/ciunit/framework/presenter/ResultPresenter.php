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
 * @subpackage Printer
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */
class CIUnit_ResultPresenter
{
    
    // Change protected to private
    protected $result;

    public function __construct (CIUnit_Framework_TestResult $result)
    {
        if (NULL == $result)
            throw new CIUnit_Framework_Exception_CIUnitException(
                    "Result can not be null");
        
        $this->result = $result;
    }

    /**
     * Function creates the header of the presenter
     * @return string
     */
    public function getHeader ()
    {
        return sprintf(
                "Tests: %d, Assertions: %d, Failures: %d, Errors: %d, Ignored: %d, Incomplete: %d, Time: %f seconds, Memory: %s \n", 
                $this->result->count(), $this->result->getAssertionsCount(), 
                $this->result->getFailureCount(), $this->result->getErrorCount(), 
                $this->result->getSkippedCount(), 
                $this->result->getNotImplementedCount(), 
                CIUnit_Util_Timer::secondsToTimeString(
                        $this->result->getExecutionTime()), 
                CIUnit_Util_Memory::getUsedMemory());
    }

    /**
     * Function creates the footer of the presenter
     */
    public function getFooter ()
    {}

    /**
     * @see CIUnit_Framework_TestResult::wasSuccessful()
     */
    public function wasSuccessful ()
    {
        return $this->result->wasSuccessful();
    }
    
    /**
     * @see CIUnit_Framework_TestResult::hasWarnings()
     */
    public function hasWarnings()
    {
        return $this->result->hasWarnings();
    }

    /**
     *
     * @param CIUnit_Framework_TestResult $result            
     */
    public function getErrors ()
    {
        return $this->getDefects($this->result->getErrors(), 
                $this->result->getErrorCount());
    }

    /**
     *
     * @param CIUnit_Framework_TestResult $result            
     */
    public function getFailures ()
    {
        return $this->getDefects($this->result->getFailures(), 
                $this->result->getFailureCount());
    }

    /**
     *
     * @param CIUnit_Framework_TestResult $result            
     */
    public function getIncompletes ()
    {
        return $this->getDefects($this->result->getNotImplemented(), 
                $this->result->getNotImplementedCount());
    }

    /**
     *
     * @param CIUnit_Framework_TestResult $result            
     */
    public function getSkipped ()
    {
        return $this->getDefects($this->result->getSkipped(), 
                $this->result->getSkippedCount());
    }

    protected function getDefects (array $defects, $count)
    {
        $i = 1;
        $defectsArray = array();
        foreach ($defects as $defect) {
            array_push($defectsArray, $this->getDefect($defect, $i ++));
        }
        
        return $defectsArray;
    }

    protected function getDefect (CIUnit_Framework_TestFailure $test, $count)
    {
        $defect = array();
        // Print header
        $defect['header'] = $this->getDefectHeader($test, $count);
        // Print trace
        $defect['trace'] = $this->getDefectTrace($test);
        
        return $defect;
    }

    protected function getDefectHeader (CIUnit_Framework_TestFailure $defect, 
            $count)
    {
        $failedTest = $defect->failedTest();
        $testName = get_class($failedTest);
        
        return sprintf("\n%d) %s::%s\n", $count, $testName, 
                $failedTest->getName());
    }

    protected function getDefectTrace (CIUnit_Framework_TestFailure $defect)
    {
        $e = $defect->getThrownException();
        
        $eTrace = $e->getTrace();
 
        $trace = "";
        // Iterate over trace stack, depth of 6 should be enough
        for($i=0; $i<6; $i++) {
            // Filter the exception trace
            if(isset($eTrace[$i]['file']) && isset($eTrace[$i]['line'])) {
                // Exclude all framework files form trace
                if(!preg_match("/^.*\/ciunit\/framework\/core/", $eTrace[$i]['file'])) {
                    $trace .= sprintf("\n# %s at line %s", $eTrace[$i]['file'], $eTrace[$i]['line']);
                }
            }
        }
        
        return sprintf("%s %s", $e->getMessage(), $trace);
    }
}

?>