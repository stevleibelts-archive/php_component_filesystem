<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Net\Bazzline\Component\Filesystem\Filesystem;

$fileSystem = new FileSystem();
$file = $fileSystem->createFileObject(__FILE__);

$class = get_class($file);
$methods = get_class_methods($class);

foreach ($methods as $method) {
    $startsWithGet = (strpos('get', $method) === 0);
    $startsWithIs = (strpos('is', $method) === 0);
    if ($startsWithGet
        || $startsWithIs) {
        echo $method . PHP_EOL;
        //echo $method . ': ' . $file->$method() . PHP_EOL;
    }
}