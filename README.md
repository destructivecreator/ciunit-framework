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

assertArrayHasKey(mixed $key, array $array, string $message = '')
Reports an error identified by $message if $array does not contain the specified $key.
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

### assertEmpty
Method asserts that a variable is empty

assertEmpty(mixed $actual, string $message = '')
Reports an error identified by $message if $actual is not empty.
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
Failed asserting that an array has the key "bar". 
```
### assertEquals
### assertFalse
### assertInstanceOf
### assertInternalType
### assertNull
### assertSameSize
### assertTrue
### assertNot

Issues
------

Have a bug? Please create an issue here on GitHub!

https://github.com/agop/ciunit-framework/issues



License
-------

Copyright 2013 Agop Seropyan

Licensed under the Apache/BSD License
