<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FileObjectCollection
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */
class FileObjectCollection extends FilesystemObjectCollection
{
    /**
     * @param object $object
     * @param null|mixed $data
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function attach($object, $data = null)
    {
        if ($object instanceof File) {
            parent::attach($object, $data);
        }
    }
} 