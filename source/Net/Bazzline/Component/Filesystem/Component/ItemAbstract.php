<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem\Component;

use Net\Bazzline\Component\Filesystem\Filesystem\FilesystemAwareInterface;
use Net\Bazzline\Component\Filesystem\Filesystem\FilesystemInterface;
use Symfony\Component\Yaml\Exception\RuntimeException;

/**
 * Class FilesystemAbstract
 *
 * @package Net\Bazzline\Component\Filesystem\Component
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
abstract class ItemAbstract implements ItemInterface, FilesystemAwareInterface
{
    /**
     * @var null|string|int|array|ObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected $content;

    /**
     * @var null|\Net\Bazzline\Component\Filesystem\Filesystem\FilesystemInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    protected $filesystem;

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
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected function getRealPath()
    {
        if (is_null($this->name)) {
            throw new InputOutputException(
                'Name is not set'
            );
        }
        if (is_null($this->path)) {
            throw new InputOutputException(
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

    /**
     * {$inheritDoc}
     */
    public function getOwner()
    {
        return fileowner($this->getRealPath());
    }

    /**
     * {$inheritDoc}
     */
    public function setOwner($owner)
    {
        if (!$this->chown($owner)) {
            throw new RuntimeException(
                'Can not change owner.'
            );
        }

        return $this;
    }

    /**
     * {$inheritDoc}
     */
    public function isOwner($owner)
    {
        return ($this->getOwner() == $owner);
    }

    /**
     * {$inheritDoc}
     */
    public function getGroup()
    {
        return fileowner($this->getRealPath());
    }

    /**
     * {$inheritDoc}
     */
    public function setGroup($group)
    {
        if (!$this->chgrp($group)) {
            throw new RuntimeException(
                'Can not change group.'
            );
        }

        return $this;
    }

    /**
     * {$inheritDoc}
     */
    public function isGroup($group)
    {
        return ($this->getGroup() == $group);
    }

    /**
     * {$inheritDoc}
     */
    public function getPermission()
    {
        return fileperms($this->getRealPath());
    }

    /**
     * {$inheritDoc}
     */
    public function setPermission($permission)
    {
        if (strlen($permission == 3)) {
            $permission = '0' . $permission;
        }

        if (!$this->chmod($permission)) {
            throw new RuntimeException(
                'Can not change permission.'
            );
        }

        return $this;
    }

    /**
     * {$inheritDoc}
     */
    public function hasPermission($permission)
    {
        if (strlen($permission == 3)) {
            $permission = '0' . $permission;
        }

        return ($this->getPermission() == $permission);
    }

    /**
     * {$inheritDoc}
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * {$inheritDoc}
     */
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Changes mode of current item
     *
     * @param int $mode - the mode you want to set
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    protected  function chmod($mode)
    {
        return chmod($this->getRealPath(), $mode);
    }

    /**
     * Changes owner of current item
     *
     * @param string $owner - name of the owner
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    protected  function chown($owner)
    {
        return chown($this->getRealPath(), $owner);
    }

    /**
     * Changes group of current item
     *
     * @param string $group - name of the group
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    protected function chgrp($group)
    {
        return chgrp($this->getRealPath(), $group);
    }
}