<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use FilesystemIterator;
use GlobIterator;
use SplFileInfo;
use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Class Directory
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-09
 * @see http://www.php.net/manual/de/function.glob.php
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
     * @param string $glob
     * @param FilesystemObjectCollection|FileObjectCollection|DirectoryObjectCollection $collection
     * @return FilesystemObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    public function getContent($glob = '', FilesystemObjectCollection $collection = null)
    {
        $iterator = $this->filesystem->createFilesystemIterator($this->path, $glob);
        if (is_null($collection)) {
            $collection = $this->filesystem->createEmptyFilesystemObjectCollection();
        }

        foreach ($iterator as $splFileInfo) {
            /**
             * @var SplFileInfo $splFileInfo
             */
            $collection->attach($this->filesystem->createObjectFromPath($splFileInfo->getPath()));
        }

        return $collection;
    }
}