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
 * @subpackage Util
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * Difference implementation
 *
 * @package CIUnit
 * @subpackage Util
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Util_Difference
{

    const UNCHANGED = 0;

    const ADDED = 1;

    const REMOVED = 2;

    const ADDED_CHAR = '+';

    const REMOVED_CHAR = '-';

    const UNCHANGED_CHAR = ' ';

    /**
     * Return the difference between two arrays as string
     *
     * @param array $expected            
     * @param array $actual            
     * @return string
     */
    public static function getVisualDifference ($expected, $actual)
    {
        $visual = "\n\n- Expected \n+ Actual \n\n";
        $diff = self::makeDifferenceToArray($expected, $actual);
        
        // print_r($diff);
        
        $diffLength = count($diff);
        
        for ($i = 0; $i < $diffLength; $i ++) {
            // Add unchanged to buffer
            if ($diff[$i][1] === self::UNCHANGED) {
                $visual .= self::UNCHANGED_CHAR . $diff[$i][0] . "\n";
            }             // Add added to buffer
            else 
                if ($diff[$i][1] === self::ADDED) {
                    $visual .= self::ADDED_CHAR . $diff[$i][0] . "\n";
                }                 // Add removed to buffer
                else 
                    if ($diff[$i][1] === self::REMOVED) {
                        $visual .= self::REMOVED_CHAR . $diff[$i][0] . "\n";
                    }
        }
        
        return $visual;
    }

    /**
     * Show the difference between two arrays using LCS
     *
     * @param array $expected            
     * @param array $actual            
     * @return array:
     */
    public static function makeDifferenceToArray ($expected, $actual)
    {
        // Remove all line breaks from expected and actual strings
        // each OS have different ASCII chars for linebreak: 
        // windows = \r\n 
        // unix = \n 
        // mac = \r 
        
        if (is_string($expected)) {
            $expected = preg_split('(\r\n|\r|\n)', $expected);
        }
        
        if (is_string($actual)) {
            $actual = preg_split('(\r\n|\r|\n)', $actual);
        }
        
        $beginning = $end = array();
        
        $expLength = count($expected);
        $actLength = count($actual);
        $minLength = min($expLength, $actLength);
        
        // Collect matching elements starting from the beginning
        for ($i = 0; $i < $minLength; $i ++) {
            if ($expected[$i] === $actual[$i]) {
                array_push($beginning, $expected[$i]);
                unset($expected[$i], $actual[$i]);
            } else {
                break;
            }
        }
        
        // Different elements have been found 
        $currLength = $minLength - $i;
        

        // Collect matching elements starting from the end
        for ($i = $minLength; $i < $currLength; $i --) {
            if ($expected[$i] === $actual[$i]) {
                array_push($end, $expected[$i]);
                unset($expected[$i], $actual[$i]);
            } else {
                break;
            }
        }
        
        $lcs = self::findLCS(array_values($expected), array_values($actual));
        $diff = array();
        
        // Add all identical items from the beginning into an array of
        // difference
        // Follow the pattern array(element, 0);
        foreach ($beginning as $element) {
            array_push($diff, array(
                    $element,
                    self::UNCHANGED
            ));
        }
        
        // Set the internal pointer of both expected and actuak to their first
        // element
        reset($expected);
        reset($actual);
        
        // Itterate over the $lcs array and workout the differences there
        foreach ($lcs as $element) {
            // loop over expected and compare elements with the element
            while (($expNext = reset($expected)) !== $element) {
                array_push($diff, array(
                        array_shift($expected),
                        self::REMOVED
                ));
            }
            
            while (($actNext = reset($actual)) !== $element) {
                array_push($diff, array(
                        array_shift($actual),
                        self::ADDED
                ));
            }
            
            array_push($diff, array(
                    $element,
                    self::UNCHANGED
            ));
            
            array_shift($expected);
            array_shift($actual);
        }
        
        while (($element = array_shift($expected)) != NULL) {
            array_push($diff, array(
                    $element,
                    self::REMOVED
            ));
        }
        
        while (($element = array_shift($actual)) != NULL) {
            array_push($diff, array(
                    $element,
                    self::ADDED
            ));
        }
        
        foreach ($end as $element) {
            array_push($diff, array(
                    $element,
                    self::UNCHANGED
            ));
        }
        
        return $diff;
    }

    /**
     * Returns the longest common subsequence of the given arrays.
     *
     * See http://en.wikipedia.org/wiki/Longest_common_subsequence_problem
     *
     * @param array $left            
     * @param array $right            
     *
     * @return array The longest common subsequence.
     */
    public static function findLCS (array $left, array $right)
    {
        $lcs = array();
        $matrix = array();
        
        $leftLength = count($left);
        $rightLength = count($right);
        
        // Create the matrix
        for ($i = 0; $i <= $leftLength; $i ++) {
            $matrix[$i][0] = 0;
        }
        
        for ($j = 0; $j <= $rightLength; $j ++) {
            $matrix[0][$j] = 0;
        }
        
        // Completed LCS Table
        for ($i = 1; $i <= $leftLength; $i ++) {
            for ($j = 1; $j <= $rightLength; $j ++) {
                // if($left[$i] !== $right[$i]) {
                $matrix[$i][$j] = max($matrix[$i - 1][$j], $matrix[$i][$j - 1], 
                        ($left[$i - 1] === $right[$j - 1]) ? $matrix[$i - 1][$j -
                                 1] + 1 : 0);
                // }
            }
        }
        
        // recover LCS itself
        $i = $leftLength;
        $j = $rightLength;
        
        // Traceback approach
        while ($i > 0 && $j > 0) {
            if ($left[$i - 1] === $right[$j - 1]) {
                array_unshift($lcs, $left[$i - 1]);
                -- $i;
                -- $j;
            } 

            else 
                if ($matrix[$i][$j - 1] > $matrix[$i - 1][$j]) {
                    -- $j;
                } 

                else {
                    -- $i;
                }
        }
        
        return $lcs;
    }
}

?>