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
     * @var string $key
     * @var string $subkey
     */
    public function get(string $key, string $subkey = null): string
    {
        if (!$subkey) {
            if (isset($this->messages[$key])) {
                if (is_array($this->messages[$key])) {
                    return 'KEY_IS_ARRAY: language "'.$this->lang.'" key "'.$key.'"';
                }
                return $this->messages[$key];
            }
        } else {
            if (isset($this->messages[$key]) && isset($this->messages[$key][$subkey])) {
                if (is_array($this->messages[$key][$subkey])) {
                    return 'KEY_IS_ARRAY: language "'.$this->lang.'" key "'.$key.'" subkey "'.$subkey.'"';
                }
                return $this->messages[$key][$subkey];
            }

            return 'NEED TRANSLATE: language "'.$this->lang.'" key "'.$key.'" subkey "'.$subkey.'"';
        }

        return $key;
    }
}
