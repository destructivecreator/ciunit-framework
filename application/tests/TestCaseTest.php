<?php
/**
 * CIUnit
 *
 * Copyright (c) 2012, Agop Seropyan <agopseropyan@gmail.com>
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
 * @subpackage test
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'Success.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'Failure.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'Error.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ExceptionInSetUpTest.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ExceptionInAssertPreConditionsTest.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ExceptionInTest.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ExceptionInAssertPostConditionsTest.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ExceptionInTearDownTest.php';

/**
 * TestCaseTest
 *
 * @package    CIUnit
 * @subpackage ciunit/core
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */
class TestCaseTest extends CIUnit_Framework_TestCase
{
    public function testCaseToString()
    {
        $this->assertEquals(
                'TestCaseTest::testCaseToString',
                $this->toString()
        );
    }
    
    public function testSuccess()
    {
        $test   = new Success;
        $result = $test->run();
    
        $this->assertEquals(0, $result->getErrorCount());
        $this->assertEquals(0, $result->getFailureCount());
        $this->assertEquals(1, count($result));
    }
    
    public function testFailure()
    {
        $test   = new Failure;
        $result = $test->run();
    
        $this->assertEquals(0, $result->getErrorCount());
        $this->assertEquals(1, $result->getFailureCount());
        $this->assertEquals(1, count($result));
    }
    
    public function testError()
    {
        $test   = new Error;
        $result = $test->run();
    
        $this->assertEquals(1, $result->getErrorCount());
        $this->assertEquals(0, $result->getFailureCount());
        $this->assertEquals(1, count($result));
    }
    
    public function testExceptionInSetUp()
    {
        $test   = new ExceptionInSetUpTest('testSomething');
        $result = $test->run();
    
        $this->assertTrue($test->setUp);
        $this->assertFalse($test->assertPreConditions);
        $this->assertFalse($test->testSomething);
        $this->assertFalse($test->assertPostConditions);
        $this->assertTrue($test->tearDown);
    }
    
    
    
    public function testExceptionInTest()
    {
        $test   = new ExceptionInTest('testSomething');
        $result = $test->run();
    
        $this->assertTrue($test->setUp); 
        $this->assertTrue($test->testSomething); 
        $this->assertTrue($test->tearDown);
    }
    
 
    
    public function testExceptionInTearDown()
    {
        $test   = new ExceptionInTearDownTest('testSomething');
        $result = $test->run();
    
        $this->assertTrue($test->setUp); 
        $this->assertTrue($test->testSomething); 
        $this->assertTrue($test->tearDown);
    }
}

