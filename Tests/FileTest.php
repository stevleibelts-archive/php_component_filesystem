<?php

namespace Net\Bazzline\Component\Filesystem;

use org\bovigo\vfs\vfsStream;
use PHPUnit_Framework_TestCase;

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
class FileTest extends PHPUnit_Framework_TestCase
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
        $this->assertEquals('', $file->getContent());
        $this->assertFalse($file->isExecutable());
        $this->assertTrue($file->isNew());
        $this->assertFalse($file->isReadable());
        $this->assertFalse($file->isWriteable());
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
    public function testContent()
    {
        $this->setupFilesystem();
        $this->setupFile();
        $emptyFile = new File($this->filePath, $this->filename);
        $data = 'testdata' . PHP_EOL . 'two lines';

        $this->assertEquals('', $emptyFile->getContent());
        $emptyFile->setContent($data);
        $this->assertEquals($data, $emptyFile->getContent());

        $this->removeFile();
        $this->setupFile($data);
        $notEmptyFile = new File($this->filePath, $this->filename);
        $this->assertEquals($data, $notEmptyFile->getContent());
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
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    public function testWrite()
    {
        $this->setupFilesystem();
        $this->setupFile('existing data');
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertFalse($existingFile->write());
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);
        $data = 'testdata';
        $newFile->setContent($data);

        $this->assertEquals((strlen($data)), $newFile->write());
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
    public function testRead()
    {
        $data = 'testdata';
        $this->setupFilesystem();
        $this->setupFile($data);
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertTrue($existingFile->read());
        $this->removeFile();

        $this->setupFilesystem();
        $filename = 'touchedFile';
        $filePath = vfsStream::url('root');
        $newFile = new File($filePath, $filename);

        $this->assertFalse($newFile->read());
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
        $date = date('Y-m-d H:i:s', time());
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($date, $existingFile->getModificationDate());
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
        $date = date('Y-m-d H:i:s', time());
        $existingFile = new File($this->filePath, $this->filename);

        $this->assertGreaterThanOrEqual($date, $existingFile->getLastAccessTime());
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
