<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 */

namespace Net\Bazzline\Component\Filesystem;

use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Class File
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-06
 * @todo implement binary data handling (file_get_contents, file_put_contents)
 */
class File extends AbstractFilesystemObject
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $basePath;

    /**
     * @var mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $content;

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
     * @param string $path
     * @param Filesystem $filesystem
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function __construct($path, $filesystem)
    {
        parent::__construct($path, $filesystem);
        $dottedNamePartials = explode('.', $this->basePath);
        if (count($dottedNamePartials) > 1) {
            $this->extension = array_pop($dottedNamePartials);
        } else {
            $this->extension = '';
        }
        $this->name = implode('.', $dottedNamePartials);
    }

    /**
     * @param string $path
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function generateCheckSum($path)
    {
        return sha1_file($path);
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
     * @param null|string|mixed $content
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-11
     */
    public function appendContent($content)
    {
        $this->setContent($content . $this->getContent());
    }

    /**
     * @return null|string|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getContent()
    {
        return ($this->isNew())
            ? $this->content
            : file_get_contents($this->path);
    }

    /**
     * @param null|string|mixed $content
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-11
     */
    public function prependContent($content)
    {
        $this->setContent($content . $this->getContent());
    }

    /**
     * @param null|string|mixed $content
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @throws IoException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function save()
    {
        if (file_put_contents($this->path, $this->content) === false) {
            throw new RuntimeException(
                'can not save file in path "' . $this->path . '"'
            );
        }
    }
}