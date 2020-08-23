<?php

/**
 * @see       https://github.com/mezzio/mezzio-hal for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-hal/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-hal/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\Hal\Metadata\Exception;

use UnexpectedValueException;

use function sprintf;

class UndefinedClassException extends UnexpectedValueException implements ExceptionInterface
{
    public static function create($class)
    {
        return new self(sprintf(
            'Cannot map metadata for class "%s"; class does not exist',
            $class
        ));
    }
}
