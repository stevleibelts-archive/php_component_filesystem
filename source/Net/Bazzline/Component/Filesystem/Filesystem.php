<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use FilesystemIterator;
use GlobIterator;
use SplFileInfo;
use Symfony\Component\Filesystem\Filesystem as ParentClass;

/**
 * Class Filesystem
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */
class Filesystem extends ParentClass
{
    /**
     * @param AbstractFilesystemObject $objectOne
     * @param AbstractFilesystemObject $objectTwo
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-08
     */
    public function assertSameObjectType(AbstractFilesystemObject $objectOne, AbstractFilesystemObject $objectTwo)
    {
        if ($objectOne instanceof File
            && $objectTwo instanceof File) {
            return true;
        } else if ($objectOne instanceof Directory
            && $objectTwo instanceof Directory) {
            return true;
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    '$objectOne with instanceof "%s" and $objectTwo with ' .
                    'instance of "%s" differ in their file type',
                    get_class($objectOne),
                    get_class($objectTwo)
                )
            );
        }
    }

    /**
     * @param AbstractFilesystemObject $original
     * @param string $targetPath
     * @return Directory|File
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-08
     */
    public function createSameObjectType(AbstractFilesystemObject $original, $targetPath)
    {
        if ($original instanceof File) {
            return $this->createFileObject($targetPath);
        } else {
            return $this->createDirectoryObject($targetPath);
        }
    }

    /**
     * @param string $path
     * @return AbstractFilesystemObject|Directory|File
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-08
     */
    public function createObjectFromPath($path)
    {
        if (is_file($path)) {
            return $this->createFileObject($path);
        } else if (is_dir($path)) {
            return $this->createDirectoryObject($path);
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'provided path "%s" is neither a directory nor file', $path
                )
            );
        }
    }

    /**
     * @param SplFileInfo $item
     * @return AbstractFilesystemObject|Directory|File
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createObjectFromSplFileInfo(SplFileInfo $item)
    {
        return $this->createObjectFromPath($item->getPath());
    }

    /**
     * @param string $path
     * @param string $glob
     * @return FilesystemIterator|GlobIterator
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createFilesystemIterator($path, $glob = '')
    {
        $path = $this->removeTrailingSlashFromPath($path);

        return ($glob === '')
            ? new FilesystemIterator($path)
            : new GlobIterator($path . DIRECTORY_SEPARATOR . $glob);
    }

    /**
     * @return FilesystemObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createEmptyFilesystemObjectCollection()
    {
        return new FilesystemObjectCollection();
    }

    /**
     * @return FileObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createEmptyFileObjectCollection()
    {
        return new FileObjectCollection();
    }

    /**
     * @return DirectoryObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createEmptyDirectoryObjectCollection()
    {
        return new DirectoryObjectCollection();
    }

    /**
     * @param $path
     * @return Directory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createDirectoryObject($path)
    {
        return new Directory($this->removeTrailingSlashFromPath($path), $this);
    }

    /**
     * @param $path
     * @return File
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function createFileObject($path)
    {
        return new File($path, $this);
    }

    /**
     * @param $path
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    private function removeTrailingSlashFromPath($path)
    {
        return rtrim($path, '/\\');
    }
}