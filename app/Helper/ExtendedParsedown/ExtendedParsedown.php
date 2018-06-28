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

    // Redefine Parsedown method
    protected function element(array $Element)
    {
        $Element = $this->additionalProcessElement($Element);
        $Element = parent::element($Element);

        return $Element;
    }

    /**
     * @param array $Element
     * https://stackoverflow.com/questions/47145213/add-target-blank-to-external-link-parsedown-php
     * @return array
     */
    protected function additionalProcessElement($Element)
    {
        if ($Element['name'] == 'a' && $this->isExternalUrl($Element['attributes']['href'])) {
            $Element['attributes']['class'] = 'external-link';
            $Element['attributes']['target'] = '_blank';
            $Element['attributes']['rel'] = 'nofollow';
        }

        return $Element;
    }

    /**
     * Modification of the funciton from answer to the question "How To Check Whether A URL Is External URL or Internal URL With PHP?"
     * @param string $url
     * @return bool
     */
    protected function isExternalUrl($url) {
        return !preg_match('/^https:\/\/octoanswers\.com/', $url);
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
                    'name' => 'h'.$hDigit,
                    'text' => $text,
                    'handler' => 'line',
                ),
            );

            return $Block;
        }
    }
}
