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
 * @todo implemend binary data handling (file_get_contents, file_put_contents)
 */
class File extends AbstractObject
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
    private $data;

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
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function __construct($path)
    {
        parent::__construct($path);
        $basename = basename($path);
        $dottedNamePartials = explode('.', $basename);
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
    public function getData()
    {
        $isNewOrModified = ($this->isNew() || $this->isModified());

        return ($isNewOrModified)
            ? $this->data
            : file_get_contents($this->path);
    }

    /**
     * @param mixed $data
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-06
     */
    public function setData($data)
    {
        $this->data = $data;
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
        if (file_put_contents($this->path, $this->data) === false) {
            throw new RuntimeException(
                'can not save file in path "' . $this->path . '"'
            );
        }
    }
}