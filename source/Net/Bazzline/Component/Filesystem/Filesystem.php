<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class Filesystem
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 * @todo chmod and so on as decorators?
 */
class Filesystem
{
    /**
     * @param string|AbstractFilesystemObject $source
     * @param string|AbstractFilesystemObject $destination
     * @param bool $override
     * @param bool $recursive
     * @return AbstractFilesystemObject|Directory|File
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-08
     * @todo implement stream_is_local?
     */
    public function copy($source, $destination, $override = false, $recursive = false)
    {
        $sourceObject = ($source instanceof AbstractFilesystemObject)
            ? $source : $this->createObjectFromPath($source);
        $destinationObject = ($destination instanceof AbstractFilesystemObject)
            ? $destination : $this->createSameObjectType($sourceObject, $destination);

        //to prevent if original and target are instance of AbstractObject
        $this->assertSameObjectType($sourceObject, $destinationObject);

        if (!$destinationObject->isNew()
            && !$override) {
            throw new RuntimeException(
                'can not copy to target since target exists'
            );
        }

        $copyFile = ($sourceObject instanceof File);

        if ($copyFile) {
            $this->copyFile($sourceObject, $destinationObject, $override);
        } else {
            $this->copyDirectory($sourceObject, $destinationObject, $override, $recursive);
        }

        if ($destinationObject->isNew()) {
            throw new RuntimeException(
                sprintf(
                    'Failed to copy %s to %s', $sourceObject->getPath(), $destinationObject->getPath()
                )
            );
        }

        return $destinationObject;
    }

    public function getPathObjectCollection($path, $options)
    {

    }

    private function copyFile(File $source, File $destination, $override = false)
    {
        //stream_is_local
        //todo copy file -> use copy_to_stream
        //copied from symfony file system copy
        $sourceFileHandler = fopen($source->getPath(), 'r');
        $targetFileHandler = fopen($destination->getPath(), 'w+');
        stream_copy_to_stream($sourceFileHandler, $targetFileHandler);
        fclose($sourceFileHandler);
        fclose($targetFileHandler);
    }

    private function copyDirectory($source, $destination, $override = false, $recursive = false)
    {

    }

    /**
     * @param AbstractFilesystemObject $objectOne
     * @param AbstractFilesystemObject $objectTwo
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-08
     */
    private function assertSameObjectType(AbstractFilesystemObject $objectOne, AbstractFilesystemObject $objectTwo)
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
    private function createSameObjectType(AbstractFilesystemObject $original, $targetPath)
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
    private function createObjectFromPath($path)
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