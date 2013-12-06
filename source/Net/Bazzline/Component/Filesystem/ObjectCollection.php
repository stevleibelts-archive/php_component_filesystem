<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class ObjectCollection
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */
class ObjectCollection
{
    /**
     * @var array|AbstractObject[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $collection = array();

    /**
     * @param AbstractObject $object
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function add(AbstractObject $object)
    {
        $this->collection[] = $object;
    }

    /**
     * @return array|AbstractObject[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getCollection()
    {
        return $this->collection;
    }
} 