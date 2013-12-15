<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class DirectoryOnlyFilter
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */
class DirectoryOnlyFilter implements FilterInterface
{
    /**
     * @param AbstractFilesystemObject $object
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function permit(AbstractFilesystemObject $object)
    {
        return ($object instanceof Directory);
    }
}