<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */
namespace Net\Bazzline\Component\Filesystem;

use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

/**
 * Provides basic utility to manipulate the file system.
 *
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-04-25
 */
class Filesystem extends SymfonyFilesystem implements FilesystemInterface
{
    /**
     * {$inheritDoc}
     */
    public function delete(ItemCollection $items)
    {
        // TODO: Implement delete() method.
    }

    /**
     * {$inheritDoc}
     */
    public function move(ItemInterface $source, ItemInterface $destination, $override = false)
    {
        // TODO: Implement move() method.
    }

    /**
     * {$inheritDoc}
     */
    public function changeOwner(ItemCollection $items, $owner, $recursive = false)
    {
        // TODO: Implement changeOwner() method.
    }

    /**
     * {$inheritDoc}
     */
    public function changeGroup(ItemCollection $items, $group, $recursive = false)
    {
        // TODO: Implement changeGroup() method.
    }

    /**
     * {$inheritDoc}
     */
    public function changePermission(ItemCollection $items, $permission = 000, $recursive = false)
    {
        // TODO: Implement changePermission() method.
    }

    /**
     * {$inheritDoc}
     */
    public function createItem($path, $permission = 0777)
    {
        // TODO: Implement createItem() method.
    }

    /**
     * {$inheritDoc}
     */
    public function loadItem($path)
    {
        // TODO: Implement loadItem() method.
    }

    /**
     * {$inheritDoc}
     */
    public function makeRelativePathToCurrentWorkingDirectory($path)
    {
        return $this->makePathRelative(getcwd(), $path);
    }

    /**
     * {$inheritDoc}
     */
    public function makeCurrentWorkingDirectoryRelativeToPath($path)
    {
        return $this->makePathRelative($path, getcwd());
    }

    /**
     * {$inheritDoc}
     */
    public function makePathRelative($startPath, $endPath)
    {
        // Normalize separators on windows
        if (defined('PHP_WINDOWS_VERSION_MAJOR')) {
            $osIndependentEndPath = strtr($endPath, '\\', '/');
            $osIndependentStartPath = strtr($startPath, '\\', '/');
        } else {
            $osIndependentEndPath = $endPath;
            $osIndependentStartPath = $startPath;
        }

        $startRealPath = realpath($osIndependentStartPath);
        $endRealPath = realpath($osIndependentEndPath);

        if (!is_dir($startRealPath)) {
            throw new InputOutputException(
                'Provided start path is not a valid directory.'
            );
        }
        if (!is_dir($endRealPath)) {
            throw new InputOutputException(
                'Provided end path is not a valid directory.'
            );
        }

        $startRealPathAsArray = explode(DIRECTORY_SEPARATOR, $startRealPath);
        $endRealPathAsArray = explode(DIRECTORY_SEPARATOR, $endRealPath);

        $relativeStartRealPathAsArray = array_diff(
            $startRealPathAsArray,
            $endRealPathAsArray
        );
        $relativeEndRealPathAsArray = array_diff(
            $endRealPathAsArray,
            $startRealPathAsArray
        );

        $numberOfSubDirectoriesFromRelativeStartPath = count($relativeStartRealPathAsArray);

        $relativePath = str_repeat(
            '..' . DIRECTORY_SEPARATOR,
            $numberOfSubDirectoriesFromRelativeStartPath
        ) . implode(DIRECTORY_SEPARATOR, $relativeEndRealPathAsArray);

        return $relativePath;
    }
}
