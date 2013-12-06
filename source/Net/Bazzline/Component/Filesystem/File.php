<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class File
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */
class File extends AbstractObject
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $extension;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $name;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $basePath;

    /**
     * @param string $filePath
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function __construct($filePath)
    {
        $this->basePath = dirname($filePath);
        $name = basename($filePath);
        $dottedNamePartials = explode('.', $name);
        if (count($dottedNamePartials) > 1) {
            $this->extension = array_pop($dottedNamePartials);
        } else {
            $this->extension = '';
        }
        $this->name = implode('.', $dottedNamePartials);
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getExtension()
    {
        return $this->extension;
    }


    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getPath()
    {
        $filePath = (strlen($this->basePath) > 0)
            ? $this->basePath . DIRECTORY_SEPARATOR
            : '';
        $filePath .= $this->name;
        if (strlen($this->extension) > 0) {
            $filePath .= '.' . $this->extension;
        }

        return $filePath;
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getBasePath()
    {
        return $this->basePath;
    }
} 