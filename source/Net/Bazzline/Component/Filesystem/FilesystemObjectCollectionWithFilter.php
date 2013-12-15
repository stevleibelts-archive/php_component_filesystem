<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-15
 */

namespace Net\Bazzline\Component\Filesystem;

class FilesystemObjectCollectionWithFilter extends FilesystemObjectCollection
{
    private $filter;

    /**
     * @param $filter
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     * @todo or move into ctor?
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function attach($object, $data = null)
    {
        if ($this->filter($object)) {
            parent::attach($object, $data);
        }
    }
}