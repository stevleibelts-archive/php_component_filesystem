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
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    private $checkSum;

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
        $this->checkSum = $this->generateCheckSum($this->path);
    }

    /**
     * @param string $path
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    protected function generateCheckSum($path)
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
     * @return mixed|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function getContent()
    {
        $isNewOrModified = ($this->isNew() || $this->isModified());

        return ($isNewOrModified)
            ? $this->content
            : file_get_contents($this->path);
    }

    /**
     * @param mixed $content
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function isNew()
    {
        return file_exists($this->path);
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function isModified()
    {
        return ($this->checkSum !== $this->generateCheckSum($this->path));
    }

    /**
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    function delete()
    {
        if (!unlink($this->path)) {
            throw new RuntimeException(
                'can not delete file in path "' . $this->path . '"'
            );
        }
    }

    /**
     * @throws RuntimeException
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