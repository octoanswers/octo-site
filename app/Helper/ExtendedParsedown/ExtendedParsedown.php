<?php

class ExtendedParsedown extends Parsedown
{
    const CATEGORY_PATTERN = '/#([^\s\W]+)/u';

    protected $lang;

    public function __construct(string $lang)
    {
        if (in_array('__construct', get_class_methods(get_parent_class($this)))) {
            parent::__construct();
        }
        $this->lang = $lang;

        $this->InlineTypes['#'][]= 'TopicMention';
        $this->inlineMarkerList .= '#';
    }

    protected function inlineTopicMention($Excerpt)
    {
        if (preg_match(self::CATEGORY_PATTERN, $Excerpt['context'], $matches)) {
            $category = new Category();
            $category->title = $matches[1];
            $categoryURL = $category->getURL($this->lang);
            
            return [
                'extent' => strlen($matches[0]),
                'element' => [
                    'name' => 'a',
                    'text' => $matches[0],
                    'attributes' => [
                        'href' => $categoryURL,
                        'title' => '#'.$category->title,
                        'class' => 'inline-category',
                    ],
                ],
            ];
        }
    }

    /**
     * Overwrite methods from Parsedown
     */
    protected function inlineLink($excerpt)
    {
        $offset = 0;
        $offsetAdjustment = 0;

        // Transform empty links [foo]() to [foo](foo)
        $shortLinkPattern = '/\[(.+)\](\(\))/uU';
        $replacement = '[$1]($1)';
        if (preg_match($shortLinkPattern, $excerpt['text'], $matches)) {
            $excerpt['text'] = preg_replace($shortLinkPattern, $replacement, $excerpt['text']);
            $excerpt['context'] = preg_replace($shortLinkPattern, $replacement, $excerpt['context']);
            // @NOTE Учитывая, что мы изменяем длинну строк, необходимо будет скорректировать отступ.
            $offsetAdjustment = strlen($matches[0]) - 4;
        }

        // Proced default links like a [foo](What is foo?)
        if (preg_match('/\[(.+)\]\((.+)\)/uU', $excerpt['text'], $matches)) {
            // Get body and reference part of link [body](REF)
            $bodyPart = $matches[1];
            $referencePart = $matches[2];

            $offset = strlen($matches[0]) - $offsetAdjustment;
            
            $question = Question_Model::initWithTitle($referencePart);

            $element = [
                'name' => 'a',
                'handler' => 'line',
                'text' => $bodyPart,
                'attributes' => [
                    'href' => $question->getURL($this->lang),
                    'title' => $referencePart,
                ],
            ];

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
        // maybe #topic, not header?
        if (preg_match(self::CATEGORY_PATTERN, $Line['text'], $matches)) {
            return;
        }

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
                    'name' => 'h'.$hDigit,
                    'text' => $text,
                    'handler' => 'line',
                ),
            );

            return $Block;
        }
    }

    protected function _isAnsweropediaURL($url)
    {
        return preg_match('/^https:\/\/'.SITE_URL_NAME.'\.org/', $url);
    }
}
