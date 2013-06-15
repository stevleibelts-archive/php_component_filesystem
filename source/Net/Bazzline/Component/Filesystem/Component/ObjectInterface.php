<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem\Component;

/**
 * Class FilesystemInterface
 * Generic interface for filesystem object
 *
 * @package Net\Bazzline\Component\Filesystem\Component
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
interface ObjectInterface
{
    /**
     * Sets the name of the filesystem object.
     *
     * @param string $name - name of the object
     *
     * @return ObjectInterface
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
     * @return ObjectInterface
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
    public function isWritable();

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
     * Validates if filesystem object has content.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function hasContent();

    /**
     * Returns the content of the filesystem object.
     *
     * @return string|ObjectCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getContent();

    /**
     * Sets toe content fo the filesystem object.
     *
     * @param string|ObjectCollection $content - A string or the
     *  FilesystemCollection
     *
     * @return ObjectInterface
     * @throws InvalidArgumentException
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
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function save();

    /**
     * Saved content, even if file exists.
     * Throws exception if object is not writeable.
     *
     * @return int
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function update();

    /**
     * Loads content from filesystem by using the given path and name.
     * Overwrite content if already set.
     * Throws exception if object is not readable.
     *
     * @return string|ObjectCollection
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function load();

    /**
     * Returns current owner of the file
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function getOwner();

    /**
     * Sets owner to current file
     *
     * @param string $owner - name of the owner
     * @return boolean
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function setOwner($owner);

    /**
     * Validates if provided name is owner of the file
     *
     * @param string $owner - name of the owner
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function isOwner($owner);

    /**
     * Returns group of current file
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function getGroup();

    /**
     * Sets group for current file
     *
     * @param string $group - name of the group
     * @return boolean
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function setGroup($group);

    /**
     * Validates if provided name is group of the file
     *
     * @param string $group - name of the group
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function isGroup($group);

    /**
     * Returns permissions of current file
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function getPermission();

    /**
     * Sets permission to current file
     *
     * @param int $permission - permission to set
     * @return ObjectInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function setPermission($permission);

    /**
     * Validates if provided permission is set
     *
     * @param int $permission - permission you want to check
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function hasPermission($permission);

    /**
     * Changes mode of current file
     *
     * @param int $mode - mode, you don't have to provide first 0
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function chmod($mode);

    /**
     * @param string $owner - name of the group
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function chown($owner);

    /**
     * Changes group of current file
     *
     * @param string $group - name of the group
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function chgrp($group);
}