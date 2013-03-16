CIUnit 1.2.1 Beta [![Build Status](https://travis-ci.org/agop/ciunit-framework.png?branch=master)](https://travis-ci.org/agop/ciunit-framework)
---------------
CIUnit is simple and light-weight PHPUnit/JUnit like unit testing framework for CodeIgniter. The framework runs on top
of CodeIgniter and provides a web interface for test execution. CIUnit is a good alternative
for small projects where the full potential of PHPUnit is not used and a good start for unit testing newbies.

We are still in Beta version, so if you notice any bugs please report them [here][bug-list]. <br/>
Any suggestions on how to improve our code are wellcome :)


Table of Contents
-----------------
* [Getting Started][getting-started]
* [Writing Tests for CIUnit][writing-tests-for-ciunit]
 * [Testing CodeIgniter][testing-codeigniter]
 * [Testing Exceptions][testing-exceptions]
* [Fixtures][fixtures]
* [Organizing Tests][organizing-tests]
* [CIUnit API][ciunit-api]
 * [аssertArrayHasKey][assertarrayhaskey]
 * [аssertCount][assertcount]
 * [аssertEmpty][assertempty]
 * [аssertFalse][assertfalse]
 * [аssertinstanceOf][assertinstanceof]
 * [аssertinternalType][assertinternaltype]
 * [аssertNull][assertnull]
 * [аssertSameSize][assertsamesize]
 * [аssertTrue][asserttrue]
 * [аssertGreaterThan][assertgreaterthan]
 * [аssertGreaterThanOrEqual][assertgreaterthanorequal]
 * [аssertLessThan][assertlessthan]
 * [аssertLessThanOrEqual][assertlessthanorequal]
 * [аssertStringStartsWith][assertstringstartswith]
 * [аssertStringEndsWith][assertstringendswith]
 * [аssertStringMatchesRegex][assertstringmatchesregex]
 * [assertClassHasAttribute][assertclasshasattribute]
 * [assertClassHasStaticAttribute][assertclasshasstaticattribute]
 * [assertObjectHasAttribute][assertobjecthasattribute]
 * [assertObjectHasStaticAttribute][assertobjecthasstaticattribute]
* [Change Log][change-log]
* [Issues][issues]
* [Credits][credits]

Getting Started
---------------
### Requirements
CIUnit requires CodeIgniter >= 2.0 <br/>
PHP >= 5.3

### How to install

* Download CIUnit Framework from [here][download-master-zip] or just clone the repo```git clone git@github.com:agop/ciunit-framework.git```
* Unzip the ```resources/``` folder in the root of your application
* Unzip the ```controllers/ciunit_controller.php``` to your ```controllers/``` folder
* Unzip the ```third_party/ciunit/``` folder to your ```third_party/``` folder
* Create folder ```tests/``` under your ```application/``` folder
* Add the following routes to your ```routes.php```

```php
$route['ciunit'] = "ciunit_controller/index";
$route['ciunit/(:any)'] = "ciunit_controller/index/$1";
```
* CIUnit makes use of the ```base_url()``` feature in CodeIgniter. Please, make sure it is properly configured inside your ```config/config.php```

```php
$config['base_url'] = 'http://example.com/';
```
* Now you must be good to go.
 - ```http://example.com/index.php/ciunit``` or
 - ```http://example.com/ciunit``` depending on your url configuration
 

<b>NB!</b> CIUnit used CodeIgniter's ```ENVIRONMENT``` constant, and will only works only in ```testing``` or ```development```. Please make sure your are not running in ```production```.
Change your working environment from your ```index.php```located in the ```root``` of your project.

```php
 define('ENVIRONMENT', 'testing');
```


#### Customization

CIUnit allows you to change location for resources and tests. The CIUnit config file is located under ```ciunit/config/config.php```
Default configuration is as follows
```php
$config['tests_path'] = APPPATH .'tests/';
$config['resources_path'] = 'resources/';
```

If you have any issues installing CIUnit, please feel free to contact me.

### Screenshots
#### Failure
 ![Screenshot of CIUnit, displaying failures in results.](https://lh5.googleusercontent.com/-PPF0wZLcCok/USkkZO0qRuI/AAAAAAAAFoc/6X5wucMEscQ/s797/failure.png "CIUnit Test Results")
 
#### Success
![Screenshot of CIUnit, displaying success in results.](https://lh6.googleusercontent.com/-koR9udOOSXU/USkkZO2VLLI/AAAAAAAAFoY/0oY7BRYUijg/s799/success.png "CIUnit Test Results")
#### Success with Warnings
![Screenshot of CIUnit, displaying warnings in results.](https://lh6.googleusercontent.com/-grfQ9P5IfXw/USub-AZ4WcI/AAAAAAAAFpA/YpT9kWRZuLg/s804/warning.png "CIUnit Test Results")

Writing Tests for CIUnit
------------------------

The example introduces the basic conventions and steps for writing tests with CIUnit<br/>
1. The tests for the class ```User``` go into a class ```UserTest``` in UserTest.php <br/>
<b>NB!</b> It is important to follow this naming convention for tests so they can be discovered by CIUnit e.g.``` class MyTest``` -> ```MyTest.php```<br/>
2. ```UserTest``` inherits from ```CIUnit_Framework_TestCase``` <br/>
3. Tests are public methods whose name starts with ```test*``` <br/>
4. Inside your test methods you would use assertions like ```$this->assertTrue(TRUE)``` <br/>
5. Your test classes go under ```application/tests``` by default. Nested folders are not supported in this release!

StackTest.php
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

### Testing CodeIgniter
The ```CIUnit_Framework_TestCase``` class holds an instance to CodeIgniter that can be accessed from your test class using ```$this->get_instance()```
Example test class performing operations with a CodeIgniter module class.

CITest.php
```php
<?php

class CITest extends CIUnit_Framework_TestCase
{   

    public function testAccessCIModel()
    {
        $model = $this->get_instance()->model_name->get_all();
        $this->assertEquals(10, count($model));
    }
}
```

### Testing Exceptions
To test whether an exception is thrown inside the tested code use the ```setExpectedException (string $name, string $message, integer $code)``` method.
The ```$message``` and ```$code``` parameters are optional. If present framework will try to match them with the corresponding 
values from the exception thrown.

The example introduces the basic steps for testing for expected exception

ExceptionTest.php
```php
<?php

class ExceptionTest extends CIUnit_Framework_TestCase
{
    public function testException()
    {
        $this->setExpectedException('Exception'); 
        throw new Exception("Error Processing Request", 1)
    }
}
```

Alternative approach to testing exceptions

```php
<?php

class ExceptionTest extends CIUnit_Framework_TestCase
{
    public function testException()
    {
        try {
            // Code throwing exception goes here...
        }
        catch(Exception $e) {
            return;
        }
        
        $this->fail('No exception has been raised');
    }
}
```
<b>NB!</b> With this approach your test will be mark as ```Incomplete```, because it is not performing any assertions.

Fixtures
--------
I assume we all know what fixtures are and how they work.

The ```setUp()``` and ```tearDown()``` template methods are run once for each test method of the test case class.

FixtureTest.php
```php
<?php

class FixtureTest extends CIUnit_Framework_TestCase
{
    protected function setUp()
    {
        print __METHOD__ . "\n";
    }
    
    public function testOne()
    {
        print __METHOD__ . "\n";
        $this->assertTrue(TRUE);
    }
    
    public function testTwo()
    {
        print __METHOD__ . "\n";
        $this->assertTrue(TRUE);
    }
    
    protected function tearDown()
    {
        print __METHOD__ . "\n";
    }
}
```
The result from running the code will be
```
FixtureTest::setUp
FixtureTest::testOne 
FixtureTest::tearDown 
FixtureTest::setUp 
FixtureTest::testTwo 
FixtureTest::tearDown
```

Organizing Tests
----------------
The CIUnit framework allows us to organize tests into a hierarchy of test suite objects. Suites are created by extending the ```CIUnit_Framework_TestSuite``` class and using the ```suite()``` method.
The ```CIUnit_Framework_TestSuite``` class class offers two template methods, ```setUp()``` and ```tearDown()```, that are called before the first test of the test suite and after the last test of the test suite, respectively.
Here is a basic examplе how to organize your test suites into one test suite.

MySuite.php
```php
<?php

require_once 'MyTest.php';

class MySuite extends CIUnit_Framework_TestSuite
{
    public static function suite()
    {
        $suite = new MySuite('Project Suite');
        $suite->addTestSuite('MyTest');
        
        return $suite;
    }
    
    protected function setUp()
    {
        print __METHOD__ . "\n";
    }
    
    protected function tearDown()
    {
        print __METHOD__ . "\n";
    }
}
```
The implementation for MyTest.php can be found below

```php
<?php
 
class MyTest extends CIUnit_Framework_TestCase
{ 
    protected function setUp()
    {
        print __METHOD__ . "\n";
    }
    
    protected function tearDown()
    {
        print __METHOD__ . "\n";
    }
    
    public function testOne()
    {
         print __METHOD__ . "\n";
    }
    
    public function testTwo()
    {
         print __METHOD__ . "\n";
    }
    
    public function testThree()
    {
         print __METHOD__ . "\n";
    }
}

```

Output
```
MySuite::setUp
MyTest::setUp
MyTest::testOne
MyTest::tearDown
MyTest::setUp
MyTest::testTwo
MyTest::tearDown
MyTest::setUp
MyTest::testThree
MyTest::tearDown
MySuite::tearDown
```


CIUnit API
--------------
### assertArrayHasKey
Method asserts that array has a specified key

```assertArrayHasKey(mixed $needle, array $haystack, string $message = '')``` <br/>
Reports an error identified by ```$message``` if ```$array``` does not contain the specified ```$key```. <br/>
```assertArrayNotHasKey()``` is the inverse of this assertion and takes the same arguments.

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

```assertCount($expectedCount, array $haystack, string $messge = '')```<br/>
Reports an error identified by ```$message``` if the number of elements in ```$haystack``` is not equal to ```$expectedCount```.<br/>
```assertNotCount()``` is the inverse of this assertion and takes the same arguments.

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

```assertEmpty(mixed $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$actual``` is not empty.<br/>
```assertNotEmpty()``` is the inverse of this assertion and takes the same arguments.

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
Method asserts that two variables are equal

```assertEquals(mixed $expected, mixed $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not equal to ```$actual```.<br/>
```assertNotEquals()``` is the inverse of this assertion and takes the same arguments.

```php
<?php
class EqualsTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertEquals(12, 13);
    }
    
    public function testFailure2()
    {
        $this->assertEquals('Integer', 'String');
    }
}
```
Failure description
```
Failed asserting that 12 matches expected 13. 

Failed asserting that two strings are equal.

- Expected 
+ Actual 

-'Integer'
+'String'
```

```assertEquals(float $expected, float $actual, float $delta = 0, string $message = '')``` 

Reports an error identified by ```$message``` if the two floats ```$expected``` and ```$actual``` are not within ```$delta``` of each other.
```php
<?php
class EqualsTest extends CIUnit_Framework_TestCase
{
    public function testSuccess()
    {
        $this->assertEquals(12.0, 12.1, 0.2, '');
    }
    
    public function testFailure()
    {
        $this->assertEquals(12.0, 12.1);
    }
}
```
Failure description
```
Failed asserting that 12.1 matches expected 12.0. 
```
```assertEquals(array $expected, array $actual, string $message = '') ```
```php
<?php
class EqualsTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $actual = array('a', 'b', 'c');
        
        $expected = array('a', 'b', 'd');
        
        $this->assertEquals($actual, $expected);
    }
}
```
Failure description
```
Failed asserting that two arrays are equal.

- Expected 
+ Actual 

 Array (
    0 => 'a'
    1 => 'b'
-   2 => 'c'
+   2 => 'd'
 )  
```

```assertEquals(object $expected, object $actual, string $message = '') ```
```php
<?php
class EqualsTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $expected = new stdClass();
        $expected->name = "John";
        $expected->age = 11;
        
        $actual = new stdClass();
        $actual->name = "John";
        $actual->age = 19; 
        
        $this->assertEquals($actual, $expected);
    }
}
```
Failure description
```
Failed asserting that two objects are equal.

- Expected 
+ Actual 

 stdClass Object (
    'name' => 'John'
-   'age' => 11
+   'age' => '19'
 )  
```

### assertFalse
Method asserts that a condition is false

```assertFalse(bool $condition, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$condition``` is ```TRUE```. 

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

```assertInstanceOf(object $expected, object $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not an instance of ```$actual```. <br/>
```assertNotInstanceOf()``` is the inverse of this assertion and takes the same arguments.
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

```assertInternalType(object $expected, object $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not of type ```$actual```. <br/>
```assertNotInternalType()``` is the inverse of this assertion and takes the same arguments.
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
Method asserts that a variable is ```NULL```

```assertNull(mixed $var, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$var``` is not ```NULL```. <br/>
```assertNotNull()``` is the inverse of this assertion and takes the same arguments.
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

```assertSameSize(mixed $expected, mixed $actual string $message = '')```<br/>
Reports an error identified by ```$message``` if the number of elements in ```$expected``` is not the same as in ```$actual```. <br/>
```assertNotSameSize()``` is the inverse of this assertion and takes the same arguments.
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

```assertTrue(bool $condition, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$condition``` is ```FALSE```. 

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

### assertGreaterThan
Method asserts that a value is greater than another value

```assertGreaterThan(mixed $expected, mixed $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not greater than ```$actual```. 

For various types, comparison is done according to this [table][operatorcomparison].

```php
<?php
class GreaterThanTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertGreaterThan(12, 2);
    }
}
```
Failure description
```
Failed asserting that 2 is greater than 12. 
```

### assertGreaterThanOrEqual
Method asserts that a value is greater than or equal to another value

```AssertGreaterThanOrEqual(mixed $expected, mixed $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not greater than or equal to ```$actual```. 

For various types, comparison is done according to this [table][operatorcomparison].

```php
<?php
class GreaterThanOrEqualTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->AssertGreaterThanOrEqual(13, 12);
    }
}
```
Failure description
```
Failed asserting that 12 is greater or equal to 13. 
```

### assertLessThan
Method asserts that a value is less than another value

```AssertLessThan(mixed $expected, mixed $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not less than ```$actual```. 

For various types, comparison is done according to this [table][operatorcomparison].

```php
<?php
class LessThanTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertLessThan(13, 21);
    }
}
```
Failure description
```
Failed asserting that 21 is less than 13. 
```

### assertLessThanOrEqual
Method asserts that a value is less than or equal to another value

```AssertLessThanOrEqual(mixed $expected, mixed $actual, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$expected``` is not less than or equal to ```$actual```.  

For various types, comparison is done according to this [table][operatorcomparison].

```php
<?php
class LessThanOrEqualTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertLessThanOrEqual(13, 15);
    }
}
```
Failure description
```
Failed asserting that 15 is less or equal to 13.  
```
### assertStringStartsWith
Method assert that string starts with a give prefix

```assertStringStartsWith(string $prefix, string $string, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$string``` does not start with ```$prefix```. <br/>
```assertStringNotStartsWith()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class StringStartsWithTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertStringStartsWith('prse', 'presentation');
    }
}
```
Failure description
```
Failed asserting that 'presentation' string starts with 'prse'. 
```

### assertStringEndsWith
Method assert that string starts with a give prefix

```assertStringEndsWith(string $suffix, string $string, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$string``` does not end with ```$suffix```. <br/>
```assertStringNotEndsWith()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class StringEndsWithTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertStringEndsWith('tatiodn', 'presentation');
    }
}
```
Failure description
```
Failed asserting that 'presentation' string ends with 'tatiodn'. 
```

### assertStringMatchesRegex
Method asserts that a string matches a given regular expression

```assertStringMatchesRegex(string $regex, string $string, string $message = '')```<br/>
Reports an error identified by ```$message``` if ```$string``` does not match ```$regex```. <br/>
```assertStringNotMatchesRegex()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class StringMatchesRegexTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertStringMatchesRegex('/^prez/', 'presentation');
    }
}
```
Failure description
```
Failed asserting that 'presentation' string matches the regular expression '/^prez/'. 
```

### assertClassHasAttribute
Method asserts that a class has a specified attribute

```assertClassHasAttribute(string $attribute, string $className, string $message = '')```<br/>
Reports an error identified by ```$message``` if class ```$className``` does not have attribute ```$attribute```. <br/>
```assertClassNotHasAttribute()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class ClassHasAttributeTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertClassHasAttribute('notExistingAttribute', 'ClassWithAttributes');
    }
}
```
Failure description
```
Failed asserting that 'ClassWithAttributes' class has attribute 'notExistingAttribute'.
```

### assertClassHasStaticAttribute
Method asserts that a class has a specified static attribute

```assertClassHasStaticAttribute(string $attribute, string $className, string $message = '')```<br/>
Reports an error identified by ```$message``` if class ```$className``` does not have static attribute ```$attribute```. <br/>
```assertClassNotHasStaticAttribute()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class ClassHasStaticAttributeTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertClassHasStaticAttribute('nonStaticAttribute', 'ClassWithAttributes');
    }
}
```
Failure description
```
Failed asserting that 'ClassWithAttributes' class has static attribute 'nonStaticAttribute'.
```

### assertObjectHasAttribute
Method asserts that an object has a specified attribute

```assertObjectHasAttribute(string $attribute, object $object, string $message = '')```<br/>
Reports an error identified by ```$message``` if  ```$object``` does not have attribute ```$attribute```. <br/>
```assertObjectNotHasAttribute()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class ObjectHasAttributeTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertObjectHasAttribute('publicAttribute',  new ClassWithAttributes());
    }
}
```
Failure description
```
Failed asserting that ClassWithAttributes Object(...) has attribute 'publicAttribute'.
```

### assertObjectHasStaticAttribute
Method asserts that an object has a specified static attribute

```assertObjectHasStaticAttribute(string $attribute, object $object, string $message = '')```<br/>
Reports an error identified by ```$message``` if  ```$object``` does not have static attribute ```$attribute```. <br/>
```assertObjectNotHasStaticAttribute()``` is the inverse of this assertion and takes the same arguments.
```php
<?php
class ObjectHasStaticAttributeTest extends CIUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertObjectHasStaticAttribute('publicAttribute',  new ClassWithAttributes());
    }
}
```
Failure description
```
Failed asserting that ClassWithAttributes Object(...) has static attribute 'publicAttribute'.
```


Change Log
----------
### Version 1.1.x
 Release date:  March 6, 2013
#### Changes:
  * Added [assertGreaterThan][assertgreaterthan]
  * Added [assertGreaterThanOrEqual][assertgreaterthanorequal]
  * Added [assertLessThan][assertlessthan]
  * Added [assertLessThanOrEqual][assertlessthanorequal]
  * Added [assertStringStartsWith][assertstringstartswith]
  * Added [assertStringEndsWith][assertstringendswith]
  * Added [assertStringMatchesRegex][assertstringmatchesregex]
  
### Fixed bugs:
  * Solved issues [#1][issue1] and [#2][issue2]

### Version 1.2.x
 Release date:  March 14, 2013
#### Changes:
  * Added [assertClassHasAttribute][assertclasshasattribute]
  * Added [assertClassHasStaticAttribute][assertclasshasstaticattribute]
  * Added [assertObjectHasAttribute][assertobjecthasattribute]
  * Added [assertObjectHasStaticAttribute][assertobjecthasstaticattribute]

### Fixed bugs:
  * Fixed "Allowed memory exhausted" bug when processing exceptions

Issues
------

Have a bug? Please create an issue here on GitHub!

https://github.com/agop/ciunit-framework/issues

Credits
-------

Copyright &copy; 2013

Licensed under the The BSD 3-Clause License

The front-end is developed using the [Bootstrap framework][twitter-bootstrap] by Twitter.

I took my inspiration from [JUnit][junit] and [PHPUnit][phpunit], thank you guys for being there for us.

<!-- deep links -->
[getting-started]: #getting-started
[features]: #features 
[writing-tests-for-ciunit]: #writing-tests-for-ciunit
[testing-codeigniter]: #testing-codeigniter
[testing-exceptions]: #testing-exceptions
[testing-php-errors]: #testing-php-errors
[fixtures]: #fixtures
[organizing-tests]: #organizing-tests
[ciunit-api]: #ciunit-api
[assertarrayhaskey]: #assertarrayhaskey
[assertcount]: #assertcount
[assertempty]: #assertempty
[assertfalse]: #assertfalse
[assertinstanceof]: #assertinstanceof
[assertinternaltype]: #assertinternaltype
[assertnull]: #assertnull
[assertsamesize]: #assertsamesize
[asserttrue]: #asserttrue
[assertgreaterthan]: #assertgreaterthan
[assertgreaterthanorequal]: #assertgreaterthanorequal
[assertlessthan]: #assertlessthan
[assertlessthanorequal]: #assertlessthanorequal
[assertstringstartswith]: #assertstringstartswith
[assertstringendswith]: #assertstringendswith
[assertstringmatchesregex]: #assertstringmatchesregex
[assertclasshasattribute]: #assertclasshasattribute
[assertclasshasstaticattribute]: #assertclasshasstaticattribute
[assertobjecthasattribute]: #assertobjecthasattribute
[assertobjecthasstaticattribute]: #assertobjecthasstaticattribute

[change-log]: #change-log
[issues]: #issues
[credits]: #credits

[bug-list]: https://github.com/agop/ciunit-framework/issues
[download-master-zip]: https://github.com/agop/ciunit-framework/archive/master.zip
[twitter-bootstrap]: http://twitter.github.com/bootstrap/
[phpunit]: https://github.com/sebastianbergmann/phpunit
[junit]: https://github.com/junit-team/junit
[operatorcomparison]: http://php.net/manual/en/language.operators.comparison.php


[issue1]: https://github.com/agop/ciunit-framework/issues/1
[issue2]: https://github.com/agop/ciunit-framework/issues/2


