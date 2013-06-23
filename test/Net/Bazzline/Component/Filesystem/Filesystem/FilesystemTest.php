<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-05-03
 */
namespace Test\Net\Bazzline\Component\Filesystem\Filesystem;

use Net\Bazzline\Component\Filesystem\Filesystem\Filesystem;
use ReflectionClass;
use Test\Net\Bazzline\Component\Filesystem\UnitTestCase;

/**
 * Test class for Filesystem.
 */
class FilesystemTest extends UnitTestCase
{
    /**
     * @var string $workspace
     */
    private $workspace = null;

    /**
     * @var \Net\Bazzline\Component\Filesystem\Filesystem\Filesystem $filesystem
     */
    private $filesystem = null;

    private static $symlinkOnWindows = null;

    public static function setUpBeforeClass()
    {
        if (defined('PHP_WINDOWS_VERSION_MAJOR')) {
            self::$symlinkOnWindows = true;
            $originDir = tempnam(sys_get_temp_dir(), 'sl');
            $targetDir = tempnam(sys_get_temp_dir(), 'sl');
            if (true !== @symlink($originDir, $targetDir)) {
                $report = error_get_last();
                if (is_array($report) && false !== strpos($report['message'], 'error code(1314)')) {
                    self::$symlinkOnWindows = false;
                }
            }
        }
    }

    public function setUp()
    {
        $this->filesystem = new Filesystem();
        $this->workspace = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . time() . rand(0, 1000);
        mkdir($this->workspace, 0777, true);
        $this->workspace = realpath($this->workspace);
    }

    public function tearDown()
    {
        $this->clean($this->workspace);
    }

    /**
     * @param string $file
     */
    private function clean($file)
    {
        if (is_dir($file) && !is_link($file)) {
            $dir = new \FilesystemIterator($file);
            foreach ($dir as $childFile) {
                $this->clean($childFile);
            }

            rmdir($file);
        } else {
            unlink($file);
        }
    }

    /**
     * @return array
     * @todo use $this->workspace to create some more testcases
     */
    public function providePathsForMakePathRelative()
    {
        $filesystemReflection = new ReflectionClass('Net\\Bazzline\\Component\\Filesystem\\Filesystem\\Filesystem');

        $realPathOfTestFile = dirname(__FILE__);
        $realPathOfTestedFile = dirname($filesystemReflection->getFileName());
        $relativePathToTestedFile = '..' . DIRECTORY_SEPARATOR;
        $relativePathToTestFile = 'tests';

        $paths = array(
            //$endPath, $startPath, $expectedPath
            array($realPathOfTestFile, $realPathOfTestFile, ''),
            array($realPathOfTestFile . DIRECTORY_SEPARATOR, $realPathOfTestFile, ''),
            array($realPathOfTestFile, $realPathOfTestFile . DIRECTORY_SEPARATOR, ''),
            array($realPathOfTestFile . DIRECTORY_SEPARATOR, $realPathOfTestFile . DIRECTORY_SEPARATOR, ''),
            array($realPathOfTestFile, $realPathOfTestedFile, $relativePathToTestedFile),
            array($realPathOfTestFile . DIRECTORY_SEPARATOR, $realPathOfTestedFile, $relativePathToTestedFile),
            array($realPathOfTestFile, $realPathOfTestedFile . DIRECTORY_SEPARATOR, $relativePathToTestedFile),
            array($realPathOfTestFile . DIRECTORY_SEPARATOR, $realPathOfTestedFile . DIRECTORY_SEPARATOR, $relativePathToTestedFile),
            array($realPathOfTestedFile, $realPathOfTestFile, $relativePathToTestFile)
        );

        if (defined('PHP_WINDOWS_VERSION_MAJOR')) {
//not testable here since no windows available
        }

        return $paths;
    }

    /**
     * @dataProvider providePathsForMakePathRelative
     */
    public function testMakePathRelative($endPath, $startPath, $expectedPath)
    {
        $path = $this->filesystem->makePathRelative($endPath, $startPath);

        $this->assertEquals($expectedPath, $path);
    }
}