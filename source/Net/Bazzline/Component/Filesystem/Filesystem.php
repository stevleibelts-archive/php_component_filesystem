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
    public function copy($original, $target, $override = false)
    {
        $originalObject = ($original instanceof AbstractObject)
            ? $original : $this->createObjectFromPath($original);
        $targetObject = ($target instanceof AbstractObject)
            ? $target : $this->createObjectFromPath($target);

    }

    public function getPathObjectCollection($path, $options)
    {

    }

    /**
     * @param AbstractObject $objectOne
     * @param AbstractObject $objectTwo
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-08
     */
    private function assertSameObjectType(AbstractObject $objectOne, AbstractObject $objectTwo)
    {
        if ($objectOne instanceof File
            && $objectTwo instanceof File) {
            return true;
        } else if ($objectOne instanceof Directory
            && $objectTwo instanceof Directory) {
            return true;
        } else {
            throw new InvalidArgumentException(
                '$objectOne with instanceof "' . get_class($objectOne) . '"' .
                'and $objectTwo with instance of "' . get_class($objectTwo) .
                ' differ in their file type'
            );
        }
    }

    /**
     * @param string $path
     * @return AbstractObject|Directory|File
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
                'provided path "' . $path . '" is neither a directory nor file'
            );
        }
    }
}