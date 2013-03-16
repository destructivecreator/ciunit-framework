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
 * Type Util implementation
 *
 * @package CIUnit
 * @subpackage Util
 * @author Agop Seropyan <agopseropyan@gmail.com>
 * @copyright 2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license http://www.opensource.org/licenses/BSD-3-Clause The BSD 3-Clause
 *          License
 * @since File available since Release 1.0.0
 */
class CIUnit_Util_Type
{

    /**
     * Exports a value into a string,.
     * using recursion
     *
     * @param mixed $value            
     * @return string
     */
    public static function export ($value)
    {
        return self::recursiveExport($value, 1);
    }

    /**
     * Recursive implementation of export
     *
     * @param mixed $value            
     * @param integer $indentation            
     * @return string
     */
    public static function recursiveExport ($value, $indentation = 0, &$processedObjects = array())
    {
        // Handle null
        if ($value === NULL) {
            return 'null';
        }
        
        // Handle boolean
        if ($value === TRUE) {
            return 'true';
        }
        
        if ($value === FALSE) {
            return 'false';
        }
        
        // Handle string
        if (is_string($value)) {
            
            return "'" .
                     str_replace(array(
                            "\r\n",
                            "\n\r",
                            "\r"
                    ), array(
                            "\n",
                            "\n",
                            "\n"
                    ), $value) . "'";
        }
        
        $originalValue = $value;
        
        // Handle objects -> convert them to array
        if (is_object($value)) {
            
            if($value instanceof Exception) {
                return "Exception Object (...)";
            }
            
            // Handle recursice objects
            if (in_array($value, $processedObjects, TRUE)) {
                return sprintf('%s Object (*RECURSION*)', 

                get_class($value));
            }
            
            $processedObjects[] = $value;
            
            // Convert object to array
            $value = self::toArray($value);
        }
        
        $content = '';
        
        // Handle array
        if (is_array($value)) {
            $whitespaces = str_repeat('    ', $indentation);
            
            // Find recursive keys in array and display Array (*RECURSION*)
            // instead of
            // calling the recursiveExport that would result in infinite loop
            
            // Regex: matches recursive keys from the ptin_r() and stores them
            // in array
            $pattern = '/\n            \[(\w+)\] => Array\s+\*RECURSION\*/';
            preg_match_all($pattern, print_r($value, TRUE), $matches);
            
            $recursiveKeys = array_unique($matches[1]);
            // Convert keys to int or string
            foreach ($recursiveKeys as $key => $recursiveKey) {
                if ((string) (integer) $recursiveKey === $recursiveKey) {
                    $recursiveKeys[$key] = (integer) $recursiveKey;
                }
            }
            
            // loop
            foreach ($value as $key => $val) {
                // Check uis key is recursive to escape infinite loops
                if (in_array($key, $recursiveKeys, TRUE)) {
                    $val = 'Array (*RECURSION*)';
                } else {
                    $val = self::recursiveExport($val, $indentation + 1, 
                            $processedObjects);
                }
                // print conternt of the aray using whitespaces for indentation
                $content .= $whitespaces . "    " . self::export($key) . " => " .
                         $val . "\n";
            }
            
            if (strlen($content) > 0) {
                $content = "\n" . $content . $whitespaces;
            }
            
            return sprintf("%s (%s)", 
                    is_object($originalValue) ? get_class($originalValue) .
                             ' Object' : 'Array', $content);
        }
        
        if (is_double($value) && (double) (integer) $value === $value) {
            return $value . '.0';
        }
        
        return (string) $value;
    }

    /**
     * Exports a value into a single-line string
     *
     * @param mixed $value            
     * @return mixed string
     */
    public static function shortExport ($value)
    {
        if (is_string($value)) {
            return self::shortenedString($value);
        }
        
        $origValue = $value;
        
        if (is_object($value)) {
            $value = self::toArray($value);
        }
        
        if (is_array($value)) {
            return sprintf("%s (%s)", 
                    
                    is_object($origValue) ? get_class($origValue) . ' Object' : 'Array', 
                    count($value) > 0 ? '...' : '');
        }
        
        return self::export($value);
    }

    /**
     * Shortens a string and converts all new lines to '\n'
     *
     * @param string $string            
     * @param integer $maxLength            
     * @return mixed
     */
    public static function shortenedString ($string, $maxLength = 40)
    {
        $string = self::export($string);
        
        if (strlen($string) > $maxLength) {
            $string = substr($string, 0, $maxLength - 10) . '...' .
                     substr($string, - 7);
        }
        
        return str_replace("\n", '\n', $string);
    }

    /**
     * Convers an object ot array
     *
     * See <a
     * href="http://de2.php.net/manual/en/language.types.array.php#language.types.array.casting">Converting
     * to array</a> for more info
     *
     * class A {
     * private $A; // This will become '\0A\0A'
     * }
     *
     * class B extends A {
     * private $A; // This will become '\0B\0A'
     * public $AA; // This will become 'AA'
     * }
     *
     * @param object $object            
     * @return array
     */
    public static function toArray ($object)
    {
        $array = array();
        foreach ((array) $object as $key => $value) {
            
            // Match class attributes only
            if (preg_match('/^\0.+\0(.+)$/', $key, $matches)) {
                $key = $matches[1];
            }
            
            $array[$key] = $value;
        }
        
        return $array;
    }
}

?>