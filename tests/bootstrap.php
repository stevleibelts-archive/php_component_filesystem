<?php
/**
* @author stev leibelt <artodeto@arcor.de>
* @since 2013-06-14
*/

chdir(realpath(getcwd()));

require 'vendor/autoload.php';
require 'test/Net/Bazzline/Component/Filesystem/UnitTestCase.php';
require 'test/Net/Bazzline/Component/Filesystem/MockFactory.php';
require 'source/Net/Bazzline/Component/Filesystem/developmentAutoloader.php';
