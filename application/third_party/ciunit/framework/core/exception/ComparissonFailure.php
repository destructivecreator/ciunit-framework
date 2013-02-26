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
 * @subpackage core_exceptions
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * Thrown when the comparisson between two values or objects has failed
 *
 * @package CIUnit
 * @subpackage Exception
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_Exception_ComparissonFailure extends CIUnit_Framework_Exception_AssertionFailed
{

    /**
     *
     * @var mixed
     */
    protected $expected;

    /**
     *
     * @var mixed
     */
    protected $actual;

    /**
     *
     * @var string
     */
    protected $expectedAsString;

    /**
     *
     * @var string
     */
    protected $actualAsString;

    /**
     *
     * @var string
     */
    protected $message;

    /**
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param string $expectedAsString            
     * @param string $actualAsString            
     * @param string $message            
     */
    public function __construct ($expected, $actual, $expectedAsString, 
            $actualAsString, $message = '')
    {
        $this->expected = $expected;
        $this->actual = $actual;
        $this->expectedAsString = $expectedAsString;
        $this->actualAsString = $actualAsString;
        $this->message = $message;
    }

    /**
     */
    public function getExpected ()
    {
        return $this->expected;
    }

    public function getExpectedAsString ()
    {
        return $this->expectedAsString;
    }

    public function getActual ()
    {
        return $this->actual;
    }

    public function getActualAsString ()
    {
        return $this->actualAsString;
    }

    /**
     * Get the difference between the compared values as string
     * 
     * @return string
     */
    public function getDifference ()
    {
        return $this->actualAsString || $this->expectedAsString ? CIUnit_Util_Difference::getVisualDifference(
                $this->expectedAsString, $this->actualAsString) : '';
    }

    public function getFailureMessage ()
    {
        return $this->message . $this->getDifference();
    }
}
