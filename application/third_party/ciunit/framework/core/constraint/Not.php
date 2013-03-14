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
 * Constraint that asserts that the value or object it is evaluated for is NOT
 * what the constraint asserts.
 *
 * @package CIUnit
 * @subpackage Constraint
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_Constraint_Not extends CIUnit_Framework_ConstraintAbstract
{

    /**
     *
     * @var string
     */
    protected $constraint;

    /**
     *
     * @param string $constraint            
     */
    public function __construct ($constraint)
    {
        if ($constraint instanceof CIUnit_Framework_ConstraintAbstract)
            $this->constraint = $constraint;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::evaluate()
     */
    public function evaluate ($value, $description = '', $returnResult = FALSE)
    {
        $success = ! $this->constraint->evaluate($value, $description, TRUE);
        
        if ($returnResult) {
            return $success;
        }
        
        if (! $success) {
            $this->fail($value, $description);
        }
    }

    /**
     * Convert possitive verbs from failure description into negative
     *
     * @param string $string            
     * @return mixed
     */
    private function negate ($string)
    {
        // Convert constraint failureDescription() to match NOT
        $possitive = array(
                'has ',
                'matches ',
                'is ',
                'starts ',
                'ends ',
        );
        $negative = array(
                'does not have ',
                'does not match ',
                'is not ',
                'does not start ',
                'does not end ',
        );
        
     $count = count($possitive);
       
       for($i=0; $i<$count; $i++) {
           $string = self::str_replace_outside_quotes($possitive[$i], $negative[$i], $string);
       }
       
       return $string;
    }
    
    /**
     * Method to replace stuff that is outside of single and double quotes
     * 
     * @param string $replace
     * @param string $with
     * @param string $string
     * @return string
     */
    public static function str_replace_outside_quotes($replace,$with,$string)
    {
        $buffer = "";
        // Split by quoted text
        $replaceable = preg_split('/("[^"]*"|\'[^\']*\')/',$string,-1,PREG_SPLIT_DELIM_CAPTURE);
        
        while (!empty($replaceable)) {
            // buffer = replaceable + notreplaceable
            $buffer .= str_replace($replace,$with,array_shift($replaceable)) . array_shift($replaceable);
        }
        
        return $buffer;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::failureDescription()
     */
    public function failureDescription ($evaluated)
    {
        return $this->negate($this->constraint->failureDescription($evaluated));
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::count()
     */
    public function count ()
    {
        return count($this->constraint);
    }

    public function toString ()
    {
        return $this->negate($this->constraint->toString());
    }
}
