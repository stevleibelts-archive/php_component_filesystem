<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
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
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-09
 * @see http://www.php.net/manual/de/function.glob.php
 */
class Directory extends FilesystemObject
{
    /**
     * @param string $path
     * @param Filesystem $filesystem
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-09
     */
    public function __construct($path, $filesystem)
    {
        parent::__construct(rtrim($path, '/\\'), $filesystem);
    }

    /**
     * @param string $glob
     * @param FilesystemObjectCollection|FilterableFilesystemObjectCollection $collection
     * @return FilesystemObjectCollection|FilesystemObject[]
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-12-14
     */
    public function getContent($glob = '', FilesystemObjectCollection $collection = null)
    {
        if (is_null($collection)) {
            $collection = $this->filesystem->createEmptyFilesystemObjectCollection();
        }

        if (!$this->isNew()) {
            $iterator = $this->filesystem->createFilesystemIterator($this->getPathname(), $glob);
            foreach ($iterator as $splFileInfo) {
                /**
                 * @var SplFileInfo $splFileInfo
                 */
                $collection->attach($this->filesystem->createObjectFromPath($splFileInfo->getPathname()));
            }
        }

        return $collection;
    }
}