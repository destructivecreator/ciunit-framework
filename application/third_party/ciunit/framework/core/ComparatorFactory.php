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
 * Factory for comparators
 *
 * @package CIUnit
 * @subpackage Core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_ComparatorAbstractFactory
{

    /**
     *
     * @var array
     */
    protected $comparators = array();

    /**
     *
     * @var mixed
     */
    private static $instance = NULL;

    public function __construct ()
    {
        $this->register(new CIUnit_Framework_Comparator_Type());
        $this->register(new CIUnit_Framework_Comparator_Scalar());
        $this->register(new CIUnit_Framework_Comparator_Numeric());
        $this->register(new CIUnit_Framework_Comparator_Double());
        $this->register(new CIUnit_Framework_Comparator_Array());
        $this->register(new CIUnit_Framework_Comparator_Resource());
        $this->register(new CIUnit_Framework_Comparator_Object());
        $this->register(new CIUnit_Framework_Comparator_Exception());
    }

    /**
     * Returns a factory instance, singleton
     *
     * @return mixed
     */
    public static function getInstance ()
    {
        if (self::$instance == NULL) {
            self::$instance = new CIUnit_Framework_ComparatorAbstractFactory();
        }
        
        return self::$instance;
    }

    /**
     * Returns a comparator for comparing two values
     *
     * @param mixed $expected            
     * @param mixed $actual            
     * @throws CIUnit_Framework_Exception_CIUnitException
     * @return mixed
     * @throws CIUnit_Framework_Exception_CIUnitException
     */
    public function getComparator ($expected, $actual)
    {
        foreach ($this->comparators as $comparator) {
            if ($comparator->accepts($expected, $actual)) {
                return $comparator;
            }
        }
        
        throw new CIUnit_Framework_Exception_CIUnitException(
                sprintf('No comparator found for comparing "%s" and "%s"', 
                        gettype($expected), gettype($actual)));
    }

    /**
     * Registers comparator to the factory
     * 
     * @param CIUnit_Framework_ComparatorAbstract $comparator            
     */
    public function register (CIUnit_Framework_ComparatorAbstract $comparator)
    {
        array_unshift($this->comparators, $comparator);
        $comparator->setFactory($this);
    }

    /**
     * Unregisters comparator to the factory
     * 
     * @param CIUnit_Framework_ComparatorAbstract $comparator            
     */
    public function unregister (CIUnit_Framework_ComparatorAbstract $comparator)
    {
        foreach ($this->comparators as $key => $_comparator) {
            if ($comparator === $_comparator) {
                unset($this->comparators[$key]);
            }
        }
    }
}

?>