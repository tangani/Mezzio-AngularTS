<?php

/**
 * @see       https://github.com/mezzio/mezzio-hal for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-hal/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-hal/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\Hal\Exception;

use Mezzio\Hal\Metadata\AbstractMetadata;
use RuntimeException;

use function get_class;
use function sprintf;

class UnknownMetadataTypeException extends RuntimeException implements ExceptionInterface
{
    public static function forMetadata(AbstractMetadata $metadata) : self
    {
        return new self(sprintf(
            'Encountered unknown metadata type %s; no strategy available for creating resource from this metadata',
            get_class($metadata)
        ));
    }

    public static function forInvalidMetadataClass(string $metadata) : self
    {
        return new self(sprintf(
            'Invalid metadata type "%s"; does not exist, or does not extend %s',
            $metadata,
            AbstractMetadata::class
        ));
    }
}
