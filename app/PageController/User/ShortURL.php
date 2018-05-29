<?php

class ShortURL_User_PageController extends Abstract_PageController
{
    public function handle($request, $response, $args)
    {
        $userID = $args['id'];
        $this->lang = $args['lang'];

        $user = (new User_Query())->userWithID($userID);

        return $response->withRedirect(User_URL_Helper::getURL($this->lang, $user), 301);
    }
}
