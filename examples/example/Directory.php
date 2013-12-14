<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-14
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Net\Bazzline\Component\Filesystem\Filesystem;

$fileSystem = new FileSystem();
$directory = $fileSystem->createDirectoryObject(__DIR__);

$class = get_class($directory);
$methods = get_class_methods($class);

foreach ($methods as $method) {
    if ($method === 'getLinkTarget') {
        continue;
    }
    $startsWithGet = (strpos($method, 'get') === 0);
    $startsWithIs = (strpos($method, 'is') === 0);

    if ($startsWithGet
        || $startsWithIs) {
        echo $method . ': ' . var_export($directory->$method(), true) . PHP_EOL;
    }
}