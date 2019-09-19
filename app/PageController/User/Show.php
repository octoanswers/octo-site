<?php

class Show_User_PageController extends Abstract_PageController
{
    protected $user;
    protected $revisions;
    protected $questions;

    protected $followed;

    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $this->username = $args['username'];

        $this->user = (new \Query\User())->user_with_username($this->username);
        if (!$this->user) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new \Query\Revisions($this->lang))->find_revisions_for_user_with_ID($this->user->id);

        $this->questions = [];
        foreach ($this->revisions as &$revision) {
            $this->questions[] = (new \Query\Question($this->lang))->question_with_ID($revision->answerID);
        }

        $this->_prepare_follow_button();

        $this->template = 'user';
        $this->pageTitle = $this->user->name . ' ' . $this->translator->get('user', 'answers_on_answeropedia');
        $this->pageDescription = $this->user->name . ' ' . $this->translator->get('user', 'answers_on_answeropedia');
        $this->canonicalURL = $this->user->get_URL($this->lang);

        $this->open_graph = $this->_get_open_graph();

        // prepare 'logout' button
        if (($this->authUser != null) && ($this->authUser->id == $this->user->id)) {
            $this->includeJS[] = 'user/logout';
            $this->includeJS[] = 'enable_tooltips';

            $this->includeModals[] = 'user/logout';
        }

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _prepare_follow_button()
    {
        if ($this->authUser && $this->authUser->id != $this->user->id) {
            $authUserID = $this->authUser->id;
            $followedUserID = $this->user->id;

            $relation = (new \Query\Relations\UsersFollowUsers($this->lang))->relation_with_user_ID_and_followed_user_ID($authUserID, $followedUserID);

            $this->followed = $relation ? true : false;
            $this->includeJS[] = 'user/follow';
        }
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => $this->user->get_URL($this->lang),
            'type'        => 'website',
            'title'       => $this->user->name,
            'description' => $this->user->name . ' ' . $this->translator->get('user', 'answers_on_answeropedia'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL . '/og-image.png',
        ];

        return $og;
    }
}
