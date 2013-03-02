<?php
 
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'application/third_party/ciunit/framework/autoload.php';

require_once 'PHPUnit/Framework/TestCase.php';

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . '_files' . DIRECTORY_SEPARATOR . 'ClassWithToString.php';
 
/**
 * ComparatorTest test case.
 */
class ComparatorTest extends PHPUnit_Framework_TestCase
{ 
    
    public function instanceProvider()
    {
        $tmpfile = tmpfile();
    
        return array(
                array(NULL, NULL, 'CIUnit_Framework_Comparator_Scalar'),
                array(NULL, TRUE, 'CIUnit_Framework_Comparator_Scalar'),
                array(TRUE, NULL, 'CIUnit_Framework_Comparator_Scalar'),
                array(TRUE, TRUE, 'CIUnit_Framework_Comparator_Scalar'),
                array(FALSE, FALSE, 'CIUnit_Framework_Comparator_Scalar'),
                array(TRUE, FALSE, 'CIUnit_Framework_Comparator_Scalar'),
                array(FALSE, TRUE, 'CIUnit_Framework_Comparator_Scalar'),
                array('', '', 'CIUnit_Framework_Comparator_Scalar'),
                array('0', '0', 'CIUnit_Framework_Comparator_Numeric'),
                array('0', 0, 'CIUnit_Framework_Comparator_Numeric'),
                array(0, '0', 'CIUnit_Framework_Comparator_Numeric'),
                array(0, 0, 'CIUnit_Framework_Comparator_Numeric'),
                array(1.0, 0, 'CIUnit_Framework_Comparator_Double'),
                array(0, 1.0, 'CIUnit_Framework_Comparator_Double'),
                array(1.0, 1.0, 'CIUnit_Framework_Comparator_Double'),
                array(array(1), array(1), 'CIUnit_Framework_Comparator_Array'),
                array($tmpfile, $tmpfile, 'CIUnit_Framework_Comparator_Resource'),
                array(new stdClass, new stdClass, 'CIUnit_Framework_Comparator_Object'), 
                array(new Exception, new Exception, 'CIUnit_Framework_Comparator_Exception'), 
                // mixed types
                array($tmpfile, array(1), 'CIUnit_Framework_Comparator_Type'),
                array(array(1), $tmpfile, 'CIUnit_Framework_Comparator_Type'),
                array($tmpfile, '1', 'CIUnit_Framework_Comparator_Type'),
                array('1', $tmpfile, 'CIUnit_Framework_Comparator_Type'),
                array($tmpfile, new stdClass, 'CIUnit_Framework_Comparator_Type'),
                array(new stdClass, $tmpfile, 'CIUnit_Framework_Comparator_Type'),
                array(new stdClass, array(1), 'CIUnit_Framework_Comparator_Type'),
                array(array(1), new stdClass, 'CIUnit_Framework_Comparator_Type'),
                array(new stdClass, '1', 'CIUnit_Framework_Comparator_Type'),
                array('1', new stdClass, 'CIUnit_Framework_Comparator_Type'),
                array(new ClassWithToString, '1', 'CIUnit_Framework_Comparator_Scalar'),
                array('1', new ClassWithToString, 'CIUnit_Framework_Comparator_Scalar'),
                array(1.0, new stdClass, 'CIUnit_Framework_Comparator_Type'),
                array(new stdClass, 1.0, 'CIUnit_Framework_Comparator_Type'),
                array(1.0, array(1), 'CIUnit_Framework_Comparator_Type'),
                array(array(1), 1.0, 'CIUnit_Framework_Comparator_Type'),
        );
    }
    
    /**
     * @dataProvider instanceProvider
     */
    public function testGetInstance($valueA, $valueB, $expectedComparator)
    {
        $factory = CIUnit_Framework_ComparatorAbstractFactory::getInstance();
        $actualComparator = get_class($factory->getComparator($valueA, $valueB));
        
        if($actualComparator != $expectedComparator) {
            $this->fail();
        }
    }
    
    /**
     * @covers CIUnit_Comparator::register()
     */
    public function testRegisterComparator()
    {
        // Register comparator
        $factory = CIUnit_Framework_ComparatorAbstractFactory::getInstance();
        $comparator = new TestClassComparator();
        
        $factory->register($comparator);
        
        $expected = new TestClass();
        $actual = new TestClass();
        $expectedComparator = 'TestClassComparator';
        
        if(get_class($factory->getComparator($expected, $actual)) != $expectedComparator) {
            $factory->unregister($comparator);
            $this->fail();
        }
        
        // Unregister
        $factory->unregister($comparator);
    }
    
    
    public function testUnregisterComparator()
    {
        // Register comparator
        $factory = CIUnit_Framework_ComparatorAbstractFactory::getInstance();
        $comparator = new TestClassComparator();
        
        $factory->register($comparator);
        $factory->unregister($comparator);
        
        $expected = new TestClass();
        $actual = new TestClass();
        $expectedComparator = 'TestClassComparator';
        
        if(get_class($factory->getComparator($expected, $actual)) == $expectedComparator) {
            //var_dump(get_class($factory->getComparator($expected, $actual)));
            $this->fail();
        }
    }
}

/**
 * Extra classes used for registering and unregistering comparators
 */

class TestClass{}

class TestClassComparator extends CIUnit_Framework_Comparator_Object {}

?>