<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-15 
 */

namespace Net\Bazzline\Component\Filesystem\Filesystem;

/**
 * Class FilesystemInterface
 *
 * @package Net\Bazzline\Component\Filesystem\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-15
 */
interface FilesystemInterface
{
    /**
     * Returns relative $path path to current working directory
     *
     * @param string $path - the path that has to be converted into a relative
     *  path from the current working directory
     *
     * @return string
     * @throws \InvalidArgumentException;
     * @author stev leibelt
     * @since 2013-04-25
     */
    public function makeRelativePathToCurrentWorkingDirectory($path);

    /**
     * Returns relative current working directory path to path
     *
     * @param string $path - the path where the current working directory has
     *  to be made relative
     *
     * @return string
     * @throws \InvalidArgumentException;
     * @author stev leibelt
     * @since 2013-04-25
     */
    public function makeCurrentWorkingDirectoryRelativeToPath($path);

    /**
     * Converts given $endPath to a relative path to $startPath
     *
     * @param string $startPath - the path where $endPath should be relative to
     * @param string $endPath - the path that should be relative to $startPath
     *
     * @return string
     * @throws \InvalidArgumentException;
     * @author stev leibelt
     * @since 2013-04-25
     */
    public function makePathRelative($startPath, $endPath);
}