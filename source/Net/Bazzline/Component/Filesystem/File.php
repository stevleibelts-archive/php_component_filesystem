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
     * @var bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-14
     */
    private $contentManipulated;

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
        $this->contentManipulated = false;
        //@todo what about pathinfo? http://www.php.net/manual/de/function.pathinfo.php
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
        if (!$this->contentManipulated) {
            $this->content = ($this->isNew())
                ? null
                : file_get_contents($this->path);
            $this->contentManipulated = true;
        }

        return $this->content;
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
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->contentManipulated = true;

        return $this;
    }

    /**
     * @throws IOException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function save()
    {
        if ($this->isNew() && is_null($this->content)) {
            touch($this->path);
            if ($this->isNew()) {
                throw new IOException(
                    'can not touch file in path "' , $this->path . '"'
                );
            }
        } else {
            if ($this->contentManipulated) {
                //@todo mode
                $this->filesystem->dumpFile($this->path, $this->getContent());
            }
        }
    }
}