<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

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
            return new File($targetPath);
        } else {
            return new Directory($targetPath);
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
            return new File($path);
        } else if (is_dir($path)) {
            return new Directory($path);
        } else {
            throw new InvalidArgumentException(
                sprintf(
                    'provided path "%s" is neither a directory nor file', $path
                )
            );
        }
    }
}