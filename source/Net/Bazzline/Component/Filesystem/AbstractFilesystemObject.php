<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

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
        $this->basePath = dirname($path);
        $this->filesystem = $filesystem;
        $this->name = basename($path);
        $this->path = (string) $path;
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
    abstract function isNew();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    abstract function isModified();

    /**
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    abstract function delete();

    /**
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    abstract function save();
}