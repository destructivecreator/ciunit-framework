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
 *
 * @package CIUnit
 * @subpackage Constraint
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_Constraint_Count extends CIUnit_Framework_ConstraintAbstract
{

    /**
     *
     * @var integer
     */
    protected $expectedCount = 0;

    /**
     *
     * @param integer $expected            
     */
    public function __construct ($expected)
    {
        $this->expectedCount = $expected;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::matches()
     */
    protected function matches ($value)
    {
        return $this->expectedCount === $this->getActualCount($value);
    }

    /**
     *
     * @param unknown_type $value            
     * @return number
     */
    protected function getActualCount ($value)
    {
        if ($value instanceof Countable || is_array($value)) {
            return count($value);
        } else 
            if ($value instanceof Iterator) {
                return iterator_count($value);
            }
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::failureDescription()
     */
    public function failureDescription ($evaluated)
    {
        return sprintf('actual size %d matches expected size %d', 
                $this->getActualCount($evaluated), $this->expectedCount);
    }

    public function toString ()
    {
        return sprintf('count matches expected %d', $this->expectedCount);
    }
}

?>