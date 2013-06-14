<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */
namespace Net\Bazzline\Component\Filesystem\Filesystem;

use InvalidArgumentException;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem as SymfonyFilesystem;

/**
 * Provides basic utility to manipulate the file system.
 *
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-04-25
 */
class Filesystem extends SymfonyFilesystem
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
    public function makeRelativePathToCurrentWorkingDirectory($path)
    {
        return $this->makePathRelative(getcwd(), $path);
    }

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
    public function makeCurrentWorkingDirectoryRelativeToPath($path)
    {
        return $this->makePathRelative($path, getcwd());
    }

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
            throw new InvalidArgumentException(
                'Provided start path is not a valid directory.'
            );
        }
        if (!is_dir($endRealPath)) {
            throw new InvalidArgumentException(
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
