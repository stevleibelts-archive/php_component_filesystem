<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FilesystemAbstract
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 * @todo implement clone method
 */
abstract class ItemAbstract implements ItemInterface, FilesystemAwareInterface
{
    /**
     * @var null|string|int|array|ItemCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    protected $content;

    /**
     * @var null|\Net\Bazzline\Component\Filesystem\FilesystemInterface
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
     * @var null|boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-17
     */
    private  $isModified;

    /**
     * Setup for the object.
     *
     * @param string $path - path to the file
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function __construct($path)
    {
        if (is_null($path)) {
            throw new InputOutputException(
                'No path provided.'
            );
        }

        $pathWithoutTrailingSlash = ($this->pathEndsWithDirectorySeparator($path)) ?
            (substr($path, 0, -(strlen(DIRECTORY_SEPARATOR)))) : $path;
        $pathAsArray = pathinfo($pathWithoutTrailingSlash);
        $this->setPath($pathAsArray['dirname']);
        $this->setName($pathAsArray['filename']);
        if (!$this->isNew()) {
            $this->load();
        }
    }

    /**
     * {$inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {$inheritdoc}
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    /**
     * {$inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {$inheritdoc}
     */
    public function setPath($path)
    {
        if ($this->isRelativePath($path)) {
            $path = realpath(getcwd() . $path);
        }
        $this->path = (string) $path;

        return $this;
    }


    /**
     * {$inheritdoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {$inheritdoc}
     */
    public function getModificationTime()
    {
        return ($this->isNew()) ? null : filemtime($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function getModificationDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getModificationTime());
    }

    /**
     * {$inheritdoc}
     */
    public function getAccessTime()
    {
        return ($this->isNew()) ? null : fileatime($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function getAccessDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getAccessTime());
    }

    /**
     * {$inheritdoc}
     */
    public function getCreateTime()
    {
        return ($this->isNew()) ? null : filectime($this->getRealPath());
    }

    /**
     * {$inheritdoc}
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
     * {$inheritdoc}
     */
    public function isNew()
    {
        return (!file_exists(realpath($this->getRealPath())));
    }

    /**
     * {$inheritdoc}
     */
    public function isReadable($userGroup = 'u')
    {
        return is_readable($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function setIsReadable($userGroup = 'u')
    {
        if (!$this->isReadable()) {
            $mode = $this->getCurrentMode();

            return $this->chmod(($mode + 400));
        } else {
            return true;
        }
    }

    /**
     * {$inheritdoc}
     */
    public function unsetIsReadable($userGroup = 'u')
    {
        if ($this->isReadable()) {
            $mode = $this->getCurrentMode();

            return $this->chmod(($mode - 400));
        } else {
            return true;
        }
    }

    /**
     * {$inheritdoc}
     */
    public function isWritable($userGroup = 'u')
    {
        return is_writable($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function setIsWritable($userGroup = 'u')
    {
        if (!$this->isWritable()) {
            $mode = $this->getCurrentMode();

            return $this->chmod(($mode + 200));
        } else {
            return true;
        }
    }

    /**
     * {$inheritdoc}
     */
    public function unsetIsWritable($userGroup = 'u')
    {
        if ($this->isWritable()) {
            $mode = $this->getCurrentMode();

            return $this->chmod(($mode - 200));
        } else {
            return true;
        }
    }

    /**
     * {$inheritdoc}
     */
    public function isExecutable($userGroup = 'u')
    {
        return is_executable($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function setIsExecutable($userGroup = 'u')
    {
        if (!$this->isExecutable()) {
            $mode = $this->getCurrentMode();

            return $this->chmod(($mode + 100));
        } else {
            return true;
        }
    }

    /**
     * {$inheritdoc}
     */
    public function unsetIsExecutable($userGroup = 'u')
    {
        if ($this->isExecutable()) {
            $mode = $this->getCurrentMode();

            return $this->chmod(($mode - 100));
        } else {
            return true;
        }
    }

    /**
     * {$inheritdoc}
     */
    public function getOwner()
    {
        return fileowner($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function setOwner($owner)
    {
        if (!$this->chown($owner)) {
            throw new InputOutputException(
                'Can not change owner.'
            );
        }

        return $this;
    }

    /**
     * {$inheritdoc}
     */
    public function isOwner($owner)
    {
        return ($this->getOwner() == $owner);
    }

    /**
     * {$inheritdoc}
     */
    public function getGroup()
    {
        return fileowner($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function setGroup($group)
    {
        if (!$this->chgrp($group)) {
            throw new InputOutputException(
                'Can not change group.'
            );
        }

        return $this;
    }

    /**
     * {$inheritdoc}
     */
    public function isGroup($group)
    {
        return ($this->getGroup() == $group);
    }

    /**
     * {$inheritdoc}
     */
    public function getPermissions()
    {
        return fileperms($this->getRealPath());
    }

    /**
     * {$inheritdoc}
     */
    public function setPermissions($permission)
    {
        if (strlen($permission == 3)) {
            $permission = '0' . $permission;
        }

        if (!$this->chmod($permission)) {
            throw new InputOutputException(
                'Can not change permission.'
            );
        }

        return $this;
    }

    /**
     * {$inheritdoc}
     */
    public function hasPermission($permission)
    {
        if (strlen($permission == 3)) {
            $permission = '0' . $permission;
        }

        return ($this->getPermissions() == $permission);
    }

    /**
     * {$inheritdoc}
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * {$inheritdoc}
     */
    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * {$inheritdoc}
     */
    public function isModified()
    {
        return ((!is_null($this->isModified)) && ($this->isModified));
    }

    /**
     * {$inheritdoc}
     */
    public function hasContent()
    {
        return (!is_null($this->content));
    }

    /**
     * {$inheritdoc}
     */
    public function isFile()
    {
        return ($this instanceof FileItemInterface);
    }

    /**
     * {$inheritdoc}
     */
    public function isDirectory()
    {
        return ($this instanceof DirectoryItemInterface);
    }

    /**
     * {$inheritdoc}
     */
    public function save($override = false)
    {
        // TODO: Implement save() method.
    }

    /**
     * {$inheritdoc}
     */
    public function delete()
    {
        return unlink($this->getRealPath());
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

    /**
     * Validates if given path is relative or not
     *
     * @param string $path - path to validate
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-17
     */
    protected function isRelativePath($path)
    {
        $startsWith = DIRECTORY_SEPARATOR;
        $lengthOfStartsWith = strlen($startsWith);
        $startOfString = substr($path, 0, $lengthOfStartsWith);

        return ($startOfString == $startsWith);
    }

    /**
     * Validates if given path ends with a directory separator
     *
     * @param string $path - the path to validate
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-17
     */
    protected function pathEndsWithDirectorySeparator($path)
    {
        $endsWith = DIRECTORY_SEPARATOR;
        $lengthOfEndsWith = strlen($endsWith);
        $stringEnding = substr($path, -$lengthOfEndsWith);

        return ($stringEnding == $endsWith);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-17
     */
    protected function setModifiedFlag()
    {
        $this->isModified = true;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-17
     */
    protected function unsetModifiedFlag()
    {
        $this->isModified = false;
    }

    /**
     *
     *
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-19
     */
    protected function getCurrentMode()
    {
        $mode = substr(decoct($this->getPermissions()), 3);

        return $mode;
    }
}
