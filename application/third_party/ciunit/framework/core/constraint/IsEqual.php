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
 * @subpackage Constraint
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * Constraint that asserts that the value or object it is evaluated for is equal
 * to another value or object.
 *
 * @package CIUnit
 * @subpackage Constraint
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_Constraint_IsEqual extends CIUnit_Framework_ConstraintAbstract
{

    /**
     * Value or object to evaluate against
     * 
     * @var mixed
     */
    protected $expected;

    /**
     *
     * @var boolean
     */
    protected $canonicalize = FALSE;

    /**
     *
     * @var boolean
     */
    protected $ignoreCase = FALSE;

    /**
     *
     * @var double
     */
    protected $delta;

    /**
     *
     * @param mixed $expected            
     * @param double $delta            
     * @param boolean $canonicalize            
     * @param boolean $ignoreCase            
     * @throws CIUnit_Framework_Exception_InvalidArgument
     */
    public function __construct ($expected, $delta = 0, $canonicalize = FALSE, 
            $ignoreCase = FALSE)
    {
        if (! is_bool($canonicalize)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(3, 'boolean');
        }
        
        if (! is_bool($ignoreCase)) {
            throw new CIUnit_Framework_Exception_InvalidArgument(4, 'boolean');
        }
        
        $this->expected = $expected;
        $this->canonicalize = $canonicalize;
        $this->ignoreCase = $ignoreCase;
        $this->delta = $delta;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::evaluate()
     */
    public function evaluate ($value, $description = '', $returnResult = FALSE)
    {
        $factory = CIUnit_Framework_ComparatorAbstractFactory::getInstance();
        
        try {
            $comparator = $factory->getComparator($value, $this->expected);
            $comparator->assertEquals($this->expected, $value, $this->delta);
        } catch (CIUnit_Framework_Exception_ComparissonFailure $e) {
            if ($returnResult) {
                return FALSE;
            }
            
            throw new CIUnit_Framework_Exception_ExpectationFailed(
                    trim($description . "\n" . $e->getFailureMessage()), $e);
        }
        
        return TRUE;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::failureDescription()
     */
    public function failureDescription ($evaluated)
    {
        return sprintf('%s is equal to %s', 
                CIUnit_Util_Type::shortExport($evaluated), 
                CIUnit_Util_Type::shortExport($this->expected));
    }

    public function toString ()
    {
        return sprintf('is equal to %s', 
                CIUnit_Util_Type::export($this->expected));
    }
}

?>