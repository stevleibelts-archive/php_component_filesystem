# Net Bazzline Component Filesystem

Based on Symfony\Component\Filesystem\Filesystem

Filesystem provides basic utility to manipulate the file system:

## Idea

Basic idea is to provide generic models for database objects that are able to deal with directory and file as one object.

The file system provides method to identify if current file system object is a directory, a file, a soft link and so on.

## Original Readme

```php
<?php

use Net\Bazzline\Component\Filesystem\Filesystem;

$filesystem = new Filesystem();

$filesystem->copy($originFile, $targetFile, $override = false);

$filesystem->mkdir($dirs, $mode = 0777);

$filesystem->touch($files, $time = null, $atime = null);

$filesystem->remove($files);

$filesystem->chmod($files, $mode, $umask = 0000, $recursive = false);

$filesystem->chown($files, $user, $recursive = false);

$filesystem->chgrp($files, $group, $recursive = false);

$filesystem->rename($origin, $target);

$filesystem->symlink($originDir, $targetDir, $copyOnWindows = false);

$filesystem->makePathRelative($endPath, $startPath);

$filesystem->mirror($originDir, $targetDir, \Traversable $iterator = null, $options = array());

$filesystem->isAbsolutePath($file);
```

Resources
---------

You can run the unit tests with the following command:

    $ cd path/to/Symfony/Component/Filesystem/
    $ composer.phar install --dev
    $ phpunit
