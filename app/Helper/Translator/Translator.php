<?php

/**
 * Simple translator without dependency.
 */
class Translator
{
    const TRANSLATED_FILE_EXTENSION = 'json';

    /**
     * @var string Language code.
     */
    private $lang;

    /**
     * @var array[string] Array with translated messages.
     */
    private $messages;

    /**
     * @var array Save last full key (need for return correct message, if key not found).
     */
    private $lastFullKey;

    /**
     * Returns instance of this class.
     *
     * @var string $lang Language code.
     * @var string $messagesDirectory Directory with translated JSON-files.
     */
    public function __construct(string $lang, string $messagesDirectory)
    {
        $this->lang = $lang;

        $fileWithMessages = $messagesDirectory.'/'.$lang.'.json';

        if (!file_exists($fileWithMessages)) {
            throw new Exception('File with translated messages "'.$this->lang.'.json" not exists', 1);
        }

        $string = file_get_contents($fileWithMessages);
        $messages = json_decode($string, true);

        if ($messages == null) {
            die("Error in $fileWithMessages");
        }
        
        //$this->messages[$this->lang] = $messages;
        $this->messages = $messages;
       
        return $this;
    }

    /**
     * Return language code.
     *
     * @var string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Return translated message OR message key (if message not found).
     *
     * @var string
     */
    public function get(...$key)
    {
        $this->lastFullKey = $key;

        return $this->_elementExists($key, $this->messages);
    }

    /**
     * Alternative form for "get" method.
     *
     * @param string $key
     */
    public function __(...$key)
    {
        $this->lastFullKey = $key;

        return $this->_elementExists($key, $this->messages);
    }

    /**
     * Recursive iterator for finding translation.
     */
    private function _elementExists($key, $array)
    {
        $fullKey = $key;

        if (is_array($key)) {
            $curArray = $array;
            $lastKey = array_pop($key);
            foreach($key as $oneKey) {
                if (!$this->_elementExists($oneKey, $curArray)) return false;
                $curArray = @$curArray[$oneKey];
            }
            if (is_array($curArray) && $this->_elementExists($lastKey, $curArray)) {
                return $this->_elementExists($lastKey, $curArray);
            }
        } else {
            if (is_array($array)) {
                if (isset($array[$key]) || array_key_exists($key, $array)) {
                    return $array[$key];
                }
            }
        }

        return 'MSG__'.$this->lang.'__'.implode('__', $this->lastFullKey);
    }
}