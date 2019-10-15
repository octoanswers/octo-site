<?php

namespace PageController\Question;

class ShortURL extends \PageController\PageController
{
    public function handle($request, $response, $args)
    {
        $lang = $request->getAttribute('lang');
        $questionID = $request->getAttribute('id');

        $this->lang = $lang;

        try {
            $question = (new \Query\Question($this->lang))->questionWithID($questionID);
        } catch (\Throwable $e) {
            return (new \PageController\Error\PageNotFound($this->container))->handle($request, $response);
        }

        return $response->withRedirect($question->getURL($this->lang), 301);
    }
}
