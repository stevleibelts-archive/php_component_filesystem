<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem\Component;

use RuntimeException;
use InvalidArgumentException;

/**
 * Class Directory
 *
 * @package Net\Bazzline\Component\Filesystem\Component
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
class Directory extends ItemAbstract
{
    /**
     * @var ItemCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    private $directoryCollection;

    /**
     * @var ItemCollection
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
     * Validates if files are available.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function hasFiles()
    {
        return (($this->hasContent())
                && ($this->fileCollection->hasObjects()));
    }

    /**
     * Validates if directories are available.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function hasDirectories()
    {
        return (($this->hasContent())
            && ($this->directoryCollection->hasObjects()));
    }

    /**
     * Returns available files.
     *
     * @return null|ItemCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function getFiles()
    {
        return ($this->hasFiles()) ? $this->fileCollection : null;
    }

    /**
     * Returns available directories.
     *
     * @return null|ItemCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function getDirectories()
    {
        return ($this->hasDirectories()) ? $this->directoryCollection : null;
    }

    /**
     * Attach a file.
     *
     * @param File $file - the file to attach.
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function attachFile(File $file)
    {
        if (!$this->hasContent()) {
            $this->setContent($file);
        } else {
            $this->content->attach($file);
            $this->fileCollection->attach($file);
        }
    }

    /**
     * Attach a directory.
     *
     * @param Directory $directory - the directory to attach.
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function attachDirectory(Directory $directory)
    {
        if (!$this->hasContent()) {
            $this->setContent($directory);
        } else {
            $this->content->attach($directory);
            $this->directoryCollection->attach($directory);
        }
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
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
    public function create()
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
    public function remove()
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
     * @param ItemInterface|ItemCollection $content - content of directory
     *
     * @return ItemInterface
     * @throws \InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function setContent($content)
    {
        if ($content instanceof ItemCollection) {
            $this->content = $content;
        } else if ($content instanceof ItemInterface) {
            $collection = new ItemCollection();
            $collection->attach($content);

            $this->content = $collection;
        } else {
            throw new InvalidArgumentException(
                'Content is not an instance of a valid class (ItemCollection or ItemInterface)'
            );
        }

        $this->setupDirectoryAndFileCollection($this->content);

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

    /**
     * Updates internal file and directory collection.
     *
     * @param ItemCollection $collection
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    private function setupDirectoryAndFileCollection(ItemCollection $collection)
    {
        $this->fileCollection = new ItemCollection();
        $this->directoryCollection = new ItemCollection();

        foreach ($collection as $object)
        {
            if ($object instanceof File) {
                $this->fileCollection->attach($object);
            } else if ($object instanceof Directory) {
                $this->directoryCollection->attach($object);
            }
        }
    }
}