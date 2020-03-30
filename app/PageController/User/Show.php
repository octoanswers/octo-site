<?php

namespace PageController\User;

class Show extends \PageController\PageController
{
    public function handleURLWithoutLang($request, $response, $args)
    {
        $lang = \Helper\Lang::getLangCodeFromBrowser();
        $username = $request->getAttribute('username');

        $user = new \Model\User();
        $user->username = $username;

        // @TODO Когда разделим PC & Controller, необходимо не редиректить, а просто показывать страницу.
        return $response->withRedirect($user->getURL($lang), 303);
    }

    public function handle($request, $response, $args)
    {
        $lang = $request->getAttribute('lang');
        $this->username = $request->getAttribute('username');

        $this->lang = $lang;

        $this->user = (new \Query\User())->userWithUsername($this->username);
        if (!$this->user) {
            return (new \PageController\Error\UserNotFound($this->container))->handle($request, $response);
        }

        $this->revisions = (new \Query\Revisions($this->lang))->findRevisionsForUserWithID($this->user->id);

        $this->questions = [];
        foreach ($this->revisions as &$revision) {
            $this->questions[] = (new \Query\Question($this->lang))->questionWithID($revision->answerID);
        }

        $this->_prepare_follow_button();

        $this->template = 'user';
        $this->pageTitle = $this->user->name.' '.__('page_user.answers_on_answeropedia');
        $this->pageDescription = $this->user->name.' '.__('page_user.answers_on_answeropedia');
        $this->canonicalURL = $this->user->getURL($this->lang);

        $this->open_graph = $this->_get_open_graph();

        $this->share_link['title'] = $this->user->name;
        $this->share_link['description'] = $this->user->name.' '.__('page_user.answers_on_answeropedia');
        $this->share_link['url'] = $this->user->getURL($this->lang);
        $this->share_link['image'] = SITE_URL.'/assets/img/og-image.png';

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

            $relation = (new \Query\Relations\UsersFollowUsers($this->lang))->relationWithUserIDAndFollowedUserID($authUserID, $followedUserID);

            $this->followed = $relation ? true : false;
            $this->includeJS[] = 'user/follow';
        }
    }

    protected function _get_open_graph()
    {
        $og = [
            'url'         => $this->user->getURL($this->lang),
            'type'        => 'website',
            'title'       => $this->user->name,
            'description' => $this->user->name.' '.__('page_user.answers_on_answeropedia'),
            'locale'      => $this->lang,
            'image'       => IMAGE_URL.'/og-image.png',
        ];

        return $og;
    }
}
