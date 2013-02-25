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
 * Class collects a failed test together with the caught exception.
 *
 * @package CIUnit
 * @subpackage Core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_TestFailure
{

    /**
     *
     * @var CIUnit_Framework_Test
     */
    protected $failedTest;

    /**
     *
     * @var Exception
     */
    protected $thrownException;

    /**
     *
     * @param
     *            CIUnit_Framework_TestInterface$failedTest
     * @param Exception $thrownException            
     */
    public function __construct (CIUnit_Framework_TestInterface $failedTest, 
            Exception $thrownException)
    {
        $this->failedTest = $failedTest;
        $this->thrownException = $thrownException;
    }

    public function getThrownException ()
    {
        return $this->thrownException;
    }

    /**
     * Returns a short description of the failure.
     *
     * @return string
     */
    public function toString ()
    {
        return sprintf("%s \n%s", $this->failedTest->toString(), 
                $this->thrownException->getMessage());
    }

    /**
     * Returns a description for the thrown exception.
     *
     * @return string
     * @since Method available since Release 3.4.0
     */
    public function getExceptionAsString ()
    {
        return self::exceptionToString($this->thrownException);
    }

    /**
     * Returns a description for an exception.
     *
     * @param Exception $e            
     * @return string
     * @since Method available since Release 3.2.0
     */
    public static function exceptionToString (Exception $e)
    {
        $buffer = get_class($e) . ': ' . $e->getMessage() . "\n";
        
        return $buffer;
    }

    /**
     * Gets the failed test.
     *
     * @return Test
     */
    public function failedTest ()
    {
        return $this->failedTest;
    }

    /**
     * Gets the thrown exception.
     *
     * @return Exception
     */
    public function thrownException ()
    {
        return $this->thrownException;
    }

    /**
     * Returns the exception's message.
     *
     * @return string
     */
    public function exceptionMessage ()
    {
        return $this->thrownException()->getMessage();
    }

    /**
     * Returns TRUE if the thrown exception
     * is of type AssertionFailedError.
     *
     * @return boolean
     */
    public function isFailure ()
    {
        return ($this->thrownException() instanceof CIUnit_Framework_Exception_AssertionFailed);
    }
}

?>