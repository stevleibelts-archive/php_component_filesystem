<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-15
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class FilesystemObjectCollectionWithFilter
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-16
 */
class FilterableFilesystemObjectCollection extends FilesystemObjectCollection
{
    /**
     * @var FilterInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    private $filter;

    /**
     * @param FilterInterface $filter
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function setFilter(FilterInterface $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param FilesystemObject $object
     * @param null $data
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-16
     */
    public function attach(FilesystemObject $object, $data = null)
    {
        if ($this->filter->permit($object)) {
            parent::attach($object, $data);
        }
    }
}