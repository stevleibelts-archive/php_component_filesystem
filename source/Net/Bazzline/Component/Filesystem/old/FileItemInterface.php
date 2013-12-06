<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-06-21
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FileItemInterface
 * Generic interface for file item
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-21
 */
interface FileItemInterface extends ItemInterface
{
    /**
     * Returns extension by using the provided name.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-21
     */
    public function getExtension();
}
