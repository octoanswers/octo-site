<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class Show_Feed_PageController extends Abstract_PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        $this->lang = $args['lang'];

        if (!$this->authUser) {
            exit('Not logged!');
        }

        $userID = $this->authUser->getID();

        $res = (new Feeds_Query($this->lang))->findFeedsForUserWithID($userID);
        $this->activities = $res['activities'];

        $human_date_timezone = new DateTimeZone('UTC');
        $date_humanizer = new HumanDate($human_date_timezone, $this->lang);

        foreach ($this->activities as &$activity) {
            $activity['data'] = json_decode($activity['data'], true);
            if (json_last_error()) {
                $activity['activity_type'] = 'JSON_DECODE_ERROR';
                continue;
            }
            $activity['created_at__humanized'] = $date_humanizer->format($activity['created_at']);
        };

        $follows_users = (new UsersFollowUsers_Relations_Query($this->lang))->findUsersFollowedByUser($userID);
        $this->isShowUsersFollowLure = (count($follows_users) < 3);

        $follows_hashtags = (new UsersFollowHashtags_Relations_Query($this->lang))->findHashtagsFollowedByUser($userID);
        $this->isShowHashtagsFollowLure = (count($follows_hashtags) < 3);

        $follows_questions = (new UsersFollowQuestions_Relations_Query($this->lang))->findQuestionsFollowedByUser($userID);
        $this->isShowQuestionsFollowLure = (count($follows_questions) < 3);

        $this->template = 'feed';
        $this->showFooter = false;
        $this->pageTitle = _('Feed').' - '._('Answeropedia');
        $this->canonicalURL = SITE_URL;

        $output = $this->renderPage();
        $response->getBody()->write($output);

        return $response;
    }
}
