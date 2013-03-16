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
 * @subpackage Framework
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * Abstract base class for constraints.
 * which are placed upon any value.
 *
 * @package CIUnit
 * @subpackage Constraint
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
abstract class CIUnit_Framework_ConstraintAbstract implements Countable
{

    /**
     * Evaluates the constraint for parameter $value
     *
     * @param mixed $value
     *            Value or Object to evaluate
     * @param string $description
     *            Additional description about the test
     * @param boolean $returnResult
     *            Return boolean or throw an exception
     * @return mixed
     * @throws CIUnit_Framework_Exception_ExpectationFailed
     */
    public function evaluate ($value, $description = '', $returnResult = FALSE)
    {
        $success = FALSE;
        
        if ($this->matches($value)) {
            $success = TRUE;
        }
        
        if ($returnResult) {
            return $success;
        }
        
        if (! $success) {
            $this->fail($value, $description);
        }
    }

    /**
     * Evaluates the constraint for parameter $value.
     * Returns TRUE if the
     * constraint is met, FALSE otherwise.
     *
     * @param mixed $value            
     * @return boolean
     */
    protected function matches ($value)
    {
        return FALSE;
    }

    /**
     * Throws an exception for the given compared value and test description
     *
     * @param mixed $value            
     * @param string $message            
     * @param CIUnit_Framework_Exception_ComparissonFailure $comparisonFailure            
     * @throws CIUnit_Framework_Exception_ExpectationFailed
     */
    protected function fail ($value = null, $message = '', 
            CIUnit_Framework_Exception_ComparissonFailure $comparisonFailure = NULL)
    {
        $failureDescription = '';
        
        if (! empty($message))
            $failureDescription .= sprintf("%s\n", $message);
        
        $failureDescription .= sprintf('Failed asserting that %s.', 
                $this->failureDescription($value));
        
        throw new CIUnit_Framework_Exception_ExpectationFailed(
                $failureDescription, $comparisonFailure);
    }

    protected function failureDescription ($evaluated)
    {
        return CIUnit_Util_Type::export($evaluated) . ' ' . $this->toString();
    }
 

    /**
     * Counts the number of constraint elements.
     *
     * @return integer
     */
    public function count ()
    {
        return 1;
    }
}

?>