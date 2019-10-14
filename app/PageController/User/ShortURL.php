<?php

namespace PageController\User;

class ShortURL extends \PageController\PageController
{
    public function handle($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->user_ID = (int) $args['id'];

        try {
            $user = (new \Query\User())->userWithID($this->user_ID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\PageNotFound($this->container))->handle($this->lang, $request, $response, $args);
        }

        return $response->withRedirect($user->getURL($this->lang), 301);
    }
}
