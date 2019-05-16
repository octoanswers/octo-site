<?php

/**
 * Simple translator for Answeropedia.
 */
class Translator
{
    const TRANSLATED_FILE_EXTENSION = 'json';

    /**
     * @var array[string] Array with translated messages.
     */
    public $messages;

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
 
            $string = file_get_contents($fileWithMessages);
            $messages = json_decode($string, true);
    
            if ($messages == null) {
                die("Error in $filename");
            }
            
            $filename = preg_replace("/\.json/iu", "", $filename);
            $this->messages[$this->lang][$filename] = $messages;
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
     * @var string $file
     * @var string $key
     */
    public function get(string $file, string $key): string
    {
        if (isset($this->messages[$this->lang][$file]) && isset($this->messages[$this->lang][$file][$key])) {
            return $this->messages[$this->lang][$file][$key];
        }

        return 'MSG__'.$this->lang.'__'.$file.'__'.$key;
    }

    /**
     * Check, is filename like a *.json
     */
    private function _isJSONFilename(string $filename): bool
    {
        return (bool) preg_match('/.'.self::TRANSLATED_FILE_EXTENSION.'$/', $filename);
    }
}
