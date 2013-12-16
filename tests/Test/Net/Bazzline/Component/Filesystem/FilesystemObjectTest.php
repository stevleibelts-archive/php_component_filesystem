<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16 
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Net\Bazzline\Component\Filesystem\FilesystemObject;
use Mockery;
use org\bovigo\vfs\vfsStream;

/**
 * Class FilesystemObjectTest
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */
class FilesystemObjectTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function testGetFilesystem()
    {
        $filesystem = $this->getNewFilesystemMock();
        $object = $this->getNewAbstractFilesystemObject(vfsStream::url('root/foo'), $filesystem);

        $this->assertSame($filesystem, $object->getFilesystem());
    }

    /**
     * @param string $path
     * @param null|\Net\Bazzline\Component\Filesystem\Filesystem $filesystem
     * @return \Net\Bazzline\Component\Filesystem\FilesystemObject
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    private function getNewAbstractFilesystemObject($path, $filesystem = null)
    {
        return new FilesystemObject($path, $filesystem);
    }
} 