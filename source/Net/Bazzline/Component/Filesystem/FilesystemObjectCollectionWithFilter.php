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
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
}