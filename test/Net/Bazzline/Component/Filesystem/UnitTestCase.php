<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-08 
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use PHPUnit_Framework_TestCase;
use Test\Net\Bazzline\Component\Filesystem\MockFactory;

/**
 * Class UnitTestCase
 *
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-08
 */
class UnitTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Tears down test case
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-08
     */
    protected function tearDown()
    {
        MockFactory::tearDown();
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-11
     */
    protected static function getPathToResource()
    {
        return realpath(__DIR__) .
            str_repeat(DIRECTORY_SEPARATOR . '..', 4) .
            DIRECTORY_SEPARATOR . 'resource';
    }

    /**
     * @param $value
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-13
     */
    protected function assertIsArray($value)
    {
        $this->assertTrue(
            is_array($value),
            'Given value is no array. Value ' . var_export($value, true)
        );
    }
}