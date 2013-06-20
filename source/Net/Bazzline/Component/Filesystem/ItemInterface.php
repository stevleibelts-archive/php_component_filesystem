<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FilesystemInterface
 * Generic interface for filesystem item
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
interface ItemInterface
{
    /**
     * @param string $path
     * @param string $name
     * @return ItemInterface
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-16
     */
    public static function create($path, $name);

    /**
     * Sets the name of the filesystem item
     *
     * @param string $name - name of the item
     *
     * @return ItemInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function setName($name);

    /**
     * Returns the name of the filesystem item or null if no name is set.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getName();

    /**
     * Sets the path of the filesystem item.
     *
     * @param string $path - path of the item (relative or absolute)
     *
     * @return ItemInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function setPath($path);

    /**
     * Returns the path of the filesystem item or null if no path is set.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getPath();

    /**
     * Validates if the write flag is set for this filesystem item.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isWritable();

    /**
     * Tries to set the write flag
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-18
     */
    public function setIsWritable();

    /**
     * Tries to set the write flag
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-18
     */
    public function unsetIsWritable();

    /**
     * Validates if the read flag is set for this filesystem item.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isReadable();

    /**
     * Tries to set the read flag
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-18
     */
    public function setIsReadable();

    /**
     * Tries to set the read flag
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-18
     */
    public function unsetIsReadable();

    /**
     * Validates if the execute flag is set for this filesystem item.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isExecutable();

    /**
     * Tries to set the execute flag
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-18
     */
    public function setIsExecutable();

    /**
     * Tries to set the execute flag
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-18
     */
    public function unsetIsExecutable();

    /**
     * Validates if filesystem item has content.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function hasContent();

    /**
     * Returns the content of the filesystem item.
     *
     * @return string|ItemCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getContent();

    /**
     * Sets toe content fo the filesystem item.
     *
     * @param string|ItemCollection $content - A string or the
     *  FilesystemCollection
     *
     * @return ItemInterface
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function setContent($content);

    /**
     * Validates if filesystem item exists on filesystem or not.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isNew();

    /**
     * Validates if filesystem item is modified and not saved.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isModified();

    /**
     * Validates if filesystem item represents a file.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isFile();

    /**
     * Validates if filesystem item represents a directory.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function isDirectory();

    /**
     * Returns last modification time or null if item is new.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getModificationTime();

    /**
     * Returns last access time or null if item is new.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getAccessTime();

    /**
     * Returns create time or null if item is new.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getCreateTime();

    /**
     * Returns last modification date or null if item is null.
     *
     * @param string $format - date format by php date()
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getModificationDate($format = 'Y-m-d H:i:s');

    /**
     * Returns last access date or null if item is null.
     *
     * @param string $format - date format by php date()
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getAccessDate($format = 'Y-m-d H:i:s');

    /**
     * Returns create date or null if item is null.
     *
     * @param string $format - date format by php date()
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function getCreateDate($format = 'Y-m-d H:i:s');

    /**
     * Saved content and throws exception if item is not new.
     * Throws exception if item is not writable.
     *
     * @param bool $override
     * @return int
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function save($override = false);

    /**
     * @return bool
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function delete();

    /**
     * Returns current owner of the item
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function getOwner();

    /**
     * Sets owner to current item
     *
     * @param string $owner - name of the owner
     * @return boolean
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function setOwner($owner);

    /**
     * Validates if provided name is owner of the item
     *
     * @param string $owner - name of the owner
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function isOwner($owner);

    /**
     * Returns group of current item
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function getGroup();

    /**
     * Sets group for current item
     *
     * @param string $group - name of the group
     * @return boolean
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function setGroup($group);

    /**
     * Validates if provided name is group of the item
     *
     * @param string $group - name of the group
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function isGroup($group);

    /**
     * Returns permissions of current item
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function getPermissions();

    /**
     * Sets permission to current item
     *
     * @param int $permission - permission to set
     * @return ItemInterface
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function setPermissions($permission);

    /**
     * Validates if provided permission is set
     *
     * @param int $permission - permission you want to check
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-15
     */
    public function hasPermission($permission);
}