<?php

class ExtendedParsedown extends Parsedown
{
    const HASHTAG_PATTERN = '/#([^\s\W]+)/u';

    protected $lang;

    public function __construct(string $lang)
    {
        if (in_array('__construct', get_class_methods(get_parent_class($this)))) {
            parent::__construct();
        }
        $this->lang = $lang;
    }

    protected function inlineLink($excerpt)
    {
        $element = [
            'name' => 'a',
            'handler' => 'line',
            'text' => null,
            'attributes' => [
                'href' => null,
                'title' => null,
            ],
        ];

        $offset = 0;
        $remainder = $excerpt['text'];

        // search body part of link [BODY](ref)
        if (preg_match('/\[((?:[^][]++|(?R))*+)\]/', $remainder, $matches)) {
            $element['text'] = $matches[1];
            $offset += strlen($matches[0]);
            $remainder = substr($remainder, $offset);
        } else {
            return;
        }

        // search reference part of link [body](REF)
        if (preg_match('/\((.*?)\)/', $remainder, $matches)) {
            if (filter_var($matches[1], FILTER_VALIDATE_URL)) {
                // if URL is canonical => external URL
                // attach some attributes to external link
                $element['attributes']['class'] = 'external-link';
                $element['attributes']['target'] = '_blank';
                $element['attributes']['rel'] = 'nofollow';
            } else {
                if ($matches[1] == '') {
                    // URL empty => make internal link from body part
                    $question = Question_Model::initWithTitle($element['text']);
                    $matches[1] = $question->getURL($this->lang);
                } else {
                    // URL not canonical => internal wiki-link
                    $question = Question_Model::initWithTitle($matches[1]);
                    $matches[1] = $question->getURL($this->lang);
                }
            }

            $element['attributes']['href'] = $matches[1];

            if (isset($matches[2])) {
                $element['attributes']['title'] = substr($matches[2], 1, -1);
            }

            $offset += strlen($matches[0]);
        } else {
            // reference part of link not found => local URI
            $question = Question_Model::initWithTitle($element['text']);
            $linkFromText = $question->getURL($this->lang);

            $element['attributes']['href'] = $linkFromText;
            $element['attributes']['title'] = null;
        }

        $element['attributes']['href'] = str_replace(array('&', '<'), array('&amp;', '&lt;'), $element['attributes']['href']);

        return array(
            'extent' => $offset,
            'element' => $element,
        );
    }

    /**
     * Only H2-H6 header tags in Q-article body.
     */
    protected function blockHeader($Line)
    {
        // maybe #topic, not header?
        if (preg_match(self::HASHTAG_PATTERN, $Line['text'], $matches)) {
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
}
