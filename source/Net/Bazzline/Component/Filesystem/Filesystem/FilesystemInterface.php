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
     * Copies a file.
     *
     * This method only copies the file if the origin file is newer than the target file.
     *
     * By default, if the target already exists, it is not overridden.
     *
     * @param string  $sourceFile The original filename
     * @param string  $targetFile The target filename
     * @param boolean $override   Whether to override an existing file or not
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function copy($sourceFile, $targetFile, $override = false);

    /**
     * Creates a directory recursively
     *
     * @param string|array|\Traversable $directories
     * @param int $mode
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     * @todo add recursive directory creation
     */
    public function mkdir($directories, $mode = 0777);

    public function touch($files, $time = null, $atime = null);

    public function remove($files);

    public function chmod($files, $mod, $umask = 000, $recursive = false);

    public function chwon($files, $user, $recursive = false);

    public function chgro($files, $group, $recursive = false);

    public function rename($source, $target);

    public function symlink($sourceDirectory, $targetDirectory, $copyOnWindows = false);

    public function mirror($sourceDirectory, $targetDirectory, Traversable $iterator = null, $options = array());

    public function makePathRelative($endPath, $startPath);

    public function isAbsolutePath($object);

    /**
     * Returns relative $path path to current working directory
     *
     * @param string $path - the path that has to be converted into a relative
     *  path from the current working directory
     *
     * @return string
     * @throws InvalidArgumentException;
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
     * @throws InvalidArgumentException;
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
     * @throws InvalidArgumentException;
     * @author stev leibelt
     * @since 2013-04-25
     */
    public function makePathRelative($startPath, $endPath);
}