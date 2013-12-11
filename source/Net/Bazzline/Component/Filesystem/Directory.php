<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

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

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function isNew()
    {
        // TODO: Implement isNew() method.
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function isModified()
    {
        // TODO: Implement isModified() method.
    }

    /**
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function delete()
    {
        // TODO: Implement delete() method.
    }

    /**
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function save()
    {
        // TODO: Implement save() method.
    }
}