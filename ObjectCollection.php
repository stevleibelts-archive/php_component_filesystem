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
class ObjectCollection extends SplObjectStorage
{
    /**
     * {@inheritDoc}
     * @param ObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function attach(ObjectInterface $object)
    {
        return parent::attach($object, $object->getContent());
    }

    /**
     * {@inheritDoc}
     * @param ObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function detach(ObjectInterface $object)
    {
        return parent::detach($object);
    }

    /**
     * {@inheritDoc}
     * @param ObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function contains(ObjectInterface $object)
    {
        return parent::contains($object);
    }

    /**
     * {@inheritDoc}
     * @param ObjectCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function addAll(ObjectCollection $collection)
    {
        return parent::addAll($collection);
    }

    /**
     * {@inheritDoc}
     * @param ObjectCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function removeAll(ObjectCollection $collection)
    {
        return parent::removeAll($collection);
    }

    /**
     * {@inheritDoc}
     * @param ObjectCollection $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function removeAllExcept(ObjectCollection $collection)
    {
        return parent::removeAllExcept($collection);
    }

    /**
     * {@inheritDoc}
     * @param ObjectInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-17
     */
    public function offsetExists(ObjectInterface $object)
    {
        return parent::offsetExists($object);
    }
}