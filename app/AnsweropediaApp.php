<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AnsweropediaApp
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

            return (new \PageController\Error\PageNotFound())->handle($request, $response);
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
            $group->get('/search/categories.json', \APIController\GET\SearchCategories::class . ':handle');

            // DELETE
            $group->delete('/categories/{id}/follow.json', \APIController\DELETE\CategoriesIDFollow::class . ':handle');
            $group->delete('/questions/{id}/follow.json', \APIController\DELETE\QuestionsIDFollow::class . ':handle');
            $group->delete('/questions/{id}/subscribe.json', \APIController\DELETE\QuestionsIDSubscribe::class . ':handle');
            $group->delete('/users/{id}/follow.json', \APIController\DELETE\UsersIDFollow::class . ':handle');

            // PATCH
            $group->patch('/categories/{id}/rename.json', \APIController\PATCH\CategoriesIDRename::class . ':handle');
            $group->patch('/questions/{id}/rename.json', \APIController\PATCH\QuestionsIDRename::class . ':handle');
            $group->patch('/users/{id}/signature.json', \APIController\PATCH\UsersIDSignature::class . ':handle');
            $group->patch('/users/{id}/site.json', \APIController\PATCH\UsersIDSite::class . ':handle');
            $group->patch('/users/{id}/name.json', \APIController\PATCH\UsersIDName::class . ':handle');

            // POST
            $group->post('/answers/render.json', \APIController\POST\Answers\Render::class . ':handle');
            $group->post('/avatar.json', \APIController\POST\Avatar::class . ':handle');
            $group->post('/categories.json', \APIController\POST\Categories::class . ':handle');
            $group->post('/categories/{id}/follow.json', \APIController\POST\CategoriesIDFollow::class . ':handle');
            $group->post('/login.json', \APIController\POST\Login::class . ':handle');
            $group->post('/logout.json', \APIController\POST\Logout::class . ':handle');
            $group->post('/questions.json', \APIController\POST\Questions::class . ':handle');
            $group->post('/questions/{id}/image.json', \APIController\POST\Questions\ID\Image::class . ':handle');
            $group->post('/questions/{id}/follow.json', \APIController\POST\QuestionsIDFollow::class . ':handle');
            $group->post('/questions/{id}/subscribe.json', \APIController\POST\QuestionsIDSubscribe::class . ':handle');
            $group->post('/signup.json', \APIController\POST\Signup::class . ':handle');
            $group->post('/users/{id}/follow.json', \APIController\POST\UsersIDFollow::class . ':handle');

            // PUT
            $group->put('/questions/{id}.json', \APIController\PUT\QuestionsID::class . ':handle');
            $group->put('/questions/{id}/answer.json', \APIController\PUT\QuestionsIDAnswer::class . ':handle');
            $group->put('/questions/{id}/categories.json', \APIController\PUT\Questions\ID\Categories::class . ':handle');
        });

        // Publuc URI`s

        $app->group(URL_PART_LANG, function (\Slim\Routing\RouteCollectorProxy $group) {
            $group->get('', \PageController\Main\Show::class . ':handle');
            $group->get('/answer/{id}/edit', \PageController\Answer\Edit::class . ':handle');
            $group->get('/answer/{id}/history', \PageController\Answer\History::class . ':handle');
            $group->get('/feed', \PageController\Feed\Show::class . ':handle');
            $group->get('/flow', \PageController\Flow\Show::class . ':handle');
            $group->get('/category/{category_uri}', \PageController\Category\Show::class . ':handle');
            $group->get('/categories/newest', \PageController\Categories\Newest::class . ':handle');
            $group->get('/question/{id}/categories', \PageController\Question\UpdateCategories::class . ':handle');
            $group->get('/question/{id}/discussion', \PageController\Question\Discussion::class . ':handle');
            $group->get('/questions/newest', \PageController\Questions\Newest::class . ':handle');
            $group->get('/questions/recently-updated', \PageController\Questions\RecentlyUpdated::class . ':handle');
            $group->get('/random-question', \PageController\Question\Random::class . ':handle');
            $group->get('/sandbox/all', \PageController\Sandbox\All::class . ':handle');
            $group->get('/sandbox/without-answers', \PageController\Sandbox\WithoutAnswers::class . ':handle');
            $group->get('/sandbox/without-categories', \PageController\Sandbox\WithoutCategories::class . ':handle');
            $group->get('/search', \PageController\Search\Show::class . ':handle');
            $group->get('/settings', \PageController\Settings\Show::class . ':handle');
            $group->get('/sitemap.xml', \PageController\SitemapXML\Lang::class . ':handle');
            $group->get('/user/{id}', \PageController\User\ShortURL::class . ':handle');
            $group->get('/users/newest', \Front\Page\Users\Newest::class . ':handle');
            $group->get('/@{username}', \PageController\User\Show::class . ':handle');
            $group->get('/{id:[0-9]+}', \PageController\Question\ShortURL::class . ':handle');
            $group->get('/{question_uri}', \PageController\Question\Show::class . ':handle');
        });

        // Language-agnostic URLs

        $app->get('/sitemap.xml', \PageController\SitemapXML\Index::class . ':handle');
        $app->get('/', \PageController\Root\Show::class . ':handle');

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
