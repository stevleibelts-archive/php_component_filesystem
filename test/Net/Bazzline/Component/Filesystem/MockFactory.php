<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-08 
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Mockery;

/**
 * Class MockFactory
 *
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-14
 */
class MockFactory
{
    /*
    public static function getTestCase()
    {
        $testCase = Mockery::mock('Net\Bazzline\Component\TestCase\TestCase\TestCase');

        return $testCase;
    }
    */

    /**
     * Tears down mock factory
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-14
     */
    public static function tearDown()
    {
        Mockery::close();
    }
}