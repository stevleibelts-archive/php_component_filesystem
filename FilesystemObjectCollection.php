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
class FilesystemObjectCollection extends SplObjectStorage
{
    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function attach(FilesystemObjectInterface $object)
    {
        return parent::attach($object, $object->getContent());
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function detach(FilesystemObjectInterface $object)
    {
        return parent::detach($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function contains(FilesystemObjectInterface $object)
    {
        return parent::contains($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function addAll(FilesystemObjectCollection $collection)
    {
        return parent::addAll($collection);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function removeAll(FilesystemObjectCollection $collection)
    {
        return parent::removeAll($collection);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function removeAllExcept(FilesystemObjectCollection $collection)
    {
        return parent::removeAllExcept($collection);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetExists(FilesystemObjectInterface $object)
    {
        return parent::offsetExists($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetSet(FilesystemObjectInterface $object)
    {
        return parent::offsetSet($object, $object->getContent());
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetUnset(FilesystemObjectInterface $object)
    {
        return parent::offsetUnset($object);
    }

    /**
     * {@inheritDoc}
     * @param FilesystemObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetGet(FilesystemObjectInterface $object)
    {
        return parent::offsetGet($object);
    }
}