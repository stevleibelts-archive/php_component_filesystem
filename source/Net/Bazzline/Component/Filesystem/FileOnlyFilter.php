<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FileOnlyFilter
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */
class FileOnlyFilter implements FilterInterface
{
    /**
     * @param FilesystemObject $object
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function permit(FilesystemObject $object)
    {
        return ($object instanceof File);
    }
}