<?php

class Show_User_PageController extends Abstract_PageController
{
    protected $user;
    protected $revisions;
    protected $questions;

    protected $followed;

    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->username = $args['username'];

        $this->user = (new User_Query())->userWithUsername($this->username);
        if (!$this->user) {
            return (new InternalServerError_Error_PageController($this->container))->handle($this->lang, $request, $response, $args);
        }

        $this->revisions = (new Revisions_Query($this->lang))->findRevisionsForUserWithID($this->user->getID());

        $this->questions = [];
        foreach ($this->revisions as &$revision) {
            $this->questions[] = (new Question_Query($this->lang))->questionWithID($revision->getAnswerID());
        }

        $this->_prepareFollowButton();

        $this->template = 'user/show';
        $this->pageTitle = $this->user->getName().' '._('Wiki-answers on Answeropedia');
        $this->pageDescription = $this->user->getName().' '._('Wiki-answers on Answeropedia');
        $this->canonicalURL = $this->user->getURL($this->lang);

        $this->openGraph = $this->_getOpenGraph();

        // prepare 'logout' button
        if (($this->authUser != null) && ($this->authUser->getID() == $this->user->getID())) {
            $this->additionalJavascript[] = 'user/logout';
            $this->additionalJavascript[] = 'enable_tooltips';
        }

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }

    protected function _prepareFollowButton()
    {
        if ($this->authUser && $this->authUser->getID() != $this->user->getID()) {
            $authUserID = $this->authUser->getID();
            $followedUserID = $this->user->getID();

            $relation = (new UsersFollowUsers_Relations_Query($this->lang))->relationWithUserIDAndFollowedUserID($authUserID, $followedUserID);

            $this->followed = $relation ? true : false;
            $this->additionalJavascript[] = 'user/follow';
        }
    }

    protected function _getOpenGraph()
    {
        $og = [
            'url' => $this->user->getURL($this->lang),
            'type' => "website",
            'title' => $this->user->getName(),
            'description' => $this->user->getName().' '._('Wiki-answers on Answeropedia'),
            'locale' => $this->lang,
            'image' => IMAGE_URL.'/og-image.png'
        ];
        return $og;
    }
}
