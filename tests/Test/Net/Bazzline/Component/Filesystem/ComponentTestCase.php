<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit_Framework_TestCase;
use Mockery;

/**
 * Class UnitTestCase
 *
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */
class ComponentTestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var vfsStreamDirectory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    protected $root;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    protected function setUp()
    {
        vfsStreamWrapper::register();
        $this->root = new vfsStreamDirectory('root');
        vfsStreamWrapper::setRoot($this->root);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Filesystem\Filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since
     */
    protected function getNewFilesystemMock()
    {
        return Mockery::mock('Net\Bazzline\Component\Filesystem\Filesystem');
    }
} 