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
     * @var string Language code.
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
     * @var string $subkey
     */
    public function get(...$keys): string
    {
        if (count($keys) > 3) {
            return 'TOO_MACH_KEYS ('.$this->lang.') '.implode(' - ', $keys);
        }

        switch (count($keys)) {
            case 3:
                // Keys like a 'key - key -key'
                $message = @$this->messages[$keys[0]][$keys[1]][$keys[2]];

                if ($message) {
                    if (is_array($message)) {
                        return 'KEY_IS_ARRAY ('.$this->lang.') '.implode(' - ', $keys);
                    }

                    return $message;
                }

                return 'NEED TRANSLATE ('.$this->lang.') '.implode(' - ', $keys);

            case 2:
                // Keys like a 'key - key'
                $message = @$this->messages[$keys[0]][$keys[1]];

                if ($message) {
                    if (is_array($message)) {
                        return 'KEY_IS_ARRAY ('.$this->lang.') '.implode(' - ', $keys);
                    }

                    return $message;
                }

                return 'NEED TRANSLATE ('.$this->lang.') '.implode(' - ', $keys);

            default:
                // Keys like a 'key'
                $message = @$this->messages[$keys[0]];

                if (isset($message)) {
                    if (is_array($message)) {
                        return 'KEY_IS_ARRAY ('.$this->lang.') '.$keys[0];
                    }

                    return $message;
                }
        }

        return $keys[0];
    }
}
