<?php

namespace PageController\User;

class ShortURL extends \PageController\PageController
{
    public function handle($request, $response, $args)
    {
        parent::handleRequest($request, $response, $args);

        $userID = (int) $args['id'];

        try {
            $user = (new \Query\User())->user_with_ID($userID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\PageNotFound($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($user->get_URL($this->lang), 301);
    }
}
