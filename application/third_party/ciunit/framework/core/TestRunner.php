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
 * @subpackage ciunit/core
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */
class CIUnit_Framework_TestRunner
{

    private $className;

    private $resultSet;

    private $testSuite;

    private $printer;

    private $presenter;
    
    private $loader;

    public function __construct ($class = '')
    {
        if ($class == '') {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 
                    'must not be NULL');
        }
        
        // Cheack and load all test cases
        CIUnit_Util_FileLoader::checkAndLoad($class);
        
        $this->className = $class;
    }

    public function run ()
    {  
        // Check class for suite method if present add suite to current suite
        try {
            $class = new ReflectionClass($this->className);
        }
        catch (ReflectionException $e) {
            throw new CIUnit_Framework_Exception_CIUnitException($e->getMessage());
        }
        
        if($class->isSubclassOf('CIUnit_Framework_TestSuite')) {
            if($class->hasMethod('suite')) { 
                 $suite = $class->getMethod('suite');
                 if(!$suite->isStatic()) {
                     throw new CIUnit_Framework_Exception_CIUnitException(sprintf('%s\'s suite method must be static', $class->getName()));
                 }
                     
                 $this->testSuite = $suite->invoke(null, array());
            }
        }
        else {
            $this->testSuite = new CIUnit_Framework_TestSuite($this->className);
        }
         
        // Create new result object
        $this->resultSet = new CIUnit_Framework_TestResult();
        
        // Pass it to the suite and execute test cases
        $this->testSuite->run($this->resultSet);
        
        // Collect the results and pass them to the presenter
        $this->presenter = new CIUnit_ResultPresenter($this->resultSet);
    }

    /**
     * Call the presentResult() method form the presenter class that has to
     * handle the way to dispaly results from test.
     * For CLI it would print them,
     * for web would return them as an array
     */
    public function getPresenter ()
    {
        return $this->presenter;
    }
    
    public function getClassName()
    {
        return $this->testSuite->getName();
    }
    
}

?>