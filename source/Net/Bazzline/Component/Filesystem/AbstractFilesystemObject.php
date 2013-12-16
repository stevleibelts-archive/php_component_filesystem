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
     */
    public function __construct($path, Filesystem $filesystem)
    {
        $this->pathInfo = pathinfo($path);
        $basePath = $this->pathInfo['dirname'];
        $name = $this->pathInfo['basename'];
        parent::__construct($basePath . DIRECTORY_SEPARATOR . $name);
        $this->filesystem = $filesystem;
        $this->modificationTime = $this->getMTime();
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
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getName()
    {
        return $this->getFilename();
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
            return ($this->modificationTime !== $this->getMTime());
        }
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function isNew()
    {
        return (!file_exists($this->getPathname()));
    }

    /**
     * @throws IoException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function delete()
    {
        $this->filesystem->remove($this->getPathname());
    }

    /**
     * @return int|null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getATime()
    {
        return ($this->isNew()) ? null : parent::getATime();
    }

    /**
     * @return int|null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getCTime()
    {
        return ($this->isNew()) ? null : parent::getCTime();
    }

    /**
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function getMTime()
    {
        return ($this->isNew()) ? null : parent::getMTime();
    }

    /**
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function getPerms()
    {
        return ($this->isNew()) ? null : parent::getPerms();
    }

    /**
     * @return int|null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getInode()
    {
        return ($this->isNew()) ? null : parent::getInode();
    }

    /**
     * @return int|null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getGroup()
    {
        return ($this->isNew()) ? null : parent::getGroup();
    }

    /**
     * @return int|null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getOwner()
    {
        return ($this->isNew()) ? null : parent::getOwner();
    }

    /**
     * @return int|null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getSize()
    {
        return ($this->isNew()) ? null : parent::getSize();
    }

    /**
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-17
     */
    public function getType()
    {
        return ($this->isNew()) ? null : parent::getType();
    }
}