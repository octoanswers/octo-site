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

        $this->user = (new User_Query())->userWithUsername($this->username);
        if (!$this->user) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new Revisions_Query($this->lang))->findRevisionsForUserWithID($this->user->id);

        $this->questions = [];
        foreach ($this->revisions as &$revision) {
            $this->questions[] = (new Question_Query($this->lang))->questionWithID($revision->answerID);
        }

        $this->_prepareFollowButton();

        $this->template = 'user';
        $this->pageTitle = $this->user->name.' '.$this->translator->get('Wiki-answers on Answeropedia');
        $this->pageDescription = $this->user->name.' '.$this->translator->get('Wiki-answers on Answeropedia');
        $this->canonicalURL = $this->user->getURL($this->lang);

        $this->openGraph = $this->_getOpenGraph();

        // prepare 'logout' button
        if (($this->authUser != null) && ($this->authUser->id == $this->user->id)) {
            $this->includeJS[] = 'user/logout';
            $this->includeJS[] = 'enable_tooltips';

            $this->includeModals[] = 'user/logout';
        }

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _prepareFollowButton()
    {
        if ($this->authUser && $this->authUser->id != $this->user->id) {
            $authUserID = $this->authUser->id;
            $followedUserID = $this->user->id;

            $relation = (new UsersFollowUsers_Relations_Query($this->lang))->relationWithUserIDAndFollowedUserID($authUserID, $followedUserID);

            $this->followed = $relation ? true : false;
            $this->includeJS[] = 'user/follow';
        }
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => $this->user->getURL($this->lang),
            'type' => "website",
            'title' => $this->user->name,
            'description' => $this->user->name.' '.$this->translator->get('Wiki-answers on Answeropedia'),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
