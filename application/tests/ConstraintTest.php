<?php
 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'TestIterator.php';
 
/**
 * Constraint test case.
 */
 class ConstraintTest extends CIUnit_Framework_TestCase
{
    /** 
     * @covers CIUnit_Framework_Constraint_ArrayHasKey
     * @covers CIUnit_Assert::arrayHasKey 
     * @covers CIUnit_Framework_Constraint::count
     * @covers CIUnit_Exception::toString
     */
    public function testConstraintArrayHasKey()
    { 
        $constraint = new CIUnit_Framework_Constraint_ArrayHasKey(0);
        
        $this->assertFalse($constraint->evaluate(array(), '', TRUE));
        $this->assertEquals(1, $constraint->count());
        $this->assertEquals("has the key 0", $constraint->toString());
        
        try{
            $constraint->evaluate(array());
        }
        catch(CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that an array has the key 0.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_ArrayHasKey
     * @covers CIUnit_Assert::arrayHasKey  
     * @covers CIUnit_Exception::toString
     */
    public function testConstraintArrayHasKeyWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_ArrayHasKey(0);
        
        try{
            $constraint->evaluate(array(), 'custom message');
        }
        catch(CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that an array has the key 0.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_ArrayHasKey
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Assert::arrayHasKey 
     * @covers CIUnit_Framework_Constraint::count
     * @covers CIUnit_Exception::toString
     */
    public function testConstraintArrayNotHasKey()
    {
        $constraint = new CIUnit_Framework_Constraint_ArrayHasKey(0);
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
        
        $this->assertFalse($notConstraint->evaluate(array(1), '', TRUE));
        $this->assertEquals(1, $notConstraint->count());
        $this->assertEquals("does not have the key 0", $notConstraint->toString());
        
        try {
            $notConstraint->evaluate(array(1));
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that an array does not have the key 0.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
     
    /**
     * @covers CIUnit_Framework_Constraint_ArrayHasKey
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Assert::arrayHasKey
     * @covers CIUnit_Exception::toString
     */
    public function testConstraintArrayNotHasKeyWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_ArrayHasKey(0);
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
    
        try{
            $notConstraint->evaluate(array(1), 'custom message');
        }
        catch(CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that an array does not have the key 0.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_Count 
     */
    public function testConstraintCountWithArray()
    {
        $constraint = new CIUnit_Framework_Constraint_Count(3);
        
        $this->assertTrue($constraint->evaluate(array(1,2,3), '', TRUE));
        $this->assertFalse($constraint->evaluate(array(1,2), '', TRUE));
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_Count
     */
    public function testConstraintCountWithAnObjectImplementingCountable()
    {
        $constraint = new CIUnit_Framework_Constraint_Count(5);
    
        $this->assertTrue($constraint->evaluate(new ArrayObject(array(1,2,3,4,5)), '', TRUE));
        $this->assertFalse($constraint->evaluate(new ArrayObject(array(1,2,3,4)), '', TRUE));
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_Count
     */
    public function testConstraintCountWithAnIteratorWhichDoesNotImplementCountable()
    {
        $constraint = new CIUnit_Framework_Constraint_Count(5);

        $this->assertTrue($constraint->evaluate(new TestIterator(array(1,2,3,4,5)), '', TRUE));
        $this->assertFalse($constraint->evaluate(new TestIterator(array(1,2,3,4)), '', TRUE));
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_Count
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintCountFailure()
    {
        $constraint = new CIUnit_Framework_Constraint_Count(5);
        
        try {
            $constraint->evaluate(array(1,2,3));
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that actual size 3 matches expected size 5.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_Count
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintNotCountFailure()
    {
        $constraint = new CIUnit_Framework_Constraint_Count(5);
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
    
        try {
            $notConstraint->evaluate(array(1,2,3,4,5));
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that actual size 5 does not match expected size 5.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEmpty
     * @covers CIUnit_Framework_Constraint_IsEmpty::count
     * @covers CIUnit_Framework_Constraint_IsEmpty::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsEmpty()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEmpty();
        
        $this->assertTrue($constraint->evaluate(array(), '', TRUE));
        $this->assertFalse($constraint->evaluate(array('item'), '', TRUE));
        $this->assertEquals(1, $constraint->count());
        $this->assertEquals("is empty", $constraint->toString());
        
        try{
            $constraint->evaluate(array(1,2));
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that an array is empty.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEmpty
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsEmptyWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEmpty(); 
    
        try{
            $constraint->evaluate(array(1,2), 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that an array is empty.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEmpty
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Framework_Constraint_IsEmpty::count
     * @covers CIUnit_Framework_Constraint_IsEmpty::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintNotIsEmpty()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEmpty();
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
    
        $this->assertFalse($notConstraint->evaluate(array(), '', TRUE));
        $this->assertTrue($notConstraint->evaluate(array('item'), '', TRUE));
        $this->assertEquals(1, $notConstraint->count());
        $this->assertEquals("is not empty", $notConstraint->toString());
    
        try{
            $notConstraint->evaluate(array());
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that an array is not empty.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEmpty
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsNotEmptyWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEmpty();
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
    
        try{
            $notConstraint->evaluate(array(), 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that an array is not empty.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEqual 
     * @covers CIUnit_Framework_Constraint_IsEqual::count
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsEqual()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEqual(1);
    
        $this->assertTrue($constraint->evaluate(1, '', TRUE));
        $this->assertFalse($constraint->evaluate(0, '', TRUE));
        $this->assertEquals('is equal to 1', $constraint->toString());
        $this->assertEquals(1, count($constraint));
    
        try {
            $constraint->evaluate(0);
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that 0 matches expected 1." ,  $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
//     /**
//      * Data provider for running test sequence on IsEqual Constraint
//      * 
//      * @return array
//      */
//     public function isEqualProvider()
//     {
//         // Declare attributes
//         $objA = new stdClass();
//         $objA->foo = 'bar';
        
//         $objB = new stdClass();
        
//         $objC = new stdClass;
//         $objC->foo = 'bar';
//         $objC->int = 1;
//         $objC->array = array(0, array(1), array(2), 3);
//         $objC->related = new stdClass;
//         $objC->self = $objC;
//         $objC->c = $objC;
        
//         $objD = new stdClass;
//         $objD->foo = 'bar';
//         $objD->int = 2;
//         $objD->array = array(0, array(4), array(2), 3);
//         $objD->related = new stdClass;
//         $objD->self = $objD;
//         $objD->c = $objC;
        
//         return array(
//                 // Integers
//                 array(1, 0, <<<EOF
// Failed asserting that 0 matches expected 1.
// EOF
//                 ),
                
//                 // Integer and Double
//                 array(1.1, 0, <<<EOF
// Failed asserting that 0 matches expected 1.1.
// EOF
//                 ),
                
//                 // Chars
//                 array('a', 'b', <<<EOF
// Failed asserting that two strings are equal.

// - Expected 
// + Actual 

// -'a'
// +'b'
// EOF
//                 ), 
                        
//                 // Integer and Array
//                 array(1, array(0), <<<EOF
// Array (...) does not match expected type "integer".
// EOF
//                 ),
                
//                 // Array and Integer
//                 array(array(0), 1, <<<EOF
// 1 does not match expected type "array".
// EOF
//                 ),
                
//                 // Array and Array
//                 array(array(0), array(1), <<<EOF
// Failed asserting that two arrays are equal.

// - Expected 
// + Actual 

//  Array (
// -   0 => 0
// +   0 => 1
//  )
// EOF
//                 ),
                
//                 // Boolean and boolean as string
//                 array(array(TRUE), array('true'), <<<EOF
// Failed asserting that two arrays are equal.

// - Expected 
// + Actual 

//  Array (
// -   0 => true
// +   0 => 'true'
//  )
// EOF
//                 ),
                
//                 // Nested arrays
//                 array(array(0, array(1), array(2), 3), array(0, array(4), array(2), 3), <<<EOF
// Failed asserting that two arrays are equal.

// - Expected 
// + Actual 

//  Array (
//     0 => 0
//     1 => Array (
// -       0 => 1
// +       0 => 4
//      )
//     2 => Array (
//          0 => 2
//      )
//     3 => 3
//  )
// EOF
//              ),
             
                        
//              // Object and Array
//              array($objA, array(23),  <<<EOF
// Array (...) does not match expected type "object".
// EOF
//              ),          

//              // Array and Object
//              array(array(23), $objA,  <<<EOF
// stdClass Object (...) does not match expected type "array".
// EOF
//              ),  
          
//              // Object and Object
//              array($objA, $objB, <<<EOF
// Failed asserting that two objects are equal.

// - Expected 
// + Actual 

//  stdClass Object (
// -   'foo' => 'bar'
//  )
// EOF
//             ),
                
//             // Complex objects
//             array($objC, $objD, <<<EOF
// Failed asserting that two objects are equal.

// - Expected 
// + Actual 

//  stdClass Object (
//     'foo' => 'bar'
// -   'int' => 1
// +   'int' => 2
//     'array' => Array (
//         0 => 0
//         1 => Array (
// -           0 => 1
// +           0 => 4
//          )
//         2 => Array (
//              0 => 2
//          )
//         3 => 3
//      )
//     'related' => stdClass Object ()
//     'self' => stdClass Object (
//          'foo' => 'bar'
// -        'int' => 1
// +        'int' => 2
//          'array' => Array (
//              0 => 0
//              1 => Array (
// -                0 => 1
// +                0 => 4
//              )
//              2 => Array (
//                  0 => 2
//              )
//              3 => 3
//          )
//          'related' => stdClass Object ()
//          'self' => stdClass Object (*RECURSION*)
// -        'c' => stdClass Object (*RECURSION*)
// +        'c' => stdClass Object (
// +            'foo' => 'bar'
// +            'int' => 1
// +            'array' => Array (
// +                0 => 0
// +                1 => Array (
// +                    0 => 1
// +                )
// +                2 => Array (
// +                    0 => 2
// +                )
// +                3 => 3
// +            )
// +            'related' => stdClass Object ()
// +            'self' => stdClass Object (*RECURSION*)
// +            'c' => stdClass Object (*RECURSION*)
// +        )
//      )
//     'c' => stdClass Object (
//          'foo' => 'bar'
//          'int' => 1
//          'array' => Array (
//              0 => 0
//              1 => Array (
//                  0 => 1
//              )
//              2 => Array (
//                  0 => 2
//              )
//              3 => 3
//          )
//          'related' => stdClass Object ()
//          'self' => stdClass Object (*RECURSION*)
//          'c' => stdClass Object (*RECURSION*)
//      )
//  )
// EOF
                                     
//             ),
//         );
//     } 
 
//     /**
//      * @dataProvider isEqualProvider
//      * @covers CIUnit_Framework_Constraint_IsEqual 
//      * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
//      */
//     public function testConstraintIsEqualWithDataProviderAndCustomMessage($expected, $actual, $message)
//     {
//         $constraint = new CIUnit_Framework_Constraint_IsEqual($expected);
        
//         try {
//             $constraint->evaluate($actual, '');
//         }
//         catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
        
//             $this->assertEquals($message, $e->__toString());
            
//             return;
//         }
        
//         $this->fail();
//     }
    
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEqual 
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Framework_Constraint_IsEqual::count
     * @covers CIUnit_Framework_Constraint_IsEqual::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsNotEqial()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEqual(1);
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
        
        $this->assertTrue($notConstraint->evaluate(0, '', TRUE));
        $this->assertFalse($notConstraint->evaluate(1, '', TRUE));
        $this->assertEquals('is not equal to 1', $notConstraint->toString());
        $this->assertEquals(1, count($notConstraint));
        
        try {
            $notConstraint->evaluate(1);
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that 1 is not equal to 1." ,  $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsEqual
     * @covers CIUnit_Framework_Constraint_Not 
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsNotEqialWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsEqual(1);
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint); 
             
        try {
            $notConstraint->evaluate(1, 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that 1 is not equal to 1." ,  $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsFalse
     * @covers CIUnit_Framework_Constraint_IsFalse::count
     * @covers CIUnit_Framework_Constraint_IsFalse::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsFalse()
    {
        $constraint = new CIUnit_Framework_Constraint_IsFalse();
        
        $this->assertTrue($constraint->evaluate(FALSE, '', TRUE)); 
        $this->assertEquals('is false', $constraint->toString());
        $this->assertEquals(1, $constraint->count());
        
        try {
            $constraint->evaluate(TRUE);
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that true is false.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsFalse 
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsFalseWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsFalse();
         
        try {
            $constraint->evaluate(TRUE, 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that true is false.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    
    /**
     * @covers CIUnit_Framework_Constraint_IsTrue
     * @covers CIUnit_Framework_Constraint_IsTrue::count
     * @covers CIUnit_Framework_Constraint_IsTrue::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsTrue()
    {
        $constraint = new CIUnit_Framework_Constraint_IsTrue();
    
        $this->assertFalse($constraint->evaluate(FALSE, '', TRUE));
        $this->assertEquals('is true', $constraint->toString());
        $this->assertEquals(1, $constraint->count());
    
        try {
            $constraint->evaluate(FALSE);
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that false is true.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsTrue 
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsTrueWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsTrue();
     
        try {
            $constraint->evaluate(FALSE, 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that false is true.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsInstanceOf
     * @covers CIUnit_Framework_Constraint_IsInstanceOf::count
     * @covers CIUnit_Framework_Constraint_IsInstanceOf::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsInstanceOf()
    {
        $constraint = new CIUnit_Framework_Constraint_IsInstanceOf('Exception');
        
        $this->assertFalse($constraint->evaluate(new stdClass(), '', TRUE));
        $this->assertTrue($constraint->evaluate(new Exception(), '', TRUE));
        $this->assertEquals('is instance of Exception', $constraint->toString());
        $this->assertEquals(1, $constraint->count());
        
        try {
            $constraint->evaluate(new stdClass());
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that stdClass Object () is an instance of Exception.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsInstanceOf 
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsInstanceOfWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsInstanceOf('Exception');
    
        try {
            $constraint->evaluate(new stdClass(), 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that stdClass Object () is an instance of Exception.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsInstanceOf
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Framework_Constraint_IsInstanceOf::toString
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsNotInstanceOf()
    {
        $constraint = new CIUnit_Framework_Constraint_IsInstanceOf('Exception');
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
   
        try {
            $notConstraint->evaluate(new Exception());
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that Exception Object (...) is not an instance of Exception.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsInstanceOf
     * @covers CIUnit_Framework_Constraint_Not 
     * @covers CIUnit_Framework_Exception_ExpectationFailed::toString
     */
    public function testConstraintIsNotInstanceOfWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsInstanceOf('Exception');
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
         
        try {
            $notConstraint->evaluate(new Exception(), 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that Exception Object (...) is not an instance of Exception.", $e->__toString());
    
            return;
        }
    
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsNull
     * @covers CIUnit_Framework_Constraint_IsNull::count
     * @covers CIUnit_Framework_Constraint_IsNull::toString
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsNull()
    {
        $constraint = new CIUnit_Framework_Constraint_isNull();
        
        $this->assertFalse($constraint->evaluate($a = 3, '', TRUE));
        $this->assertTrue($constraint->evaluate(null, '', TRUE));
        $this->assertEquals("is null", $constraint->toString());
        $this->assertEquals(1, $constraint->count());
        
        try {
            $constraint->evaluate('str');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that 'str' is null.", $e->__toString());
            
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsNull 
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsNullWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_isNull(); 
        
        try {
            $constraint->evaluate('str', 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that 'str' is null.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsNull
     * @covers CIUnit_Framework_Constraint_Not 
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsNotNull()
    {
        $constraint = new CIUnit_Framework_Constraint_isNull(); 
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
        
        try {
            $notConstraint->evaluate(null);
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that null is not null.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsNull
     * @covers CIUnit_Framework_Constraint_Not 
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsNotNullWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_isNull();
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
        
        try {
            $notConstraint->evaluate(null, 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that null is not null.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsType
     * @covers CIUnit_Framework_Constraint_IsType::count
     * @covers CIUnit_Framework_Constraint_IsType::toString
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsType()
    {
        $constraint = new CIUnit_Framework_Constraint_IsType('string');
        
        $this->assertFalse($constraint->evaluate(0, '', TRUE));
        $this->assertTrue($constraint->evaluate('', '', TRUE));
        $this->assertEquals('is of type "string"', $constraint->toString());
        $this->assertEquals(1, count($constraint));
        
        try {
            $constraint->evaluate(new stdClass);
        } 
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that stdClass Object () is of type \"string\".", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsType 
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsTypeWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsType('string');
                 
        try {
            $constraint->evaluate(new stdClass, 'custom message');
        } 
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that stdClass Object () is of type \"string\".", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsType
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Framework_Constraint_IsType::count
     * @covers CIUnit_Framework_Constraint_IsType::toString
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsNotType()
    {
        $constraint = new CIUnit_Framework_Constraint_IsType('string');
        $notConstraint =  new CIUnit_Framework_Constraint_Not($constraint);
        
        $this->assertTrue($notConstraint->evaluate(0, '', TRUE));
        $this->assertFalse($notConstraint->evaluate('', '', TRUE));
        $this->assertEquals('is not of type "string"', $notConstraint->toString());
        $this->assertEquals(1, count($notConstraint));
        
        try {
            $notConstraint->evaluate('string');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that 'string' is not of type \"string\".", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_IsType
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintIsNotTypeWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_IsType('string');
        $notConstraint =  new CIUnit_Framework_Constraint_Not($constraint);
         
        try {
            $notConstraint->evaluate('string', 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that 'string' is not of type \"string\".", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_SameSize
     * @covers CIUnit_Framework_Constraint_SameSize::count
     * @covers CIUnit_Framework_Constraint_SameSize::toString
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintSameSize()
    {
        $constraint = new CIUnit_Framework_Constraint_SameSize(array('2', 'g'));
        
        $this->assertTrue($constraint->evaluate(array(1,2), '', TRUE));
        $this->assertFalse($constraint->evaluate(array(), '', TRUE));
        $this->assertEquals('count matches expected 2', $constraint->toString());
        $this->assertEquals(1, count($constraint));
        
        try {
            $constraint->evaluate(array(1,2,3));
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that actual size 3 matches expected size 2.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_SameSize 
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintSameSizeWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_SameSize(array('2', 'g'));  
        
        try {
            $constraint->evaluate(array(1,2,3), 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that actual size 3 matches expected size 2.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_SameSize
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_Framework_Constraint_Not::count
     * @covers CIUnit_Framework_Constraint_SameSize::toString
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintNotSameSize()
    {
        $constraint = new CIUnit_Framework_Constraint_SameSize(array('2', 'g'));
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
        
        $this->assertTrue($notConstraint->evaluate(array(1,5,2), '', TRUE));
        $this->assertFalse($notConstraint->evaluate(array(1,2), '', TRUE));
        $this->assertEquals('count does not match expected 2', $notConstraint->toString());
        $this->assertEquals(1, count($notConstraint));
        
        try {
            $notConstraint->evaluate(array(1,2));
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("Failed asserting that actual size 2 does not match expected size 2.", $e->__toString());
        
            return;
        }
        
        $this->fail();
      
    }
    
    /**
     * @covers CIUnit_Framework_Constraint_SameSize
     * @covers CIUnit_Framework_Constraint_Not
     * @covers CIUnit_ExpectationFailureException::toString
     */
    public function testConstraintNotSameSizeWithCustomMessage()
    {
        $constraint = new CIUnit_Framework_Constraint_SameSize(array('2', 'g'));
        $notConstraint = new CIUnit_Framework_Constraint_Not($constraint);
        
        try {
            $notConstraint->evaluate(array(1,3), 'custom message');
        }
        catch (CIUnit_Framework_Exception_ExpectationFailed $e) {
            $this->assertEquals("custom message\nFailed asserting that actual size 2 does not match expected size 2.", $e->__toString());
        
            return;
        }
        
        $this->fail();
    }
}

?>