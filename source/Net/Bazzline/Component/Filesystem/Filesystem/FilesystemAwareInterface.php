<?php
/**
 * @author stev leibelt <artodeto@arocr.de>
 * @since 2013-04-25
 */
namespace Net\Bazzline\Component\Filesystem\Filesystem;

/**
 * Aware interface for filesystem dependency injection
 *
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-04-25
 */
interface FilesystemAwareInterface
{
    /**
     * Getter for filesystem dependency injection
     *
     * @return \Net\Bazzline\Component\Filesystem\Filesystem\FilesystemInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-04-25
     */
    public function getFilesystem();

    /**
     * Setter for filesystem dependency injection
     *
     * @param \Net\Bazzline\Component\Filesystem\Filesystem\FilesystemInterface $filesystem - filesystem
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-04-25
     */
    public function setFilesystem(FilesystemInterface $filesystem);
}