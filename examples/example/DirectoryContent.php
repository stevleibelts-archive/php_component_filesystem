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

$content = $directory->getContent();
echo 'content class: ' . get_class($content) . PHP_EOL;
echo 'number of entries: ' . $content->count() . PHP_EOL;
echo 'iterating over content' . PHP_EOL;
foreach ($content as $item) {
    echo var_export($item, true) . PHP_EOL;
}
