<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use SplFileInfo;
use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Class AbstractObject
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */
abstract class AbstractFilesystemObject extends SplFileInfo
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-07
     */
    protected $basePath;

    /**
     * @var Filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-11
     */
    protected $filesystem;

    /**
     * @var int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-11
     */
    protected $modificationTime;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-07
     */
    protected $name;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    protected $path;

    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    protected $pathInfo;

    /**
     * @param string $path
     * @param Filesystem $filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     * @todo remove unneeded methods
     */
    public function __construct($path, Filesystem $filesystem)
    {
        $this->pathInfo = pathinfo($path);
        $this->basePath = $this->pathInfo['dirname'];
        $this->name = $this->pathInfo['basename'];
        parent::__construct($this->basePath . DIRECTORY_SEPARATOR . $this->name);
        $this->path = (string) $path;
        $this->filesystem = $filesystem;
        $this->modificationTime = $this->getModificationTime();
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @return Filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-11
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-11
     */
    public function getModificationTime()
    {
        if ($this->isNew()) {
            return 0;
        } else {
            return filemtime($this->path);
        }
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function isModified()
    {
        if ($this->isNew()) {
            return true;
        } else {
            return ($this->modificationTime !== $this->getModificationTime());
        }
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function isNew()
    {
        return (!file_exists($this->path));
    }

    /**
     * @throws IoException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function delete()
    {
        $this->filesystem->remove($this->path);
    }
}