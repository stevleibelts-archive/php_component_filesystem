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
     * {$inheritDoc}
     */
    public function hasContent()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function hasFiles()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function hasDirectories()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function getContent()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function getFiles()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function getDirectories()
    {

    }

    /**
     * {$inheritDoc}
     */
    public function addFile(File $file)
    {

    }

    /**
     * {$inheritDoc}
     */
    public function addDirectory(Directory $directory)
    {

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