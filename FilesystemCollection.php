<?php

namespace Net\Bazzline\Component\Filesystem;

use SplObjectStorage;

/**
 * Class FilesystemCollection
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
class FilesystemCollection extends SplObjectStorage
{
    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function attach(FilesystemInterface $object)
    {
        return parent::attach($object, $object->getContent());
    }

    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function detach(FilesystemInterface $object)
    {
        return parent::detach($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function contains(FilesystemInterface $object)
    {
        return parent::contains($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function addAll(FilesystemCollection $collection)
    {
        return parent::addAll($collection);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function removeAll(FilesystemCollection $collection)
    {
        return parent::removeAll($collection);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function removeAllExcept(FilesystemCollection $collection)
    {
        return parent::removeAllExcept($collection);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetExists(FilesystemInterface $object)
    {
        return parent::offsetExists($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetSet(FilesystemInterface $object)
    {
        return parent::offsetSet($object, $object->getContent());
    }

    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetUnset(FilesystemInterface $object)
    {
        return parent::offsetUnset($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetGet(FilesystemInterface $object)
    {
        return parent::offsetGet($object);
    }
}