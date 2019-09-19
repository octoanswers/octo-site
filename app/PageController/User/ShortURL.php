<?php

namespace PageController\User;

class ShortURL extends \PageController\PageController
{
    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $userID = $args['id'];

        $user = (new \Query\User())->user_with_ID($userID);

        return $response->withRedirect($user->get_URL($this->lang), 301);
    }
}
