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
 * @subpackage ciunit
 * @author     Agop Seropyan <agopseropyan@gmail.com>
 * @copyright  2012, Agop Seropyan <agopseropyan@gmail.com>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @since      File available since Release 1.0.0
 */

/**
 * Used for autoloading CIUnit classes
 */
  
function ciunit_autoloader($class)
{
    static $classes = NULL;
    static $path = NULL;

    if ($classes === NULL) {
        $classes = array(
                // core
                'ciunit_framework_assert' => '/core/Assert.php',
                'ciunit_framework_constraintabstract' => '/core/Constraint.php',
                'ciunit_framework_testinterface' => '/core/Test.php',
                'ciunit_framework_testcase' => '/core/TestCase.php',
                'ciunit_framework_testresult' => '/core/TestResult.php',
                'ciunit_framework_testsuite' => '/core/TestSuite.php',
                'ciunit_framework_testfailure' => '/core/TestFailure.php',
                'ciunit_framework_testsuccess' => '/core/TestSuccess.php',
                'ciunit_framework_testrunner' => '/core/TestRunner.php',
                'ciunit_framework_testwarning' => '/core/TestWarning.php',
                'ciunit_framework_comparatorabstract' => '/core/Comparator.php',
                'ciunit_framework_comparatorabstractfactory' => '/core/ComparatorFactory.php',

                // constraint
                'ciunit_framework_constraint_arrayhaskey'                  => '/core/constraint/ArrayHasKey.php',
                'ciunit_framework_constraint_not'                          => '/core/constraint/Not.php',
                'ciunit_framework_constraint_exception'                    => '/core/constraint/Exception.php',
                'ciunit_framework_constraint_exceptioncode'                => '/core/constraint/ExceptionCode.php',
                'ciunit_framework_constraint_exceptionmessage'             => '/core/constraint/ExceptionMessage.php',
                'ciunit_framework_constraint_count'                        => '/core/constraint/Count.php',
                'ciunit_framework_constraint_isempty'                      => '/core/constraint/IsEmpty.php',
                'ciunit_framework_constraint_istrue'                       => '/core/constraint/IsTrue.php',
                'ciunit_framework_constraint_isfalse'                      => '/core/constraint/IsFalse.php',
                'ciunit_framework_constraint_isinstanceof'                 => '/core/constraint/IsInstanceOf.php',
                'ciunit_framework_constraint_isnull'                       => '/core/constraint/IsNull.php',
                'ciunit_framework_constraint_istype'                       => '/core/constraint/IsType.php',
                'ciunit_framework_constraint_samesize'                     => '/core/constraint/SameSize.php',
                'ciunit_framework_constraint_isequal'                      => '/core/constraint/IsEqual.php',
                'ciunit_framework_constraint_greaterthan'                  => '/core/constraint/GreaterThan.php',
                'ciunit_framework_constraint_greaterthanorequal'           => '/core/constraint/GreaterThanOrEqual.php',
                'ciunit_framework_constraint_lessthan'                     => '/core/constraint/LessThan.php',
                'ciunit_framework_constraint_lessthanorequal'              => '/core/constraint/LessThanOrEqual.php',
                'ciunit_framework_constraint_stringstartswith'             => '/core/constraint/StringStartsWith.php',
                'ciunit_framework_constraint_stringendswith'               => '/core/constraint/StringEndsWith.php',
                'ciunit_framework_constraint_stringmatchesregex'           => '/core/constraint/StringMatchesRegex.php',
                'ciunit_framework_constraint_classhasattribute'            => '/core/constraint/ClassHasAttribute.php',
                'ciunit_framework_constraint_classhasstaticattribute'      => '/core/constraint/ClassHasStaticAttribute.php',
                'ciunit_framework_constraint_objecthasattribute'           => '/core/constraint/ObjectHasAttribute.php',
                'ciunit_framework_constraint_objecthasstaticattribute'     => '/core/constraint/ObjectHasStaticAttribute.php',

                // comparator
                'ciunit_framework_comparator_type' => '/core/comparator/Type.php',
                'ciunit_framework_comparator_scalar' => '/core/comparator/Scalar.php',
                'ciunit_framework_comparator_numeric' => '/core/comparator/Numeric.php',
                'ciunit_framework_comparator_double' => '/core/comparator/Double.php',
                'ciunit_framework_comparator_array' => '/core/comparator/Array.php',
                'ciunit_framework_comparator_resource' => '/core/comparator/Resource.php',
                'ciunit_framework_comparator_object' => '/core/comparator/Object.php',
                'ciunit_framework_comparator_exception' => '/core/comparator/Exception.php',

                // exception
                'ciunit_framework_exception_invalidargument' => '/core/exception/InvalidArgument.php',
                'ciunit_framework_exception_assertionfailed' => '/core/exception/AssertionFailed.php',
                'ciunit_framework_exception_comparissonfailure' => '/core/exception/ComparissonFailure.php',
                'ciunit_framework_exception_ciunitexception' => '/core/exception/Exception.php',
                'ciunit_framework_exception_incompletetest' => '/core/exception/IncompleteTest.php',
                'ciunit_framework_exception_skippedtest' => '/core/exception/SkippedTest.php',
                'ciunit_framework_exception_expectationfailed' => '/core/exception/ExpectationFailed.php',

                // util
                'ciunit_util_timer' => '/util/Timer.php',
                'ciunit_util_memory' => '/util/Memory.php',
                'ciunit_util_type' => '/util/Type.php',
                'ciunit_util_difference' => '/util/Difference.php',
                'ciunit_util_fileloader' => '/util/FileLoader.php',

                // printer
                'ciunit_resultpresenter' => '/presenter/ResultPresenter.php'
        );

        $path = dirname(__FILE__);
    }

    $cn = strtolower($class);

    if (isset($classes[$cn])) {
        require $path . $classes[$cn];
    }
}


spl_autoload_register('ciunit_autoloader');