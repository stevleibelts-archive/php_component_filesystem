<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-12-14
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Net\Bazzline\Component\Filesystem\Filesystem;

$fileSystem = new FileSystem();
$file = $fileSystem->createFileObject(__DIR__ . DIRECTORY_SEPARATOR . 'testFile_' . time());

$class = get_class($file);
$methods = get_class_methods($class);

foreach ($methods as $method) {
    if ($method === 'getLinkTarget') {
        continue;
    }
    $startsWithGet = (strpos($method, 'get') === 0);
    $startsWithIs = (strpos($method, 'is') === 0);

    if ($startsWithGet
        || $startsWithIs) {
        echo $method . ': ' . var_export($file->$method(), true) . PHP_EOL;
    }
}