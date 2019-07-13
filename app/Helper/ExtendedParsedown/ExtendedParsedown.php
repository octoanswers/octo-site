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

    /**
     * Overwrite methods from Parsedown
     */
    protected function inlineLink($excerpt)
    {
        $offset = 0;
        $offsetAdjustment = 0;

        // Transform empty links [foo]() to [foo](foo)
        $short_link_pattern = '/\[(.+)\](\(\))/uU';
        $replacement = '[$1]($1)';
        if (preg_match($short_link_pattern, $excerpt['text'], $matches)) {
            $excerpt['text'] = preg_replace($short_link_pattern, $replacement, $excerpt['text']);
            $excerpt['context'] = preg_replace($short_link_pattern, $replacement, $excerpt['context']);

            $cat_cat_pattern = '/\[cat\:(.+)\]\(cat\:(.+)\)/uU';
            if (preg_match('/\[cat\:(.+)\]\(cat\:(.+)\)/uU', $excerpt['text'], $cat_matches)) {
                $excerpt['text'] = preg_replace($cat_cat_pattern, '[cat:$1]($1)', $excerpt['text']);
                $excerpt['context'] = preg_replace($cat_cat_pattern, '[cat:$1]($1)', $excerpt['context']);
            }

            // @NOTE Учитывая, что мы изменяем длинну строк, необходимо будет скорректировать отступ.
            $offsetAdjustment = strlen($matches[0]) - 4;
            if (preg_match('/\[cat\:(.+)\]\((.+)\)/uU', $excerpt['text'], $cat_matches)) {
                $offsetAdjustment = strlen($matches[0]) - 8;
            }
        }

        // Proced default links like a [foo](What is foo?)
        if (preg_match('/\[(.+)\]\((.+)\)/uU', $excerpt['text'], $matches)) {
            // Get body and reference part of link [body](REF)
            $bodyPart = $matches[1];
            $referencePart = $matches[2];

            $offset = strlen($matches[0]) - $offsetAdjustment;

            // Question-link or category-link?
            if (preg_match('/cat\:(.+)$/uU', $bodyPart, $cat_matches)) {
                $category = Category::initWithTitle($referencePart);
                $element =  [
                    'name' => 'a',
                    'text' => $cat_matches[1],
                    'attributes' => [
                        'href' => $category->getURL($this->lang),
                        'title' => $category->title,
                        'class' => 'inline-category'
                    ],
                ];
            } else {
                $question = Question_Model::initWithTitle($referencePart);
                $element = [
                    'name' => 'a',
                    'handler' => 'line',
                    'text' => $bodyPart,
                    'attributes' => [
                        'href' => $question->getURL($this->lang),
                        'title' => $referencePart
                    ],
                ];
            }

            // Reference part started with HTTP/HTTPS
            if (filter_var($referencePart, FILTER_VALIDATE_URL)) {
                $element['attributes']['href'] = $referencePart;
                $element['attributes']['title'] = null;
                if (!$this->_isAnsweropediaURL($referencePart)) {
                    // External link
                    $element['attributes']['class'] = 'link-external';
                    $element['attributes']['target'] = '_blank';
                    $element['attributes']['rel'] = 'nofollow';
                }
            }

            return ['extent' => $offset, 'element' => $element];
        }

        return;
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
