<?php

namespace Renderer\Error;

class Basic implements \Slim\Interfaces\ErrorRendererInterface
{
    public function __invoke(\Throwable $exception, bool $displayErrorDetails): string
    {
        $path = $exception->getRequest()->getUri()->getPath();
        return 'The requested path ' . $path . ' could not be found. Please verify the URI and try again.';
    }
}
