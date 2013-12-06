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
abstract class AbstractObject
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    protected $path;

    /**
     * @param string $path
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function __construct($path)
    {
        $this->path = (string) $path;
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