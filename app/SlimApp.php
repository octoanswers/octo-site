<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class SlimApp
{
    /**
     * Stores an instance of the Slim application.
     *
     * @var App
     */
    private $app;

    public function __construct()
    {
        // Instantiate App

        $app = Slim\Factory\AppFactory::create();

        // The routing middleware should be added earlier than the ErrorMiddleware
        // Otherwise exceptions thrown from it will not be handled by the middleware

        $app->addRoutingMiddleware();

        // Define Custom Error Handler
        $default_error_handler = function (Request $request, \Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails) use ($app) {
            $response = $app->getResponseFactory()->createResponse();
            $response->getBody()->write('Page not found');

            return $response->withStatus(404);
        };

        // Add Error Middleware
        $errorMiddleware = $app->addErrorMiddleware(true, true, true);
        $errorMiddleware->setDefaultErrorHandler($default_error_handler);

        // @TODO Get the default error handler and register my custom error renderer.
        // $errorHandler = $errorMiddleware->getDefaultErrorHandler();
        // $errorHandler->registerErrorRenderer('text/html', \Renderer\Error\Basic::class);
        // $errorMiddleware->setDefaultErrorHandler($errorHandler);

        // Add Middleware for CORS
        // @NOTE: Move to separate class https://www.slimframework.com/docs/v4/concepts/middleware.html

        $beforeMiddleware = function (Request $request, RequestHandler $handler) {
            $response = $handler->handle($request);

            return $response
                ->withHeader('Access-Control-Allow-Origin', 'https://avatars.answeropedia.org')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        };
        $app->add($beforeMiddleware);

        // Set supported array on languages

        if (!defined('URL_PART_LANG')) {
            define('URL_PART_LANG', '/{lang:[en|ru]+}');
        }

        // API v1

        $app->group('/api/v1' . URL_PART_LANG, function (\Slim\Routing\RouteCollectorProxy $group) {

            // GET
            $group->get('/search/categories.json', '\APIController\GET\SearchCategories:handle');

            // DELETE
            $group->delete('/categories/{id}/follow.json', '\APIController\DELETE\CategoriesIDFollow:handle');
            $group->delete('/questions/{id}/follow.json', '\APIController\DELETE\QuestionsIDFollow:handle');
            $group->delete('/questions/{id}/subscribe.json', '\APIController\DELETE\QuestionsIDSubscribe:handle');
            $group->delete('/users/{id}/follow.json', '\APIController\DELETE\UsersIDFollow:handle');

            // PATCH
            $group->patch('/categories/{id}/rename.json', '\APIController\PATCH\CategoriesIDRename:handle');
            $group->patch('/questions/{id}/rename.json', '\APIController\PATCH\QuestionsIDRename:handle');
            $group->patch('/users/{id}/signature.json', '\APIController\PATCH\UsersIDSignature:handle');
            $group->patch('/users/{id}/site.json', '\APIController\PATCH\UsersIDSite:handle');
            $group->patch('/users/{id}/name.json', '\APIController\PATCH\UsersIDName:handle');

            // POST
            $group->post('/answers/render.json', '\APIController\POST\Answers\Render:handle');
            $group->post('/avatar.json', '\APIController\POST\Avatar:handle');
            $group->post('/categories.json', '\APIController\POST\Categories:handle');
            $group->post('/categories/{id}/follow.json', '\APIController\POST\CategoriesIDFollow:handle');
            $group->post('/login.json', '\APIController\POST\Login:handle');
            $group->post('/logout.json', '\APIController\POST\Logout:handle');
            $group->post('/questions.json', '\APIController\POST\Questions:handle');
            $group->post('/questions/{id}/image.json', '\APIController\POST\Questions\ID\Image:handle');
            $group->post('/questions/{id}/follow.json', '\APIController\POST\QuestionsIDFollow:handle');
            $group->post('/questions/{id}/subscribe.json', '\APIController\POST\QuestionsIDSubscribe:handle');
            $group->post('/signup.json', '\APIController\POST\Signup:handle');
            $group->post('/users/{id}/follow.json', '\APIController\POST\UsersIDFollow:handle');

            // PUT
            $group->put('/questions/{id}.json', '\APIController\PUT\QuestionsID:handle');
            $group->put('/questions/{id}/answer.json', '\APIController\PUT\QuestionsIDAnswer:handle');
            $group->put('/questions/{id}/categories.json', '\APIController\PUT\Questions\ID\Categories:handle');
        });

        // Publuc URI`s

        $app->group(URL_PART_LANG, function (\Slim\Routing\RouteCollectorProxy $group) {
            $group->get('', '\PageController\Main\Show:handle');
            $group->get('/answer/{id}/edit', '\PageController\Answer\Edit:handle');
            $group->get('/answer/{id}/history', '\PageController\Answer\History:handle');
            $group->get('/feed', '\PageController\Feed\Show:handle');
            $group->get('/flow', '\PageController\Flow\Show:handle');
            $group->get('/category/{category_uri}', '\PageController\Category\Show:handle');
            $group->get('/categories/newest', '\PageController\Categories\Newest:handle');
            // @NOTE To realize $this->get('/categories/popular', 'List_Categories_PageController:handle');
            $group->get('/question/{id}/categories', '\PageController\Question\UpdateCategories:handle');
            $group->get('/question/{id}/discussion', '\PageController\Question\Discussion:handle');
            $group->get('/questions/newest', '\PageController\Questions\Newest:handle');
            $group->get('/questions/recently-updated', '\PageController\Questions\RecentlyUpdated:handle');
            $group->get('/random-question', '\PageController\Question\Random:handle');
            $group->get('/sandbox/all', '\PageController\Sandbox\All:handle');
            $group->get('/sandbox/without-answers', '\PageController\Sandbox\WithoutAnswers:handle');
            $group->get('/sandbox/without-categories', '\PageController\Sandbox\WithoutCategories:handle');
            $group->get('/search', '\PageController\Search\Show:handle');
            $group->get('/settings', '\PageController\Settings\Show:handle');
            $group->get('/sitemap.xml', '\PageController\SitemapXML\Lang:handle');
            $group->get('/user/{id}', \PageController\User\ShortURL::class . ':handle');
            $group->get('/users/newest', \PageController\Users\Newest::class . ':handle');
            $group->get('/@{username}', '\PageController\User\Show:handle');
            $group->get('/{question_uri}', '\PageController\Question\Show:handle');
            $group->get('/{id:[0-9]+}[/{uri_slug}]', '\PageController\Question\Show:handleByID'); // @TODO Deprecated
        });

        // Language-agnostic URLs

        $app->get('/sitemap.xml', '\PageController\SitemapXML\Index:handle');
        $app->get('/', '\PageController\Root\Show:handle');

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return App
     */
    public function get_app()
    {
        return $this->app;
    }
}
