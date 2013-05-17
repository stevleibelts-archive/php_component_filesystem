<?php

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FilesystemInterface
 * Generic interface for filesystem object
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
interface FilesystemInterface
{
    /**
     * Sets the name of the filesystem object.
     *
     * @param string $name - name of the object
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function setName($name);

    /**
     * Returns the name of the filesystem object or null if no name is set.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getName();

    /**
     * Sets the path of the filesystem object.
     *
     * @param string $path - path of the object (relative or absolute)
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function setPath($path);

    /**
     * Returns the path of the filesystem object or null if no path is set.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getPath();

    /**
     * Validates if the write flag is set for this filesystem object.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isWriteable();

    /**
     * Validates if the read flag is set for this filesystem object.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isReadable();

    /**
     * Validates if the execute flag is set for this filesystem object.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isExecutable();

    /**
     * Returns the content of the filesystem object.
     *
     * @return string|FilesystemCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getContent();

    /**
     * Sets toe content fo the filesystem object.
     *
     * @param string|FilesystemCollection $content - A string or the
     *  FilesystemCollection
     *
     * @throws \InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function setContent($content);

    /**
     * Validates if filesystem object exists on filesystem or not.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isNew();

    /**
     * Validates if filesystem object is modified and not saved.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isModified();

    /**
     * Validates if filesystem object represents a file.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isFile();

    /**
     * Validates if filesystem object represents a directory.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isDirectory();

    /**
     * Returns last modification time or null if object is new.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getModificationTime();

    /**
     * Returns last access time or null if object is new.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getAccessTime();

    /**
     * Returns create time or null if object is new.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getCreateTime();

    /**
     * Returns last modification date or null if object is null.
     *
     * @param string $format - date format by php date()
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getModificationDate($format = 'Y-m-d H:i:s');

    /**
     * Returns last access date or null if object is null.
     *
     * @param string $format - date format by php date()
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getAccessDate($format = 'Y-m-d H:i:s');

    /**
     * Returns create date or null if object is null.
     *
     * @param string $format - date format by php date()
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getCreateDate($format = 'Y-m-d H:i:s');

    /**
     * Saved content and throws exception if object is not new.
     * Throws exception if object is not writeable.
     *
     * @return int
     * @throws \RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function save();

    /**
     * Saved content, even if file exists.
     * Throws exception if object is not writeable.
     *
     * @return int
     * @throws \RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function update();

    /**
     * Loads content from filesystem by using the given path and name.
     * Overwrite content if already set.
     * Throws exception if object is not readable.
     *
     * @return string|FilesystemCollection
     * @throws \RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function load();
}