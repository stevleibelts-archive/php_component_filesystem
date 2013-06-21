<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */

namespace Net\Bazzline\Component\Filesystem;

/**
 * Class File
 *
 * @package Net\Bazzline\Component\Filesystem
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
class File extends ItemAbstract implements FileItemInterface
{
    /**
     * {$inheritDoc}
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
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
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function write()
    {
        if ($this->isNew()) {
            return $this->overwrite();
        } else {
            throw new InputOutputException(
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
     * @throws InputOutputException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function read()
    {
        if ($this->isNew()) {
            throw new InputOutputException(
                'You can not read from a file that does not exist.'
            );
        }
        if (!$this->isReadable()) {
            throw new InputOutputException(
                'File is not readable'
            );
        }

        $content = file_get_contents($this->getRealPath());

        if ($content !== false) {
            $this->setContent($content);

            return $this->getContent();
        } else {
            throw new InputOutputException(
                'Error while reading content from file'
            );
        }
    }

    /**
     * {$inheritDoc}
     */
    public function isFile()
    {
        return true;
    }

    /**
     * {$inheritDoc}
     */
    public function isDirectory()
    {
        return false;
    }

    /**
     * {$inheritDoc}
     */
    public function save()
    {
        if (!$this->isWritable()) {
            throw new InputOutputException(
                'File is not writable.'
            );
        }
        if (!$this->isNew()) {
            throw new InputOutputException(
                'Use update to not save to overwrite existing file content.'
            );
        }

        return file_put_contents($this->getRealPath(), $this->getContent());
    }

    /**
     * {$inheritDoc}
     */
    public function update()
    {
        if (!$this->isWritable()) {
            throw new InputOutputException(
                'File is not writable.'
            );
        }

        return file_put_contents($this->getRealPath(), $this->getContent());
    }

    /**
     * {$inheritDoc}
     */
    public function load()
    {
        if (!$this->isReadable()) {
            throw new InputOutputException(
                'File is not readable.'
            );
        }

        $content = file_get_contents($this->getRealPath());

        if ($content === false) {
            throw new InputOutputException(
                'Could not read file.'
            );
        }

        $this->setContent($content);
    }

    /**
     * {$inheritDoc}
     */
    public function getExtension()
    {
        $pathParts = pathinfo($this->getRealPath());

        return (isset($pathParts['extension'])) ? $pathParts['extension'] : null;
    }
}
