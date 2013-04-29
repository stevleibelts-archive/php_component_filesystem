<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Net\Bazzline\Component\Filesystem\Exception;

use RuntimeException;

/**
 * Exception class thrown when a filesystem operation failure happens
 *
 * @author Romain Neutron <imprec@gmail.com> - original author before fork
 * @author stev eibelt <artodeto@arcor.de>
 *
 * @api
 */
class IOException extends RuntimeException implements ExceptionInterface
{

}
