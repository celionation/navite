<?php

declare(strict_types=1);

namespace NaviteCore\Container\Exception;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * class ContainerException implements ContainerExceptionInterface
 * 
 *@author Celio Natti <Celionatti@gmail.com>
 *@package NaviteCore
 *@version 1.0.0
 */
class ContainerException extends Exception implements ContainerExceptionInterface
{}