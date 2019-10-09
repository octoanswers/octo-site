<?php

// @TODO Вынести require_once и инициализацию illuminate_translation

require_once __DIR__ . '/functions.php';

// Get lang code from URL
$GLOBALS['lang_code'] = \Helper\Lang::get_lang_code_from_URI();

// Prepare the FileLoader
$file_system = new \Illuminate\Filesystem\Filesystem();
$loader = new \Illuminate\Translation\FileLoader($file_system, ROOT_PATH . '/lang');

// Register the English translator
$GLOBALS['illuminate_translation'] = new \Illuminate\Translation\Translator($loader, lang());


class SlimApp
{
    /**
     * Stores an instance of the Slim application.
     *
     * @var \Slim\App
     */
    private $app;

    public function __construct()
    {
        $configuration = [
            'settings' => [
                'displayErrorDetails' => true,
            ],
        ];

        $container = new \Slim\Container($configuration);

        $container['notFoundHandler'] = function ($c) {
            return function ($request, $response) use ($c) {
                $lang = 'ru'; // @TODO Bad
                return (new \PageController\Error\PageNotFound($c))->handle($lang, $c['request'], $c['response'], []);
            };
        };

        $app = new \Slim\App($container);

        // Set supported array on languages

        if (!defined('URL_PART_LANG')) {
            define('URL_PART_LANG', '/{lang:[en|ru]+}');
        }

        // API v1

        $app->group('/api/v1' . URL_PART_LANG, function () {

            // GET
            $this->get('/search/categories.json', '\APIController\GET\SearchCategories:handle');

            // DELETE
            $this->delete('/categories/{id}/follow.json', '\APIController\DELETE\CategoriesIDFollow:handle');
            $this->delete('/questions/{id}/follow.json', '\APIController\DELETE\QuestionsIDFollow:handle');
            $this->delete('/questions/{id}/subscribe.json', '\APIController\DELETE\QuestionsIDSubscribe:handle');
            $this->delete('/users/{id}/follow.json', '\APIController\DELETE\UsersIDFollow:handle');

            // PATCH
            $this->patch('/categories/{id}/rename.json', '\APIController\PATCH\CategoriesIDRename:handle');
            $this->patch('/questions/{id}/rename.json', '\APIController\PATCH\QuestionsIDRename:handle');
            $this->patch('/users/{id}/signature.json', '\APIController\PATCH\UsersIDSignature:handle');
            $this->patch('/users/{id}/site.json', '\APIController\PATCH\UsersIDSite:handle');
            $this->patch('/users/{id}/name.json', '\APIController\PATCH\UsersIDName:handle');

            // POST
            $this->post('/answers/render.json', '\APIController\POST\Answers\Render:handle');
            $this->post('/avatar.json', '\APIController\POST\Avatar:handle');
            $this->post('/categories.json', '\APIController\POST\Categories:handle');
            $this->post('/categories/{id}/follow.json', '\APIController\POST\CategoriesIDFollow:handle');
            $this->post('/login.json', '\APIController\POST\Login:handle');
            $this->post('/logout.json', '\APIController\POST\Logout:handle');
            $this->post('/questions.json', '\APIController\POST\Questions:handle');
            $this->post('/questions/{id}/image.json', '\APIController\POST\Questions\ID\Image:handle');
            $this->post('/questions/{id}/follow.json', '\APIController\POST\QuestionsIDFollow:handle');
            $this->post('/questions/{id}/subscribe.json', '\APIController\POST\QuestionsIDSubscribe:handle');
            $this->post('/signup.json', '\APIController\POST\Signup:handle');
            $this->post('/users/{id}/follow.json', '\APIController\POST\UsersIDFollow:handle');

            // PUT
            $this->put('/questions/{id}.json', '\APIController\PUT\QuestionsID:handle');
            $this->put('/questions/{id}/answer.json', '\APIController\PUT\QuestionsIDAnswer:handle');
            $this->put('/questions/{id}/categories.json', '\APIController\PUT\Questions\ID\Categories:handle');
        });

        // Publuc URI`s

        $app->group(URL_PART_LANG, function () {
            $this->get('', '\PageController\Main\Show:handle');
            $this->get('/answer/{id}/edit', '\PageController\Answer\Edit:handle');
            $this->get('/answer/{id}/history', '\PageController\Answer\History:handle');
            $this->get('/feed', '\PageController\Feed\Show:handle');
            $this->get('/flow', '\PageController\Flow\Show:handle');
            $this->get('/category/{category_uri}', '\PageController\Category\Show:handle');
            $this->get('/categories/newest', '\PageController\Categories\Newest:handle');
            // @NOTE To realize $this->get('/categories/popular', 'List_Categories_PageController:handle');
            $this->get('/question/{id}/categories', '\PageController\Question\UpdateCategories:handle');
            $this->get('/question/{id}/discussion', '\PageController\Question\Discussion:handle');
            $this->get('/questions/newest', '\PageController\Questions\Newest:handle');
            $this->get('/questions/recently-updated', '\PageController\Questions\RecentlyUpdated:handle');
            $this->get('/random-question', '\PageController\Question\Random:handle');
            $this->get('/sandbox/all', '\PageController\Sandbox\All:handle');
            $this->get('/sandbox/without-answers', '\PageController\Sandbox\WithoutAnswers:handle');
            $this->get('/sandbox/without-categories', '\PageController\Sandbox\WithoutCategories:handle');
            $this->get('/search', '\PageController\Search\Show:handle');
            $this->get('/settings', '\PageController\Settings\Show:handle');
            $this->get('/sitemap.xml', '\PageController\SitemapXML\Lang:handle');
            $this->get('/user/{id}', '\PageController\User\ShortURL:handle');
            $this->get('/users/newest', '\PageController\Users\Newest:handle');
            $this->get('/@{username}', '\PageController\User\Show:handle');
            $this->get('/{question_uri}', '\PageController\Question\Show:handle');
            $this->get('/{id:[0-9]+}[/{uri_slug}]', '\PageController\Question\Show:handleByID'); // @TODO Deprecated
        });

        // Language-agnostic URLs

        $app->get('/sitemap.xml', '\PageController\SitemapXML\Index:handle');
        $app->get('/', '\PageController\Root\Show:handle');

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function get_app()
    {
        return $this->app;
    }
}
