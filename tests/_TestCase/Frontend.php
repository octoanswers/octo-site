<?php

namespace Test\TestCase;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Slim\Psr7\Factory\ServerRequestFactory;

/**
 * Inspired by https://github.com/odan/slim4-skeleton/blob/master/tests/TestCase/HttpTestTrait.php.
 */
abstract class Frontend extends \Test\TestCase\DB
{
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = (new \AnsweropediaApp)->get_app();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->app = null;
    }

    /**
     * Create a server request.
     *
     * @param string              $method       The HTTP method
     * @param string|UriInterface $uri          The URI
     * @param array               $serverParams The server parameters
     *
     * @return ServerRequestInterface
     */
    protected function createRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        // A phpunit fix #3026
        if (! isset($_SERVER['REQUEST_URI'])) {
            $_SERVER = [
                'SCRIPT_NAME'        => '/public/index.php',
                'REQUEST_TIME_FLOAT' => microtime(true),
                'REQUEST_TIME'       => (int) microtime(true),
            ];
        }
        $factory = new ServerRequestFactory;

        return $factory->createServerRequest($method, $uri, $serverParams);
    }

    /**
     * Add post data.
     *
     * @param ServerRequestInterface $request The request
     * @param mixed[]                $data    The data
     *
     * @return ServerRequestInterface
     */
    protected function withFormData(ServerRequestInterface $request, array $data): ServerRequestInterface
    {
        if (! empty($data)) {
            $request = $request->withParsedBody($data);
        }

        return $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    /**
     * Add Json data.
     *
     * @param ServerRequestInterface $request The request
     * @param mixed[]                $data    The data
     *
     * @return ServerRequestInterface
     */
    protected function withJson(ServerRequestInterface $request, array $data): ServerRequestInterface
    {
        $request = $request->withParsedBody($data);
        $request = $request->withHeader('Content-Type', 'application/json');

        return $request;
    }

    /**
     * Make request.
     *
     * @param ServerRequestInterface $request The request
     *
     * @return ResponseInterface
     * @throws Exception
     *
     */
    protected function request(ServerRequestInterface $request): ResponseInterface
    {
        /** @var \AnsweropediaApp $app */
        $app = $this->app;

        return $app->handle($request);
    }
}
