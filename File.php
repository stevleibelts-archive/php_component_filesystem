<?php

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class File
 *
 * @package Net\Bazzline\Component\Filesystem
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
    private $data;

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
     * @param null|string|int|array $data - data for the file
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Returns the data.
     *
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function getData()
    {
        if (!is_null($this->data)) {
            return $this->data;
        } else if ((!is_null($this->getRealPath()))
            && (!$this->isNew())
            && ($this->read())) {
            return $this->data;
        } else {
            return '';
        }
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
     * @return bool|int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function write()
    {
        if ($this->isNew()) {
            return $this->overwrite();
        } else {
            return false;
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
        return file_put_contents($this->getRealPath(), $this->getData());
    }

    /**
     * Reads content by using the given path and name.
     *
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function read()
    {
        if ($this->isNew()) {
            return false;
        }
        $data = file_get_contents($this->getRealPath());

        if ($data !== false) {
            $this->setData($data);

            return true;
        } else {
            return false;
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
     * @return null|string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    private function getRealPath()
    {
        if ((is_null($this->name))
            && (is_null($this->path))) {
            return null;
        } else {
            $filePath = $this->path . DIRECTORY_SEPARATOR . $this->name;
            return realpath($filePath);
        }
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