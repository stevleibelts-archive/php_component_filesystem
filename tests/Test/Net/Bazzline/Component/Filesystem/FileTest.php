<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-14
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Net\Bazzline\Component\Filesystem\File;
use org\bovigo\vfs\vfsStream;

/**
 * Class FileTest
 *
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-14
 */
class FileTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
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
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    public function testAppendContent()
    {
        $content = 'test content';
        $appendedContent = ' foobar';
        $this->createNewVfsStreamFile('foo.bar', $content);
        $file = $this->getNewFile(vfsStream::url('root/foo.bar'));
        $file->appendContent($appendedContent);
        $expectedContent = $content . $appendedContent;

        $this->assertSame($expectedContent, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
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
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    public function testPrependContent()
    {
        $content = 'test content';
        $prependContent = 'foobar ';
        $this->createNewVfsStreamFile('foo.bar', $content);
        $file = $this->getNewFile(vfsStream::url('root/foo.bar'));
        $file->prependContent($prependContent);
        $expectedContent = $prependContent . $content;

        $this->assertSame($expectedContent, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    public function testSetContent()
    {
        $content = 'test content';
        $this->createNewVfsStreamFile('foo.bar');
        $file = $this->getNewFile(vfsStream::url('root/foo.bar'));

        $this->assertSame('', $file->getContent());
        $file->setContent($content);
        $this->assertSame($content, $file->getContent());
        $this->assertSame('', file_get_contents(vfsStream::url('root/foo.bar')));
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     * @see http://stubbles.org/categories/5-vfsStream - no test for touch
     *  since this component should work also on php 5.3 so tests should
     *  also work at this version
     */
    public function testSave()
    {
        $content = 'test content';
        $this->createNewVfsStreamFile('foo.bar');
        $filesystem = $this->getNewFilesystemMock();
        $file = $this->getNewFile(
            vfsStream::url('root/foo.bar'),
            $filesystem
        );
        $file->setContent($content);
        $filesystem->shouldReceive('dumpFile')
            ->with(vfsStream::url('root/foo.bar'), $content)
            ->once();
        $file->save();

        $this->assertSame($content, $file->getContent());
    }

    /**
     * @param $path
     * @param null|\Net\Bazzline\Component\Filesystem\Filesystem $filesystem
     * @return File
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    private function getNewFile($path, $filesystem = null)
    {
        if (is_null($filesystem)) {
            $filesystem = $this->getNewFilesystemMock();
        }

        return new File($path, $filesystem);
    }
} 