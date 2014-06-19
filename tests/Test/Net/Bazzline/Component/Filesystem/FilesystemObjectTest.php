<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-16 
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Net\Bazzline\Component\Filesystem\FilesystemObject;
use Mockery;
use org\bovigo\vfs\vfsStream;

/**
 * Class FilesystemObjectTest
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-16
 */
class FilesystemObjectTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-16
     */
    public function testConstructWithNewFilesystemObject()
    {
        $filesystem = $this->getNewFilesystemMock();
        $object = $this->getNewAbstractFilesystemObject(vfsStream::url('root/foo'), $filesystem);

        $this->assertSame($filesystem, $object->getFilesystem());
        $this->assertEquals('foo', $object->getName());
        $this->assertTrue($object->isModified());
        $this->assertTrue($object->isNew());
        $this->assertNull($object->getATime());
        $this->assertNull($object->getCTime());
        $this->assertNull($object->getMTime());
        $this->assertNull($object->getPerms());
        $this->assertNull($object->getInode());
        $this->assertNull($object->getGroup());
        $this->assertNull($object->getOwner());
        $this->assertNull($object->getSize());
        $this->assertNull($object->getType());
    }

    /**
     * @param string $path
     * @param null|\Net\Bazzline\Component\Filesystem\Filesystem $filesystem
     * @return \Net\Bazzline\Component\Filesystem\FilesystemObject
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-16
     */
    private function getNewAbstractFilesystemObject($path, $filesystem = null)
    {
        return new FilesystemObject($path, $filesystem);
    }
} 