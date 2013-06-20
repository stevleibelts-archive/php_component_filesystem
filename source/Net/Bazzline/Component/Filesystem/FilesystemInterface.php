<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-15 
 */

namespace Net\Bazzline\Component\Filesystem;

use Traversable;

/**
 * Class FilesystemInterface
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-06-15
 */
interface FilesystemInterface
{
    public function copy(ItemInterface $source, ItemInterface $target, $override = false);

    public function delete(ItemCollection $items);

    public function move(ItemInterface $source, ItemInterface $destination, $override = false);

    public function changeOwner(ItemCollection $items, $owner, $recursive = false);

    public function changeGroup(ItemCollection $items, $group, $recursive = false);

    public function changePermission(ItemCollection $items, $permission = 000, $recursive = false);

    public function createItem($path, $permission = 0777);

    public function loadItem($path);

    /**
     * Returns relative $path path to current working directory
     *
     * @param string $path - the path that has to be converted into a relative
     *  path from the current working directory
     *
     * @return string
     * @throws InputOutputException;
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
     * @throws InputOutputException;
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
     * @throws InputOutputException;
     * @author stev leibelt
     * @since 2013-04-25
     */
    public function makePathRelative($startPath, $endPath);
}