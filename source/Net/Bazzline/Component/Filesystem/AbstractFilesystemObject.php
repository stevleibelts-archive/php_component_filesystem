<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Class AbstractObject
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */
abstract class AbstractFilesystemObject
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
     * @param string $path
     * @param Filesystem $filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function __construct($path, Filesystem $filesystem)
    {
        //@todo what about pathinfo? http://www.php.net/manual/de/function.pathinfo.php
        $this->basePath = dirname($path);
        $this->filesystem = $filesystem;
        $this->name = basename($path);
        $this->path = (string) $path;
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