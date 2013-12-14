<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Net\Bazzline\Component\Filesystem\File;
use org\bovigo\vfs\vfsStream;

/**
 * Class FileTest
 *
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */
class FileTest extends ComponentTestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function testGenerateCheckSum()
    {
        $content = 'test content';
        $this->createNewVfsStreamFile('foo.bar', $content);
        $file = $this->getNewFile(vfsStream::url('root/foo.bar'));
        $expectedChecksum = sha1($content);

        $this->assertSame($expectedChecksum, $file->generateCheckSum());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function testAppendContent()
    {
        $content = 'test content';
        $appendedContent = 'foobar ';
        $this->createNewVfsStreamFile('foo.bar', $content);
        $file = $this->getNewFile(vfsStream::url('root/foo.bar'));
        $file->appendContent($appendedContent);
        $expectedContent = $appendedContent . $content;

        $this->assertSame($expectedContent, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function testGetContent()
    {
        $content = 'test content';
        $this->createNewVfsStreamFile('foo.bar', $content);
        $file = $this->getNewFile(vfsStream::url('root/foo.bar'));

        $this->assertSame($content, $file->getContent());
    }

    /**
     * @param $path
     * @return File
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    private function getNewFile($path)
    {
        return new File($path, $this->getNewFilesystemMock());
    }
} 