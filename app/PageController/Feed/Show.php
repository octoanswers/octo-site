<?php

namespace PageController\Feed;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Show extends \PageController\PageController
{
    public function handle(Request $request, Response $response, $args): Response
    {
        parent::handleRequest($request, $response, $args);

        if (!$this->authUser) {
            exit('Not logged!');
        }

        $user_ID = $this->authUser->id;

        $res = (new \Query\Feeds($this->lang))->find_feeds_for_user_with_ID($user_ID);
        $this->activities = $res['activities'];

        $human_date_timezone = new \DateTimeZone('UTC');
        $date_humanizer = new \Humanizer\HumanDate\HumanDate($human_date_timezone, $this->lang);

        foreach ($this->activities as &$activity) {
            $activity['data'] = json_decode($activity['data'], true);
            if (json_last_error()) {
                $activity['activity_type'] = 'JSON_DECODE_ERROR';
                continue;
            }
            $activity['created_at__humanized'] = $date_humanizer->format($activity['created_at']);
        }

        $follows_users = (new \Query\Relations\UsersFollowUsers($this->lang))->find_users_followed_by_user($user_ID);
        $this->isShowUsersFollowLure = (count($follows_users) < 3);

        $follows_categories = (new \Query\Relations\UsersFollowCategories($this->lang))->find_categories_followed_by_user($user_ID);
        $this->isShowCategoriesFollowLure = (count($follows_categories) < 3);

        $follows_questions = (new \Query\Relations\UsersFollowQuestions($this->lang))->find_questions_followed_by_user($user_ID);
        $this->isShowQuestionsFollowLure = (count($follows_questions) < 3);

        $this->template = 'feed';
        $this->showFooter = false;
        $this->pageTitle = __('page_feed.page_title') . ' – ' . __('common.answeropedia');
        $this->canonicalURL = SITE_URL;

        $output = $this->render_page();
        $response->getBody()->write($output);

        return $response;
    }
}
