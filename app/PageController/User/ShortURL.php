<?php

class ShortURL_User_PageController extends Abstract_PageController
{
    public function handle($request, $response, $args)
    {
        $userID = $args['id'];
        $this->lang = $args['lang'];

        $user = (new User_Query())->userWithID($userID);

        return $response->withRedirect($user->getURL($this->lang), 301);
    }
}
