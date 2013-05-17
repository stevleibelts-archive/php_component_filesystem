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
abstract class FilesystemAbstract implements FilessystemInterface
{
    /**
     * @var null|string|int|array|FilesystemCollection
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
     * Sets the name of the file.
     *
     * @param string $name - name of the file.
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Gets the name of the file.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the path of the file.
     *
     * @param string $path - path of the file.
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function setPath($path)
    {
        $this->path = (string) $path;
    }

    /**
     * Gets the path of the file.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getPath()
    {
        return $this->path;
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
}