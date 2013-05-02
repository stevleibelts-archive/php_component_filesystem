<?php

namespace Net\Bazzline\Component\Filesystem;

use PHPUnit_Framework_TestCase;

/**
 * Test class for Filesystem.
 *
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-05-03
 */
class FileTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-05-03
     */
    public function testConstructWithNoParameters()
    {
        $file = new File();

        $this->assertNull($file->getName());
        $this->assertNull($file->getData());
        $this->assertFalse($file->isExecutable());
        $this->assertFalse($file->isNew());
        $this->assertFalse($file->isReadable());
        $this->assertFalse($file->isWriteable());
    }
}