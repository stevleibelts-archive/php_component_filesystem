<?php

namespace Net\Bazzline\Component\Filesystem;

use RuntimeException;
use InvalidArgumentException;

/**
 * Class Directory
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
class Directory extends ObjectAbstract
{
    /**
     * @var ObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    private $directoryCollection;

    /**
     * @var ObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    private $fileCollection;

    /**
     * Validates of directory has content
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function hasContent()
    {
        return (!is_null($this->content));
    }

    /**
     * {$inheritDoc}
     */
    public function hasFiles()
    {
        return (($this->hasContent())
                && ($this->fileCollection->hasObjects()));
    }

    /**
     * {$inheritDoc}
     */
    public function hasDirectories()
    {
        return (($this->hasContent())
            && ($this->directoryCollection->hasObjects()));
    }

    /**
     * {$inheritDoc}
     */
    public function getFiles()
    {
        return ($this->hasFiles()) ? $this->fileCollection->getObjects() : null;
    }

    /**
     * {$inheritDoc}
     */
    public function getDirectories()
    {
        return ($this->hasDirectories()) ? $this->directoryCollection->getObjects() : null;
    }

    /**
     * {$inheritDoc}
     */
    public function addFile(File $file)
    {
        if (!$this->hasContent()) {
            $this->setContent($file);
        } else {
            $this->fileCollection->attach($file);
        }
    }

    /**
     * {$inheritDoc}
     */
    public function addDirectory(Directory $directory)
    {
        if (!$this->hasContent()) {
            $this->setContent($directory);
        } else {
            $this->directoryCollection->attach($directory);
        }
    }

    /**
     * {$inheritDoc}
     */
    public function removeFile(File $file)
    {

    }

    /**
     * {$inheritDoc}
     */
    public function removeDirectory(Directory $directory)
    {

    }

    /**
     * {$inheritDoc}
     */
    public function getModificationTime()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function getAccessTime()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function getCreateTime()
    {

    }

    /**
     * Creates a directory.
     *
     * @return boolean
     * @throws \RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     * @todo add mod when implemented/available
     */
    public function mkdir()
    {
        if (!$this->isNew()) {
            throw new RuntimeException(
                'Directory already exists.'
            );
        }

        return mkdir($this->getRealPath(), 0755, true);
    }

    /**
     * Removes directory and its content.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function rm()
    {
        return ($this->isNew()) ? true : rmdir($this->getRealPath());
    }

    /**
     * {$inheritDoc}
     */
    public function save()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function update()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function load()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function isModified()
    {

    }

    /**
     * Sets content of the directory.
     *
     * @param ObjectInterface|ObjectCollection $content - content of directory
     *
     * @return ObjectInterface
     * @throws \InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function setContent($content)
    {
        if ($content instanceof ObjectCollection) {
            $this->content = $content;
        } else if ($content instanceof ObjectInterface) {
            $collection = new ObjectCollection();
            $collection->attach($content);

            $this->content = $collection;
        } else {
            throw new InvalidArgumentException(
                'Content is not an instance of a valid class (ObjectCollection or ObjectInterface)'
            );
        }

        return $this;
    }

    /**
     * {$inheritDoc}
     */
    public function isDirectory()
    {
        return true;
    }

    /**
     * {$inheritDoc}
     */
    public function isFile()
    {
        return false;
    }
}