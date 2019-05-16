<?php

/**
 * Simple translator for Answeropedia.
 */
class Translator
{
    const TRANSLATED_FILE_EXTENSION = 'json';

    /**
     * @var string Default language code.
     */
    private $lang = 'en';

    /**
     * @var array[string] Array with translated messages.
     */
    private $messages;

    /**
     * Returns instance of this class.
     *
     * @var $lang string Language code.
     * @var $messagesDirectory string Directory with translated JSON-files.
     */
    public function __construct(string $lang, string $messagesDirectory)
    {
        $this->lang = $lang;

        $messagesDirectory = $messagesDirectory.'/'.$lang;

        if (!is_dir($messagesDirectory)) {
            throw new Exception('Directory "'.$messagesDirectory.'" not exists', 1);
        }

        $filesInDirectory = array_diff(scandir($messagesDirectory), array('..', '.'));

        foreach ($filesInDirectory as $filename) {

            if (!$this->_isJSONFilename($filename)) {
                continue;
            }
            
            $fileWithMessages = $messagesDirectory.'/'.$filename;

            if (!file_exists($fileWithMessages)) {
                throw new Exception('Messages file "'.$fileWithMessages.'" not exists', 1);
            }
    
            $string = file_get_contents($fileWithMessages);
            $messages = json_decode($string, true);
    
            if ($messages == null) {
                die("Error in $filename");
            }
    
            $this->messages[rtrim($filename, '.'.self::TRANSLATED_FILE_EXTENSION)] = $messages;
        }

        return $this;
    }

    /**
     * Return language code.
     *
     * @var string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * Return translated message OR message key (if message not found).
     *
     * @var string $fullKey
     */
    public function get(...$keys): string
    {
        if (count($keys) == 2) {
            $key = $keys[0];
            $subkey = $keys[1];

            if (isset($this->messages[$key]) && isset($this->messages[$key][$subkey])) {
                return $this->messages[$key][$subkey];
            }

            return 'MSG_'.$key.'_'.$subkey;
        } else {
            $key = $keys[0];
            if (isset($this->messages[$this->lang][$key])) {
                return $this->messages[$this->lang][$key];
            }

            return 'MSG_'.$this->lang.'_'.$key;
        }

        return 'MSG_'.$keys[0];
    }

    /**
     * Check, is filename like a *.json
     */
    private function _isJSONFilename(string $filename): bool
    {
        return (bool) preg_match('/.'.self::TRANSLATED_FILE_EXTENSION.'$/', $filename);
    }
}
