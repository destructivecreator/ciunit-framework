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
 * @since      File available since Version 1.0.0
 */

/**
 * A set of assert methods.
 *
 * @package CIUnit
 * @subpackage Core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
abstract class CIUnit_Framework_Assert
{

    /**
     * Total number of assertions used
     *
     * @var integer
     */
    private static $assertionCount = 0;

    /**
     * Assert that array has a specified key
     *
     * @param mixed $key            
     * @param array $array            
     * @param string $message            
     * @throws CIUnit_Framework_Exception_InvalidArgument
     * @since version 1.0.0
     */
    public static function assertArrayHasKey ($key, $array, $message = '')
    {
        if (! (is_numeric($key) || is_string($key))) {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 
                    'integer or string');
        }
        
        if (! (is_array($array) || ($array instanceof ArrayAccess))) {
            throw new CIUnit_Framework_Exception_InvalidArgument(2, 
                    'array or arrayAccess');
        }
        
        $constraint = new CIUnit_Framework_Constraint_ArrayHasKey($key);
        self::assertThat($array, $constraint, $message);
    }

    /**
     * Assert that array does not have a specified key
     *
     * @param mixed $key            
     * @param array $array            
     * @param string $message            
     * @throws CIUnit_Framework_Exception_InvalidArgument
     * @since version 1.0.0
     */
    public static function assertArrayNotHasKey ($key, $array, $message = '')
    {
        if (! (is_numeric($key) || is_string($key))) {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 
                    'integer or string');
        }
        
        if (! (is_array($array) || ($array instanceof ArrayAccess))) {
            throw new CIUnit_Framework_Exception_InvalidArgument(2, 
                    'array or ArrayAccess');
        }
        
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_ArrayHasKey($key));
        self::assertThat($array, $constraint, $message);
    }

    /**
     * Asserts the number of elements of an array, Countable or Iterator
     *
     * @param integer $expectedCount            
     * @param
     *            array or ArrayAccess $haystack
     * @param string $message            
     * @throws CIUnit_Framework_Exception_InvalidArgument
     */
    public static function assertCount ($expectedCount, $haystack, $message = '')
    {
        if (! is_numeric($expectedCount)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 'integer');
        }
        
        if (! (is_array($haystack) || $haystack instanceof ArrayAccess)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(2, 
                    'array or ArrayAccess');
        }
        
        $constraint = new CIUnit_Framework_Constraint_Count(
                $expectedCount);
        self::assertThat($haystack, $constraint, $message);
    }

    /**
     * Asserts that a variable is empty
     *
     * @param midex $actual            
     * @param string $message            
     */
    public static function assertEmpty ($actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_IsEmpty($actual);
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that a variable is not empty
     *
     * @param midex $actual            
     * @param string $message            
     */
    public static function assertNotEmpty ($actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_IsEmpty());
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that a condition is true
     *
     * @param boolean $expected            
     * @param string $message            
     */
    public static function assertTrue ($expected, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_IsTrue();
        self::assertThat($expected, $constraint, $message);
    }

    /**
     * Asserts that a condition is false
     *
     * @param boolean $expected            
     * @param string $message            
     */
    public static function assertFalse ($expected, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_IsFalse();
        self::assertThat($expected, $constraint, $message);
    }

    /**
     * Asserts that a variable is of a given type
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param string $message            
     */
    public static function assertInstanceOf ($expected, $actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_IsInstanceOf(
                $expected);
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that a variable is not of a given type
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param string $message            
     */
    public static function assertNotInstanceOf ($expected, $actual, 
            $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_IsInstanceOf($expected));
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that a variable is NULL
     *
     * @param mixed $actual            
     * @param string $message            
     */
    public static function assertNull ($actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_isNull();
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that a variable is not NULL
     *
     * @param mixed $actual            
     * @param string $message            
     */
    public static function assertNotNull ($actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_isNull());
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Assert that variable is of a given type
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param string $message            
     */
    public static function assertInternalType ($expected, $actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_IsType($expected);
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Assert that variable is not of a given type
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param string $message            
     */
    public static function assertNotInternalType ($expected, $actual, 
            $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_IsType($expected));
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Assert that the size of two arrays (or `Countable` or `Iterator` objects)
     * is the same
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param String $message            
     * @throws CIUnit_Framework_Exception_InvalidArgument
     */
    public static function assertSameSize ($expected, $actual, $message = '')
    {
        if (! $expected instanceof Countable && ! $expected instanceof Iterator &&
                 ! is_array($expected)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 'countable');
        }
        
        if (! $actual instanceof Countable && ! $actual instanceof Iterator &&
                 ! is_array($actual)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(2, 'countable');
        }
        
        $constraint = new CIUnit_Framework_Constraint_SameSize($expected);
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Assert that the size of two arrays (or `Countable` or `Iterator` objects)
     * is not the same
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @param String $message            
     * @throws CIUnit_Framework_Exception_InvalidArgument
     */
    public static function assertNotSameSize ($expected, $actual, $message = '')
    {
        if (! $expected instanceof Countable && ! $expected instanceof Iterator &&
                 ! is_array($expected)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(1, 'countable');
        }
        
        if (! $actual instanceof Countable && ! $actual instanceof Iterator &&
                 ! is_array($actual)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(2, 'countable');
        }
        
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_SameSize($expected));
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are equal
     * 
     * @param mixed $expected            
     * @param mixed $actual            
     * @param numeric $delta            
     * @param boolean $canonicalize            
     * @param boolean $ignoreCase            
     * @param string $message            
     */
    public static function assertEquals ($expected, $actual, $delta = 0, 
            $canonicalize = FALSE, $ignoreCase = FALSE, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_IsEqual($expected, 
                $delta, $canonicalize, $ignoreCase);
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that two variables are not equal
     * 
     * @param mixed $expected            
     * @param mixed $actual            
     * @param numeric $delta            
     * @param boolean $canonicalize            
     * @param boolean $ignoreCase            
     * @param string $message            
     */
    public static function assertNotEquals ($expected, $actual, $delta = 0, 
            $canonicalize = FALSE, $ignoreCase = FALSE, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_Not(
                new CIUnit_Framework_Constraint_IsEqual($expected, 
                        $delta, $canonicalize, $ignoreCase));
        self::assertThat($actual, $constraint, $message);
    }
    
    /**
     * Asserts that a value is greater than another value
     * 
     * @param mixed $expected
     * @param mixed $actual
     * @param string $message
     */
    public static function assertGreaterThan($expected, $actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_GreaterThan($expected);
        self::assertThat($actual, $constraint, $message);
    }

    /**
     * Asserts that a value is greater than or equal to another value
     * 
     * @param mixed $expected
     * @param mixed $actual
     * @param string $message
     */
    public static function assertGreaterThanOrEqual($expected, $actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_GreaterThanOrEqual($expected);
        self::assertThat($actual, $constraint, $message);
    }
    
    /**
     * Asserts that a value is less than another value
     * 
     * @param mixed $expected
     * @param mixed $actual
     * @param string $message
     */
    public static function assertLessThan($expected, $actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_LessThan($expected);
        self::assertThat($actual, $constraint, $message);
    }
    
    /**
     * Asserts that a value is less than or equal to another value
     *
     * @param mixed $expected
     * @param mixed $actual
     * @param string $message
     */
    public static function assertLessThanOrEqual($expected, $actual, $message = '')
    {
        $constraint = new CIUnit_Framework_Constraint_LessThanOrEqual($expected);
        self::assertThat($actual, $constraint, $message);
    }
    
    /**
     *
     * @param mixed $value            
     * @param CIUnit_Framework_ConstraintAbstract $constraint            
     * @param string $message            
     * @since version 1.0.0
     */
    public static function assertThat ($value, 
            CIUnit_Framework_ConstraintAbstract $constraint, $message = '')
    {
        self::$assertionCount += count($constraint);
        $constraint->evaluate($value, $message);
    }

    /**
     * Retrieve the total number of assertions made
     *
     * @return number
     * @since version 1.0.0
     */
    public static function getAssertionCount ()
    {
        return self::$assertionCount;
    }

    /**
     * Reset number of assertions to 0
     *
     * @since version 1.0.0
     */
    public static function resetAssertionCount ()
    {
        self::$assertionCount = 0;
    }

    /**
     * Fails a test with the given message.
     *
     * @param string $message            
     * @throws CIUnit_Framework_Exception_AssertionFailed
     * @since version 1.0.0
     */
    public function fail ($message = '')
    {
        throw new CIUnit_Framework_Exception_AssertionFailed($message);
    }

    /**
     * Mark test as skipped
     *
     * @param string $message            
     * @throws CIUnit_Framework_Exception_SkippedTest
     */
    public function skip ($message = '')
    {
        throw new CIUnit_Framework_Exception_SkippedTest($message);
    }
}

?>