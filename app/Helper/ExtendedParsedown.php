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
        $text = self::_preProcessing($text);
        $textHTML = parent::text($text);
        $textHTML = self::_postProcessing($textHTML);

        return $textHTML;
    }

    /**
     * Only H2-H6 header tags in Q-article body.
     */
    protected function blockHeader($Line)
    {
        if (isset($Line['text'][1])) {
            $level = 1;

            while (isset($Line['text'][$level]) and $Line['text'][$level] === '#') {
                $level++;
            }

            // changed from 6 to 5
            if ($level > 5) {
                return;
            }

            $text = trim($Line['text'], '# ');

            // increase H-tag (because H1 is busy)
            $hDigit = min(5, $level) + 1;

            $Block = [
                'element' => [
                    'name'    => 'h'.$hDigit,
                    'text'    => $text,
                    'handler' => 'line',
                ],
            ];

            return $Block;
        }
    }

    //
    // Protected Methods
    //

    protected function _preProcessing(string $text): string
    {
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

                    return '['.$matches[1].']('.$category->get_URL($this->lang).')';
                }

                return $matches[0];
            },
            $text
        );

        // [foo] --> [foo]()
        $text = preg_replace("/\[([^\]]+)\]([^\(])/iu", '[$1]()$2', $text);

        // [foo]() --> [foo](foo)
        $text = preg_replace("/\[([^\]]+)\]\(\)/iu", '[$1]($1)', $text);

        // [foo](bar) --> [foo](https://answeropedia.org/lang/bar)
        $text = preg_replace_callback(
            "/\[([^\]]+)\]\(([^\)]+)\)/iu",
            function ($matches) {
                $reference_part = $matches[2];
                if (!filter_var($reference_part, FILTER_VALIDATE_URL)) {
                    $question = Question_Model::initWithTitle($reference_part);

                    return '['.$matches[1].']('.$question->get_URL($this->lang).')';
                }

                return $matches[0];
            },
            $text
        );

        return $text;
    }

    protected function _postProcessing(string $textHTML): string
    {
        // Fix external URL`s (like a href="https://answeropedia.org/ru/http://site.com/page")
        $incorrect_URL_pattern = "/href\=\"https\:\/\/answeropedia\.org\/".$this->lang."\/(https?.+(?!answeropedia\.org).+)\"/iuU";
        $textHTML = preg_replace_callback(
            $incorrect_URL_pattern,
            function ($matches) {
                return 'href="'.urldecode($matches[1]).'"';
            },
            $textHTML
        );

        // Add attributes to external URL`s (class="link-external" target="_blank" rel="nofollow")
        $textHTML = preg_replace_callback(
            "/href\=\"(https?\:\/\/(?!answeropedia\.org).+)\"/iuU",
            function ($matches) {
                return 'href="'.$matches[1].'" class="link-external" target="_blank" rel="nofollow"';
            },
            $textHTML
        );

        return $textHTML;
    }
}
