<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-05-03
 */
namespace Test\Net\Bazzline\Component\Filesystem\Component;

use Net\Bazzline\Component\Filesystem\Component\File;
use org\bovigo\vfs\vfsStream;
use Test\Net\Bazzline\Component\Filesystem\UnitTestCase;

/**
 * We have to overwrite realpath since realpath is not working with vfsStream
 *
 * @param mixed $string - path
 *
 * @return string
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
function realpath($string)
{
    return (string) $string;
}

/**
 * Test class for Filesystem.
 *
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
class FileTest extends UnitTestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamFile
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private $file;

    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private $filesystem;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private $filename;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private $filePath;


    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function testConstructWithNoParameters()
    {
        $file = new File();

        $this->assertNull($file->getName());
        $this->assertNull($file->getPath());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testIsNew()
    {
        $this->setupFilesystem();
        $filePath = vfsStream::url('root' . DIRECTORY_SEPARATOR);
        $fileName = 'foo.bar';

        $newFile = new File($filePath, $fileName);
        $this->assertTrue($newFile->isNew());

        $this->setUpFile(null);
        $existingFile = new File($filePath, $fileName);
        $this->assertFalse($existingFile->isNew());
        $existingFile->setName($fileName . '.foobar');
        $this->assertTrue($existingFile->isNew());
        $existingFile->setName($fileName);
        $existingFile->setPath($filePath . DIRECTORY_SEPARATOR . 'foobar');
        $this->assertTrue($existingFile->isNew());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testSetAndGetContentWithEmptyFile()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $file = new File($this->filePath, $this->filename);
        $data = 'testdata' . PHP_EOL . 'two lines';

        $this->assertEquals('', $file->getContent());
        $file->setContent($data);
        $this->assertEquals($data, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testSetAndGetContentWithNotEmpty()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $data = 'testdata' . PHP_EOL . 'two lines';

        $this->setupFile($data);
        $file = new File($this->filePath, $this->filename);
        $this->assertEquals($data, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testAppendContentWithEmptyFile()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $file = new File($this->filePath, $this->filename);
        $data = 'testdata' . PHP_EOL . 'two lines';

        $file->appendContent($data);
        $this->assertEquals($data, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testAppendContentWithNotEmptyFile()
    {
        $data = 'testdata' . PHP_EOL . 'two lines';
        $this->setupFilesystem();
        $this->setupFile($data);
        $file = new File($this->filePath, $this->filename);
        $newData = PHP_EOL . 'new data';

        $file->appendContent($newData);
        $this->assertEquals($newData . $data, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testPrependContentWithEmptyFile()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $file = new File($this->filePath, $this->filename);
        $data = 'testdata' . PHP_EOL . 'two lines';

        $file->prependContent($data);
        $this->assertEquals($data, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testPrependContentWithNotEmptyFile()
    {
        $data = 'testdata' . PHP_EOL . 'two lines';
        $this->setupFilesystem();
        $this->setupFile($data);
        $file = new File($this->filePath, $this->filename);
        $newData = PHP_EOL . 'new data';

        $file->prependContent($newData);
        $this->assertEquals($data . $newData, $file->getContent());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testName()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $file = new File($this->filePath, $this->filename);
        $newName = $this->filename . '.foobar';

        $this->assertEquals($this->filename, $file->getName());
        $file->setName($newName);
        $this->assertEquals($newName, $file->getName());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testPath()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $file = new File($this->filePath, $this->filename);
        $newPath = $this->filePath . DIRECTORY_SEPARATOR . 'foobar';

        $this->assertEquals($this->filePath, $file->getPath());
        $file->setPath($newPath);
        $this->assertEquals($newPath, $file->getPath());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testTouch()
    {
        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $file = new File($filePath, $filename);

        $this->assertTrue($file->touch());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage File exists, use overwrite to force writing
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testWriteWithExistingFile()
    {
        $this->setupFilesystem();
        $this->setupFile('existing data');
        $file = new File($this->filePath, $this->filename);

        $file->write();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testWriteWithNewFile()
    {
        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $file = new File($filePath, $filename);
        $data = 'testdata';
        $file->setContent($data);

        $this->assertEquals((strlen($data)), $file->write());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testOverwrite()
    {
        $data = 'testdata';
        $this->setupFilesystem();
        $this->setupFile($data);
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertEquals((strlen($data)), $existingFile->overwrite());
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);
        $newFile->setContent($data);

        $this->assertEquals((strlen($data)), $newFile->overwrite());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testReadWithExistingFile()
    {
        $data = 'testdata';
        $this->setupFilesystem();
        $this->setupFile($data);
        $file = new File($this->filePath, $this->filename);

        $this->assertEquals($data, $file->read());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage File is not readable
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testReadWithNotReadableFile()
    {
        $data = 'testdata';
        $this->setupFilesystem();
        $this->setupFile($data, 0300);
        $file = new File($this->filePath, $this->filename);

        $file->read();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You can not read from a file that does not exist.
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testReadWithNewFile()
    {
        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $file = new File($filePath, $filename);

        $file->read();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testGetModificationTime()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $timestamp = time();
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($timestamp, $existingFile->getModificationTime());
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertNull($newFile->getModificationTime());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testGetModificationDate()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $dateFormat = 'Y-m-d H:i:s';
        $date = date($dateFormat, time());
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($date, $existingFile->getModificationDate($dateFormat));
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertNull($newFile->getModificationDate());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testGetLastAccessTime()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $timestamp = time();
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($timestamp, $existingFile->getLastAccessTime());
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertNull($newFile->getLastAccessTime());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testGetLastAccessDate()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $dateFormat = 'Y-m-d H:i:s';
        $date = date($dateFormat, time());
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($date, $existingFile->getLastAccessDate($dateFormat));
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertNull($newFile->getLastAccessDate());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-09
     */
    public function testGetCreateTime()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $timestamp = time();
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($timestamp, $existingFile->getCreateTime());
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertNull($newFile->getCreateTime());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-09
     */
    public function testGetCreateDate()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $dateFormat = 'Y-m-d H:i:s';
        $date = date($dateFormat, time());
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($date, $existingFile->getCreateDate($dateFormat));
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertNull($newFile->getCreateDate());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testIsWriteable()
    {
        $this->setupFilesystem();
        $this->setupFile(null, 0200);
        $writeableFile = new File($this->filePath, $this->filename);

        $this->assertTrue($writeableFile->isWriteable());

        $this->removeFile();
        $this->setupFile(null, 0000);
        $notWriteableFile = new File($this->filePath, $this->filename);

        $this->assertFalse($notWriteableFile->isWriteable());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testIsReadable()
    {
        $this->setupFilesystem();
        $this->setupFile(null, 0400);
        $readableFile = new File($this->filePath, $this->filename);

        $this->assertTrue($readableFile->isReadable());

        $this->removeFile();
        $this->setupFile(null, 0000);
        $notReadableFile = new File($this->filePath, $this->filename);

        $this->assertFalse($notReadableFile->isReadable());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testIsExecutable()
    {
        $this->setupFilesystem();
        $this->setupFile(null, 0100);
        $executableFile = new File($this->filePath, $this->filename);

        $this->assertTrue($executableFile->isExecutable());

        $this->removeFile();
        $this->setupFile(null, 0000);
        $notExecutableFile = new File($this->filePath, $this->filename);

        $this->assertFalse($notExecutableFile->isExecutable());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private function setupFilesystem()
    {
        $this->filesystem = vfsStream::setup('root');
    }

    /**
     * @param null|string $content - content of the file
     * @param integer $chmod - chmod
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private function setupFile($content = null, $chmod = 0700)
    {
        $filename = 'foo.bar';
        $this->filename = $filename;
        $this->file = vfsStream::newFile($this->filename);
        $this->file->chmod($chmod);
        $this->file->withContent($content)
            ->at($this->filesystem);
        $this->filesystem->addChild($this->file);
        $this->filePath = vfsStream::url('root');
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private function removeFile()
    {
        $this->filesystem->removeChild($this->file);
    }
}
