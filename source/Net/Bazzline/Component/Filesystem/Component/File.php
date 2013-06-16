<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem\Component;

/**
 * Class File
 *
 * @package Net\Bazzline\Component\Filesystem\Component
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
class File
{
    /**
     * @var null|string|int|array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    private $content;

    /**
     * @var null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    private $name;

    /**
     * @var null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    private $path;

    /**
     * Setup for the object.
     *
     * @param null|string $path - path to the file
     * @param null|string $name - name of the file
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function __construct($path = null, $name = null)
    {
        if ((!is_null($path))
            && (!is_null($name))) {
            $pathWithoutTrailingSlash = ($this->stringEndsWith($path, DIRECTORY_SEPARATOR)) ?
                (substr($path, 0, -(strlen(DIRECTORY_SEPARATOR)))) : $path;
            $this->setPath($pathWithoutTrailingSlash);
            $this->setName($name);
        }
    }

    /**
     * Validates if file is new.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function isNew()
    {
        return (!file_exists(realpath($this->getRealPath())));
    }

    /**
     * Sets the data (overwrites existing data).
     *
     * @param null|string|int|array $content - data for the file
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Returns the data.
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getContent()
    {
        if (!is_null($this->content)) {
            return $this->content;
        } else if ((!is_null($this->getRealPath()))
            && (!$this->isNew())
            && ($this->read())) {
            return $this->content;
        } else {
            return '';
        }
    }

    /**
     * @param string $content
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-09
     */
    public function appendContent($content)
    {
        $this->setContent($content . $this->getContent());
    }

    /**
     * @param string $content
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-09
     */
    public function prependContent($content)
    {
        $this->setContent($this->getContent() . $content);
    }

    /**
     * Sets the name of the file.
     *
     * @param string $name - name of the file.
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * Gets the name of the file.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the path of the file.
     *
     * @param string $path - path of the file.
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function setPath($path)
    {
        $this->path = (string) $path;
    }

    /**
     * Gets the path of the file.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Creates a file.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function touch()
    {
        return touch($this->getRealPath());
    }

    /**
     * Writes the available data to the file.
     *
     * @return int
     * @throws \RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function write()
    {
        if ($this->isNew()) {
            return $this->overwrite();
        } else {
            throw new RuntimeException(
                'File exists, use overwrite to force writing'
            );
        }
    }

    /**
     * Overwrites if file exists.
     *
     * @return boolean
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function overwrite()
    {
        return file_put_contents($this->getRealPath(), $this->getContent());
    }

    /**
     * Reads content by using the given path and name.
     * Overwrite content if already set.
     *
     * @return string
     * @throws \RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function read()
    {
        if ($this->isNew()) {
            throw new RuntimeException(
                'You can not read from a file that does not exist.'
            );
        }
        if (!$this->isReadable()) {
            throw new RuntimeException(
                'File is not readable'
            );
        }

        $content = file_get_contents($this->getRealPath());

        if ($content !== false) {
            $this->setContent($content);

            return $this->getContent();
        } else {
            throw new RuntimeException(
                'Error while reading content from file'
            );
        }
    }

    /**
     * Returns current modification time.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getModificationTime()
    {
        return ($this->isNew()) ? null : filemtime($this->getRealPath());
    }

    /**
     * Returns formatted modification time.
     *
     * @param string $format - format available by php date.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getModificationDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getModificationTime());
    }

    /**
     * Returns current last access time.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getLastAccessTime()
    {
        return ($this->isNew()) ? null : fileatime($this->getRealPath());
    }

    /**
     * Returns formatted last access time.
     *
     * @param string $format - format available by php date.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getLastAccessDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getLastAccessTime());
    }

    /**
     * Returns current last access time.
     *
     * @return null|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-09
     */
    public function getCreateTime()
    {
        return ($this->isNew()) ? null : filectime($this->getRealPath());
    }

    /**
     * Returns formatted last access time.
     *
     * @param string $format - format available by php date.
     *
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-09
     */
    public function getCreateDate($format = 'Y-m-d H:i:s')
    {
        return ($this->isNew()) ? null : date($format, $this->getCreateTime());
    }

    /**
     * Is file writeable.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function isWriteable()
    {
        return is_writeable($this->getRealPath());
    }

    /**
     * Is file readable.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function isReadable()
    {
        return is_readable($this->getRealPath());
    }

    /**
     * Is file executable.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function isExecutable()
    {
        return is_executable($this->getRealPath());
    }

    /**
     * Returns real path for given path and name.
     *
     * @return string
     * @throws \InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    private function getRealPath()
    {
        if (is_null($this->name)) {
            throw new InputOutputException(
                'Name is not set'
            );
        }
        if (is_null($this->path)) {
            throw new InputOutputException(
                'Path is not set'
            );
        }
        $filePath = $this->path . DIRECTORY_SEPARATOR . $this->name;

        return realpath($filePath);
    }

    /**
     * @param string $string - string
     * @param string $endsWith - ends with
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-07
     */
    private function stringEndsWith($string, $endsWith)
    {
        $lengthOfEndsWith = strlen($endsWith);
        $stringEnding = substr($string, -$lengthOfEndsWith);

        return ($stringEnding == $endsWith);
    }
}