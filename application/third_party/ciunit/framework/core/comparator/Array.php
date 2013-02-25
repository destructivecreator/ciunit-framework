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
 * @subpackage Comparator
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * Compares two arrays for equality
 *
 * @package CIUnit
 * @subpackage ciunit/core
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Framework_Comparator_Array extends CIUnit_Framework_ComparatorAbstract
{

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ComparatorAbstract::accepts()
     */
    public function accepts ($expected, $actual)
    {
        return (is_array($expected) && is_array($actual));
    }

    /**
     * (non-PHPdoc)
     * 
     * @see CIUnit_Framework_ComparatorAbstract::assertEquals()
     */
    public function assertEquals ($expected, $actual, $delta = 0, 
            $canonicalize = FALSE, $ignoreCase = FALSE, array &$processedObjects = array())
    {
        if ($canonicalize) {
            sort($expected);
            sort($actual);
        }
        
        $expectedAsString = "Array (\n";
        $actualAsString = "Array (\n";
        
        $remaining = $actual;
        $areEqual = TRUE;
        
        // Loop through all keys in the expected array and compare them with the
        // keys in the actual
        foreach ($expected as $key => $value) {
            unset($remaining[$key]);
            
            // If there is no corresponding key in actual, they are not equal
            if (! array_key_exists($key, $actual)) {
                $areEqual = FALSE;
                
                $expectedAsString .= sprintf("   %s => %s\n", 
                        CIUnit_Util_Type::export($key), 
                        CIUnit_Util_Type::export($value));
                
                continue; // Continue executing the loop, but skip the code
                          // below for this iteration
            }
            
            // Try to compare array values in both arrays using the in-house
            // comparisson mechanism
            try {
                $comparator = $this->factory->getComparator($value, 
                        $actual[$key]);
                $comparator->assertEquals($value, $actual[$key], $delta, 
                        $canonicalize, $ignoreCase, $processedObjects);
                
                $expectedAsString .= sprintf("   %s => %s\n", 
                        
                        CIUnit_Util_Type::export($key), 
                        CIUnit_Util_Type::export($value));
                
                $actualAsString .= sprintf("   %s => %s\n", 
                        
                        CIUnit_Util_Type::export($key), 
                        CIUnit_Util_Type::export($actual[$key]));
            } catch (CIUnit_Framework_Exception_ComparissonFailure $e) {
                // Add $actual[$key] and $value to expectedAsString and
                // actualAsString from the exception
                
                $expectedAsString .= sprintf("   %s => %s\n", 
                        
                        CIUnit_Util_Type::export($key), 
                        $e->getExpectedAsString() ? $this->indent(
                                $e->getExpectedAsString()) : CIUnit_Util_Type::export(
                                $e->getExpected()));
                
                $actualAsString .= sprintf("   %s => %s\n", 
                        
                        CIUnit_Util_Type::export($key), 
                        $e->getExpectedAsString() ? $this->indent(
                                $e->getActualAsString()) : CIUnit_Util_Type::export(
                                $e->getActual()));
                
                $areEqual = FALSE;
            }
        }
        
        // Add all from remaining to actualAsStirng
        foreach ($remaining as $key => $value) {
            $actualAsString .= sprintf("   %s => %s\n", 
                    
                    CIUnit_Util_Type::export($key), 
                    CIUnit_Util_Type::export($value));
            
            $areEqual = FALSE;
        }
        
        $expectedAsString .= ")";
        $actualAsString .= ")";
        
        if (! $areEqual) {
            throw new CIUnit_Framework_Exception_ComparissonFailure($expected, 
                    $actual, $expectedAsString, $actualAsString, 
                    'Failed asserting that two arrays are equal.');
        }
    }

    protected function indent ($lines)
    {
        return trim(str_replace("\n", "\n    ", $lines));
    }
}

?>