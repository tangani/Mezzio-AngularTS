<?php

/**
 * @see       https://github.com/mezzio/mezzio-hal for the canonical source repository
 * @copyright https://github.com/mezzio/mezzio-hal/blob/master/COPYRIGHT.md
 * @license   https://github.com/mezzio/mezzio-hal/blob/master/LICENSE.md New BSD License
 */

namespace Mezzio\Hal\LinkGenerator;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface describing a class that can generate a URL for Link HREFs.
 */
interface UrlGeneratorInterface
{
    /**
     * Generate a URL for use as the HREF of a link.
     *
     * - The request is provided, to allow the implementation to pull any
     *   request-specific items it may need (e.g., results of routing, original
     *   URI for purposes of generating a fully-qualified URI, etc.).
     *
     * - `$routeParams` are any replacements to make in the route string.
     *
     * - `$queryParams` are any query string parameters to include in the
     *   generated URL.
     */
    public function generate(
        ServerRequestInterface $request,
        string $routeName,
        array $routeParams = [],
        array $queryParams = []
    ) : string;
}
