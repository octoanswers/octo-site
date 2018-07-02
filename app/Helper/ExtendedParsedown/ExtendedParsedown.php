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
     * @return array
     */
    protected function additionalProcessElement($Element)
    {
        if ($Element['name'] != 'a') {
            return $Element;
        }

        if ($this->isOctoanswersURL($Element['attributes']['href'])) {
            return $Element;
        }

        if ($this->isExternalUrl($Element['attributes']['href'])) {
            $Element['attributes']['class'] = 'link-external';
            $Element['attributes']['target'] = '_blank';
            $Element['attributes']['rel'] = 'nofollow';
        } else {
            // Broken URL by default
            $Element['attributes']['class'] = 'link-broken';
            $Element['attributes']['target'] = '_blank';
            $Element['attributes']['rel'] = 'nofollow';
        }

        return $Element;
    }

    protected function isOctoanswersURL($url) {
        return preg_match('/^https:\/\/octoanswers\.com/', $url);
    }

    protected function isExternalUrl($url) {
        return preg_match('/^(http|https):\/\//', $url);
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
