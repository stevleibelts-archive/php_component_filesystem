<?php

namespace Net\Bazzline\Component\Filesystem;

use InvalidArgumentException;

/**
 * Class FilesystemAbstract
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
abstract class ObjectAbstract implements ObjectInterface
{
    /**
     * @var null|string|int|array|ObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected $content;

    /**
     * @var null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected  $name;

    /**
     * @var null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected  $path;

    /**
     * {$inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {$inheritDoc}
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    /**
     * {$inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {$inheritDoc}
     */
    public function setPath($path)
    {
        $this->path = (string) $path;

        return $this;
    }


    /**
     * {$inheritDoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {$inheritDoc}
     */
    public function getModificationDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getModificationTime());
    }

    /**
     * {$inheritDoc}
     */
    public function getAccessDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getAccessTime());
    }

    /**
     * {$inheritDoc}
     */
    public function getCreateDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getCreateTime());
    }

    /**
     * Returns real path for given path and name.
     *
     * @return string
     * @throws \InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected function getRealPath()
    {
        if (is_null($this->name)) {
            throw new InvalidArgumentException(
                'Name is not set'
            );
        }
        if (is_null($this->path)) {
            throw new InvalidArgumentException(
                'Path is not set'
            );
        }
        $filePath = $this->path . DIRECTORY_SEPARATOR . $this->name;

        return realpath($filePath);
    }

    /**
     * {$inheritDoc}
     */
    public function isNew()
    {
        return (!file_exists(realpath($this->getRealPath())));
    }

    /**
     * {$inheritDoc}
     */
    public function isReadable()
    {
        return is_readable($this->getRealPath());
    }

    /**
     * {$inheritDoc}
     */
    public function isWritable()
    {
        return is_writable($this->getRealPath());
    }

    /**
     * {$inheritDoc}
     */
    public function isExecutable()
    {
        return is_executable($this->getRealPath());
    }
}