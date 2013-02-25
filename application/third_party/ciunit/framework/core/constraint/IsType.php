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
 * Constraint that asserts that the value it is evaluated for is form a given
 * type.
 *
 * @package CIUnit
 * @subpackage Constraint
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_Constraint_IsType extends CIUnit_Framework_ConstraintAbstract
{
    
    // Define the supported types
    const T_ARRAY = 'array';

    const T_STRING = 'string';

    const T_FLOAT = 'float';

    const T_INTEGER = 'integer';

    const T_INT = 'int';

    const T_NUMERIC = 'numeric';

    const T_SCALAR = 'scalar';

    const T_NULL = 'null';

    const T_OBJECT = 'object';

    /**
     *
     * @var array
     */
    private $types = array(
            'array',
            'string',
            'float',
            'integer',
            'numeric',
            'scalar',
            'null',
            'object',
            'int'
    );

    /**
     *
     * @var string
     */
    protected $type;

    public function __construct ($type)
    {
        if (! in_array($type, $this->types)) {
            throw new CIUnit_Framework_Exception_CIUnitException(
                    sprintf('%s is not supported type in CIUnit', $type));
        }
        
        $this->type = $type;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::matches()
     */
    protected function matches ($value)
    {
        switch ($this->type) {
            case self::T_ARRAY:
                return is_array($value);
            
            case self::T_INTEGER:
            case self::T_INT:
                return is_integer($value);
            
            case self::T_SCALAR:
                return is_scalar($value);
            
            case self::T_FLOAT:
                return is_float($value);
            
            case self::T_NUMERIC:
                return is_numeric($value);
            
            case self::T_STRING:
                return is_string($value);
            
            case self::T_NULL:
                return is_null($value);
            
            case self::T_OBJECT:
                return is_object($value);
        }
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ConstraintAbstract::failureDescription()
     */
    public function failureDescription ($evaluated)
    {
        return sprintf('%s is of type "%s"', 
                CIUnit_Util_Type::export($evaluated), $this->type);
    }

    public function toString ()
    {
        return sprintf('is of type "%s"', $this->type);
    }
}

?>