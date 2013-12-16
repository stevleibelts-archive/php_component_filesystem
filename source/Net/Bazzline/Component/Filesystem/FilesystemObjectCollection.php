<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use SplObjectStorage;

/**
 * Class ObjectCollection
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */
class FilesystemObjectCollection extends SplObjectStorage
{
    /**
     * @param AbstractFilesystemObject $object
     * @param null $data
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function attach(AbstractFilesystemObject $object, $data = null)
    {
        parent::attach($object, $data);
    }
}