<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/24/13
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class DACInterface
 * Represents linux directory access control
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-234
 */
class DACInterface
{
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
     * @return FilesystemObjectInterface
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
