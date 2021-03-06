<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-14
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Mockery;
use Net\Bazzline\Component\Filesystem\Filesystem;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit_Framework_TestCase;

/**
 * Class UnitTestCase
 *
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-14
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var vfsStreamDirectory
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    protected $root;

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    protected function setUp()
    {
        vfsStreamWrapper::register();
        $this->root = new vfsStreamDirectory('root');
        vfsStreamWrapper::setRoot($this->root);
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @param $path
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Filesystem\File
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-16
     */
    protected function createNewFileMock($path)
    {
        $file = Mockery::mock('Net\Bazzline\Component\Filesystem\File');
        $file->shouldReceive('getPathname')
            ->andReturn($path)
            ->once()
            ->byDefault();

        return $file;
    }

    /**
     * @param $path
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Filesystem\Directory
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-16
     */
    protected function createNewDirectoryMock($path)
    {
        $directory = Mockery::mock('Net\Bazzline\Component\Filesystem\Directory');
        $directory->shouldReceive('getPathname')
            ->andReturn($path)
            ->once()
            ->byDefault();

        return $directory;
    }

    /**
     * @param $path
     * @param null $content
     * @return \org\bovigo\vfs\vfsStreamContent
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    protected function createNewVfsStreamFile($path, $content = null)
    {
        $file = vfsStream::newFile($path)
            ->at($this->root);
        if (!is_null($content)) {
            $file->setContent($content);
        }

        return $file;
    }

    /**
     * @return Filesystem
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    protected function getNewFilesystem()
    {
        return new Filesystem();
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Filesystem\Filesystem
     * @author stev leibelt <artodeto@bazzline.net>
     * @since
     */
    protected function getNewFilesystemMock()
    {
        return Mockery::mock('Net\Bazzline\Component\Filesystem\Filesystem');
    }
} 