<?php

/**
 * @see       https://github.com/mezzio/mezzio-hal for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-hal/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-hal/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\Hal\Exception;

use InvalidArgumentException;
use Mezzio\Hal\ResourceGenerator\StrategyInterface;

use function get_class;
use function gettype;
use function is_object;
use function sprintf;

class InvalidStrategyException extends InvalidArgumentException implements ExceptionInterface
{
    public static function forType(string $strategy) : self
    {
        return new self(sprintf(
            'Invalid strategy "%s"; does not exist, or does not implement %s',
            $strategy,
            StrategyInterface::class
        ));
    }

    /**
     * @param mixed $strategy
     */
    public static function forInstance($strategy) : self
    {
        return new self(sprintf(
            'Invalid strategy of type "%s"; does not implement %s',
            is_object($strategy) ? get_class($strategy) : gettype($strategy),
            StrategyInterface::class
        ));
    }
}
