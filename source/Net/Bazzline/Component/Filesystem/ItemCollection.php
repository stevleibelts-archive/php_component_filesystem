<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem;

use Countable;
use Iterator;
use Traversable;

/**
 * Class FilesystemCollection
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-17
 */
class ItemCollection implements Countable, Iterator, Traversable
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
     * {@inheritdoc}
     */
    public function count()
    {
        return (is_null($this->objects)) ? 0 : count($this->objects);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->objects[$this->iteratorIndex];
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->iteratorIndex++;
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->iteratorIndex;
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return array_key_exists($this->iteratorIndex, $this->objects);
    }

    /**
     * {@inheritdoc}
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