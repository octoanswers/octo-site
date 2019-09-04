<?php

class ShortURL_User_PageController extends Abstract_PageController
{
    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $userID = $args['id'];

        $user = (new User_Query())->user_with_ID($userID);

        return $response->withRedirect($user->get_URL($this->lang), 301);
    }
}
