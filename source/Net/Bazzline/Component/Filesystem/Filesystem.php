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