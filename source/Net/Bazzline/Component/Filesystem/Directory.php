<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Class Directory
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-09
 */
class Directory extends AbstractFilesystemObject
{
    /**
     * @param string $path
     * @param Filesystem $filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-09
     */
    public function __construct($path, $filesystem)
    {
        parent::__construct(rtrim($path, '/\\'), $filesystem);
    }
}