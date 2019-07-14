<?php

class ExtendedParsedown extends Parsedown
{
    protected $lang;

    public function __construct(string $lang)
    {
        if (in_array('__construct', get_class_methods(get_parent_class($this)))) {
            parent::__construct();
        }
        $this->lang = $lang;
    }

    public function text($text)
    {
        // @TODO Move to PreParser?

        // {foo} --> {foo}()
        $text = preg_replace("/\{([^\}]+)\}([^\(])/iu", '{$1}()$2', $text);

        // {foo}() --> {foo}(foo)
        $text = preg_replace("/\{([^\}]+)\}\(\)/iu", '{$1}($1)', $text);

        // {foo}(bar) --> [foo](https://answeropedia.org/lang/category/foo)
        $text = preg_replace_callback(
            "/\{([^\}]+)\}\(([^\)]+)\)/iu",
            function ($matches) {
                //$title_part = $matches[1];
                $reference_part = $matches[2];
                if (!filter_var($reference_part, FILTER_VALIDATE_URL)) {
                    $category = Category::initWithTitle($reference_part);
                    return "[" . $matches[1] . "](" . $category->getURL($this->lang) . ")";
                }
                return $matches[0];
            },
            $text
        );

        // [foo] --> [foo]()
        $text = preg_replace("/\[([^\]]+)\]([^\(])/iu", "[$1]()$2", $text);

        // [foo]() --> [foo](foo)
        $text = preg_replace("/\[([^\]]+)\]\(\)/iu", "[$1]($1)", $text);

        // [foo](bar) --> [foo](https://answeropedia.org/lang/bar)
        $text = preg_replace_callback(
            "/\[([^\]]+)\]\(([^\)]+)\)/iu",
            function ($matches) {
                //$title_part = $matches[1];
                $reference_part = $matches[2];
                if (!filter_var($reference_part, FILTER_VALIDATE_URL)) {
                    $question = Question_Model::initWithTitle($reference_part);
                    return "[" . $matches[1] . "](" . $question->getURL($this->lang) . ")";
                }
                return $matches[0];
            },
            $text
        );

        // if (!$this->_isAnsweropediaURL($reference_part)) {
        //     // External link
        //     $element['attributes']['class'] = 'link-external';
        //     $element['attributes']['target'] = '_blank';
        //     $element['attributes']['rel'] = 'nofollow';
        // }

        return parent::text($text);
    }

    /**
     * Only H2-H6 header tags in Q-article body.
     */
    protected function blockHeader($Line)
    {
        if (isset($Line['text'][1])) {
            $level = 1;

            while (isset($Line['text'][$level]) and $Line['text'][$level] === '#') {
                ++$level;
            }

            // changed from 6 to 5
            if ($level > 5) {
                return;
            }

            $text = trim($Line['text'], '# ');

            // increase H-tag (because H1 is busy)
            $hDigit = min(5, $level) + 1;

            $Block = array(
                'element' => array(
                    'name' => 'h' . $hDigit,
                    'text' => $text,
                    'handler' => 'line',
                ),
            );

            return $Block;
        }
    }

    protected function _isAnsweropediaURL($url)
    {
        return preg_match('/^https:\/\/' . SITE_URL_NAME . '\.org/', $url);
    }
}
