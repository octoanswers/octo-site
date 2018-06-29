<?php

class AWApp
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
                return (new PageNotFound_Error_PageController($c))->handle($lang, $c['request'], $c['response'], []);
            };
        };

        $app = new \Slim\App($container);

        # Set supported array on languages

        if (!defined('URL_PART_LANG')) {
            define('URL_PART_LANG', '/{lang:[en|ru]+}');
        }

        # API v1

        $app->group('/api/v1'.URL_PART_LANG, function () {
            // /users : list of users
            // /users/{id} : specific user
            // /users/{id}/topics : list of tags used by this specific user
            // /users/{id}/posts : list of posts liked by this specific user
            // /users/{id}/follows
            // /users/{id}/follows/topics
            // /users/{id}/follows/questions
            //$app->get('/users/{user_id}/feeds.json', 'GetUsersIDFeedsAPI:handle');
            // /api/v1/users/{user_id}/feeds/topics.json
            // /users/{id}/feeds/questions.json

            $this->delete('/topics/{id}/follow.json', 'TopicsIDFollow_DELETE_APIController:handle');
            $this->delete('/questions/{id}/follow.json', 'QuestionsIDFollow_DELETE_APIController:handle');
            $this->delete('/questions/{id}/subscribe.json', 'QuestionsIDSubscribe_DELETE_APIController:handle');
            $this->delete('/users/{id}/follow.json', 'UsersIDFollow_DELETE_APIController:handle');

            $this->patch('/questions/{id}/rename.json', 'QuestionsIDRename_PATCH_APIController:handle');
            $this->patch('/users/{id}/signature.json', 'UsersIDSignature_PATCH_APIController:handle');
            $this->patch('/users/{id}/site.json', 'UsersIDSite_PATCH_APIController:handle');
            $this->patch('/users/{id}/name.json', 'UsersIDName_PATCH_APIController:handle');

            $this->post('/avatar.json', 'Avatar_POST_APIController:handle');
            $this->post('/topics/{id}/follow.json', 'TopicsIDFollow_POST_APIController:handle');
            $this->post('/login.json', 'Login_POST_APIController:handle');
            $this->post('/logout.json', 'Logout_POST_APIController:handle');
            $this->post('/questions.json', 'Questions_POST_APIController:handle');
            $this->post('/questions/{id}/image.json', 'Image_ID_Questions_POST_APIController:handle');
            $this->post('/questions/{id}/follow.json', 'QuestionsIDFollow_POST_APIController:handle');
            $this->post('/questions/{id}/subscribe.json', 'QuestionsIDSubscribe_POST_APIController:handle');
            $this->post('/signup.json', 'Signup_POST_APIController:handle');
            $this->post('/users/{id}/follow.json', 'UsersIDFollow_POST_APIController:handle');

            $this->put('/answers/{id}.json', 'AnswersID_PUT_APIController:handle');
            $this->put('/questions/{id}.json', 'QuestionsID_PUT_APIController:handle');
            $this->put('/questions/{id}/topics.json', 'Topics_ID_Questions_PUT_APIController:handle');
        });

        # Publuc URI`s

        $app->group(URL_PART_LANG, function () {
            $this->get('', 'Show_Main_PageController:handle');
            $this->get('/answer/{id}/edit', 'Edit_Answer_PageController:handle');
            $this->get('/answer/{id}/history', 'History_Answer_PageController:handle');
            $this->get('/feed', 'Show_Feed_PageController:handle');
            $this->get('/flow', 'Show_Flow_PageController:handle');
            $this->get('/topic/{id:[0-9]+}[/{uri_slug}]', 'Show_Topic_PageController:handle');
            $this->get('/topic/{uri}', 'Show_Topic_PageController:handleByURI'); // @TODO Deprecated
            $this->get('/topics/newest', 'Newest_Topics_PageController:handle');
            // @NOTE To realize $this->get('/topics/popular', 'List_Topics_PageController:handle');
            $this->get('/question/{id}/topics', 'UpdateTopics_Question_PageController:handle');
            $this->get('/questions/newest', 'Newest_Questions_PageController:handle');
            $this->get('/questions/recently-updated', 'RecentlyUpdated_Questions_PageController:handle');
            $this->get('/sandbox/all', 'All_Sandbox_PageController:handle');
            $this->get('/sandbox/without-answers', 'WithoutAnswers_Sandbox_PageController:handle');
            $this->get('/sandbox/without-topics', 'WithoutTopics_Sandbox_PageController:handle');
            $this->get('/search', 'Questions_Search_PageController:handle'); // @NOTE Dont used
            $this->get('/settings', 'Show_Settings_PageController:handle');
            $this->get('/sitemap.xml', 'Lang_SitemapXML_PageController:handle');
            $this->get('/user/{id}', 'ShortURL_User_PageController:handle');
            $this->get('/users/newest', 'Newest_Users_PageController:handle');
            $this->get('/+{username}', 'Show_User_PageController:handle');
            $this->get('/{id:[0-9]+}[/{uri_slug}]', 'Show_Question_PageController:handle');
            $this->get('/{question_uri}', 'Show_Question_PageController:handleByURI'); // @TODO Deprecated
        })->add(new Gettext_Middleware());

        # Language-agnostic URLs

        $app->get('/sitemap.xml', 'Index_SitemapXML_PageController:handle');
        $app->get('/', 'Show_Root_PageController:handle');

        $this->app = $app;
    }

    /**
     * Get an instance of the application.
     *
     * @return \Slim\App
     */
    public function getApp()
    {
        return $this->app;
    }
}
