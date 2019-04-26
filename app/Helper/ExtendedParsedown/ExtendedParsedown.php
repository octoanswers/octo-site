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

        $this->InlineTypes['#'][]= 'TopicMention';
        $this->inlineMarkerList .= '#';
    }

    protected function inlineTopicMention($Excerpt)
    {
        if (preg_match(self::HASHTAG_PATTERN, $Excerpt['context'], $matches)) {
            $hashtag = new Hashtag();
            $hashtag->title = mb_strtolower($matches[1]);
            $hashtagURL = $hashtag->getURL($this->lang);
            
            return [
                'extent' => strlen($matches[0]),
                'element' => [
                    'name' => 'a',
                    'text' => $matches[0],
                    'attributes' => [
                        'href' => $hashtagURL,
                        'title' => $hashtag->title,
                        'class' => 'topic',
                    ],
                ],
            ];
        }
    }

    /**
     * Overwrite methods from Parsedown
     * Transform to link^
     * - [foo](foo) - Mark as link
     * - [foo] => [foo](foo)
     * - [foo]() => [foo](foo)
     */
    protected function inlineLink($excerpt)
    {
        

        //     $remainder = $excerpt['text'];
        //     // search body part of link [BODY](ref)
        //     if (preg_match('/\[((?:[^][]++|(?R))*+)\]/', $remainder, $matches)) {
        //          $element['text'] = $matches[1];
        //          $offset += strlen($matches[0]);
        // //         $remainder = substr($remainder, $offset);
        //     } else {
        //         return;
        //     }
        //

        //var_dump($excerpt);

        if (preg_match('/\[(.+)\]\((.+)\)/uU', $excerpt['text'], $matches)) {
            // Get body and reference part of link [body](REF)
            $bodyPart = $matches[1];
            $referencePart = $matches[2];

            $offset = strlen($matches[0]);
            
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


            //var_dump($element);

            return ['extent' => $offset, 'element' => $element];
        //         if (filter_var($matches[1], FILTER_VALIDATE_URL)) {
    //             // if URL is canonical => external URL
    //             // attach some attributes to external link
    //             $element['attributes']['class'] = 'external-link';
    //             $element['attributes']['target'] = '_blank';
    //             $element['attributes']['rel'] = 'nofollow';
    //             //$element['attributes']['title'] = '333';
    //             $element['attributes']['href'] = $matches[1];
    //         } else {
    //             if ($matches[1] == '') {
    //                 // URL empty => make internal link from body part
    //                 $question = Question_Model::initWithTitle($element['text']);
    //                 $matches[1] = $question->getURL($this->lang);
    //             } else {
    //                 // URL not canonical => internal wiki-link
    //                 $question = Question_Model::initWithTitle($matches[1]);
    //                 $matches[1] = $question->getURL($this->lang);
    //             }
    //             $element['attributes']['href'] = $matches[1];
    //             $element['attributes']['title'] = $question->title;
    //         }
            
    //         if (isset($matches[2])) {
    //             $element['attributes']['title'] = substr($matches[2], 1, -1);
    //         }
    //         $offset += strlen($matches[0]);
        } else {
            //         // reference part of link not found => local URI
    //         $question = Question_Model::initWithTitle($element['text']);
    //         $linkFromText = $question->getURL($this->lang);
    //         $element['attributes']['href'] = $linkFromText;
    //         $element['attributes']['title'] = null;
        }
        //     $element['attributes']['href'] = str_replace(array('&', '<'), array('&amp;', '&lt;'), $element['attributes']['href']);

        return;
    }
    

    protected function _isAnsweropediaURL($url)
    {
        return preg_match('/^https:\/\/'.SITE_URL_NAME.'\.org/', $url);
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
