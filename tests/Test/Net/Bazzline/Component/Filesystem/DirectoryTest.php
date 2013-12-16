<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16 
 */

namespace Test\Net\Bazzline\Component\Filesystem;

use Net\Bazzline\Component\Filesystem\Directory;
use org\bovigo\vfs\vfsStream;

/**
 * Class DirectoryTest
 * @package Test\Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */
class DirectoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function testContent()
    {
        $structure = array(
            'fileOne' => 'content one',
            'directoryOne' => array(
                'directoryOneTwo' => array(
                    'fileOneTwoOne' => 'content one two one'
                ),
                'fileOneOne' => 'content one one'
            ),
            'fileTwo' => 'content two'
        );
        vfsStream::create($structure);

        $expectedPathNames = array();
        $expectedPathNames[] = vfsStream::url('root/directoryOne/directoryOneTwo');
        $expectedPathNames[] = vfsStream::url('root/directoryOne/fileOneOne');
        $pathNames = array();

        $directory = $this->getNewDirectory(vfsStream::url('root/directoryOne'), $this->getNewFilesystem());

        foreach ($directory->getContent() as $object) {
            $pathNames[] = $object->getPathname();
        }

        $this->assertEquals($expectedPathNames, $pathNames);
    }

    /**
     * @param $path
     * @param null|\Net\Bazzline\Component\Filesystem\Filesystem $filesystem
     * @return Directory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    private function getNewDirectory($path, $filesystem = null)
    {
        if (is_null($filesystem)) {
            $filesystem = $this->getNewFilesystemMock();
        }

        return new Directory($path, $filesystem);
    }
} 