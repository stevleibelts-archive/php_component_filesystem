<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem\Component;

use Countable;
use Iterator;
use Traversable;

/**
 * Class FilesystemCollection
 *
 * @package Net\Bazzline\Component\Filesystem\Component
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
class ObjectCollection implements Countable, Iterator, Traversable
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    private $objects;

    /**
     * @var int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    private $iteratorIndex;

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return (is_null($this->objects)) ? 0 : count($this->objects);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->objects[$this->iteratorIndex];
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->iteratorIndex++;
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->iteratorIndex;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        return array_key_exists($this->iteratorIndex, $this->objects);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->iteratorIndex = 0;
    }

    /**
     * Returns all attached objects.
     *
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function getObjects()
    {
        return $this->objects;
    }

    /**
     * Validates if collection has objects.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function hasObjects()
    {
        return ($this->count() > 0);
    }

    /**
     * Adds object to collection.
     *
     * @param ItemInterface $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-18
     */
    public function attach(ItemInterface $object)
    {
        $this->objects[] = $object;
        $this->rewind();
    }
}