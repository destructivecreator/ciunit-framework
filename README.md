CIUnit is an open source PHPUnit/JUnit like unit testing framework for testing ication developed using CodeIgniter Framework.

Getting Started
---------------



Features
--------

* A
* B


CodeIgniter Integration
---------------------


Writing Tests for CIUnit
------------------------

The example introduces the basic conventions and steps for writing tests with CIUnit:

```php
<?php

class StackTest extends CIUnit_Framework_TestCase
{   

    public function testPushAndPop()
    {
        $stack = array();
        $this->assertEquals(0, count($stack));
 
        array_push($stack, 'foo');
        $this->assertEquals('foo', $stack[count($stack)-1]);
        $this->assertEquals(1, count($stack));
 
        $this->assertEquals('foo', array_pop($stack));
        $this->assertEquals(0, count($stack));
    }
}

```

### Testing Exceptions
### Testing PHP Errors

Fixtures
--------

Organizing Tests
----------------

CIUnit API
--------------
### assertArrayHasKey
Method asserts that array has a specified key

assertArrayHasKey(mixed $needle, array $haystack, string $message = '') <br/>
Reports an error identified by $message if $array does not contain the specified $key. <br/>
assertArrayNotHasKey() is the inverse of this assertion and takes the same arguments.
```php
<?php
class ArrayHasKeyTest extends CIUnit_Framework_TestCase
{ 
    public function testFailure()
    {
        $this->assertArrayHasKey('foo', array('bar' => 'bar'));
    }
}
```
Failure description
```
Failed asserting that an array has the key "bar". 
```

### assertCount
Method asserts the number of elements of an array, Countable or Iterator

assertCount($expectedCount, array $haystack, string $messge = '')<br/>
Reports an error identified by $message if the number of elements in $haystack is not equal to $expectedCount.<br/>
assertNotCount() is the inverse of this assertion and takes the same arguments.

```php
<?php
class CountTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertCount(0, array('foo'));
    }
}
```
Failure description
```
Failed asserting that actual size 1 matches expected size 0.  
```

### assertEmpty
Method asserts that a variable is empty

assertEmpty(mixed $actual, string $message = '')<br/>
Reports an error identified by $message if $actual is not empty.<br/>
assertNotEmpty() is the inverse of this assertion and takes the same arguments.

```php
<?php
class EmptyTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertEmpty(array('foo'));
    }
}
```
Failure description
```
Failed asserting that an array is empty. 
```

### assertEquals



### assertFalse
Method asserts that a condition is false

assertFalse(bool $condition, string $message = '')<br/>
Reports an error identified by $message if $condition is TRUE. 

```php
<?php
class FalseTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertFalse(TRUE);
    }
}
```
Failure description
```
Failed asserting that true is false.  
```

### assertInstanceOf
Method asserts that a variable is of a given type

assertInstanceOf(object $expected, object $actual, string $message = '')<br/>
Reports an error identified by $message if $expected is not an instance of $actual. <br/>
assertNotInstanceOf() is the inverse of this assertion and takes the same arguments.
```php
<?php
class InstanceOfTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertInstanceOf('RunTimeException', new Exception());
    }
}
```
Failure description
```
Failed asserting that Exception Object (...) is an instance of RunTimeException. 
```

### assertInternalType
Method assert that variable is of a given type

assertInternalType(object $expected, object $actual, string $message = '')<br/>
Reports an error identified by $message if $expected is not of type $actual. <br/>
assertNotInternalType() is the inverse of this assertion and takes the same arguments.
```php
<?php
class InternalTypefTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertInternalType('string', 1);
    }
}
```
Failure description
```
Failed asserting that 1 is of type "string".
```

### assertNull
Method asserts that a variable is NULL

assertNull(mixed $var, string $message = '')<br/>
Reports an error identified by $message if $var is not NULL. <br/>
assertNotNull() is the inverse of this assertion and takes the same arguments.
```php
<?php
class NullTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertNull('string');
    }
}
```
Failure description
```
Failed asserting that 'string' is null. 
```

### assertSameSize
Method assert that the size of two arrays (or `Countable` or `Iterator` objects) is the same

assertSameSize(mixed $expected, mixed $actual string $message = '')<br/>
Reports an error identified by $message if the number of elements in $expected is not the same as in $actual. <br/>
assertNotSameSize() is the inverse of this assertion and takes the same arguments.
```php
<?php
class SameSizeTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertSameSize(array(1, 2), array());
    }
}
```
Failure description
```
Failed asserting that actual size 0 matches expected size 2. 
```

### assertTrue 
Method asserts that a condition is true

assertTrue(bool $condition, string $message = '')<br/>
Reports an error identified by $message if $condition is FALSE. 

```php
<?php
class TrueTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertTrue(FALSE);
    }
}
```
Failure description
```
Failed asserting that false is true.  
```

Issues
------

Have a bug? Please create an issue here on GitHub!

https://github.com/agop/ciunit-framework/issues



License
-------

Copyright 2013 Agop Seropyan

Licensed under the Apache/BSD License
