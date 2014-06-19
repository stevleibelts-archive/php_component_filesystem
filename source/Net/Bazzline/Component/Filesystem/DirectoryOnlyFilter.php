<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-16
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class DirectoryOnlyFilter
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-16
 */
class DirectoryOnlyFilter implements FilterInterface
{
    /**
     * @param FilesystemObject $object
     * @return bool
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-16
     */
    public function permit(FilesystemObject $object)
    {
        return ($object instanceof Directory);
    }
}