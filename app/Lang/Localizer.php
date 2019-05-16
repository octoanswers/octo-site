<?php

/**
 * Localisation for OctoAnswers.
 */
class Localizer
{
    const DEFAULT_LANG = 'en';

    /**
     * @var string Language code.
     */
    private $lang;

    /**
     * @var array[string] Array with translated messages.
     */
    private $messages;

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    protected static $instance;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance($lang)
    {
        // need move to const $LANGUAGES = ['en', 'ru']; in PHP7
        $LANGUAGES = ['en', 'ru'];

        // check and set lang
        if (!in_array($lang, $LANGUAGES)) {
            throw new Exception('Unsupported language code', 1);
        }

        if (!isset(static::$instance[$lang])) {
            $messages = self::__getTranslatedMessages($lang);

            $localizer = new static();
            $localizer->lang = $lang;
            $localizer->messages = $messages;

            static::$instance[$lang] = $localizer;
        }

        return static::$instance[$lang];
    }

    private static function __getTranslatedMessages($lang)
    {
        $fileWithMessages = __DIR__."/$lang.json";

        if (!file_exists($fileWithMessages)) {
            throw new Exception('Common messages file "'.$fileWithMessages.'" not exists', 1);
        }

        $string = file_get_contents($fileWithMessages);
        $messages = json_decode($string, true);

        if ($messages == null) {
            die("Error in $lang.json");
        }

        return $messages;
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
    public function t(...$key)
    {
        return self::_elementExists($key, $this->messages);
    }

    /**
     * Recursive iterator for finding translation
     */
    private static function _elementExists($key, $array)
    {
        $fullKey = $key;

        if (is_array($key)) {
            $curArray = $array;
            $lastKey = array_pop($key);
            foreach($key as $oneKey) {
                if (!self::_elementExists($oneKey, $curArray)) return false;
                $curArray = @$curArray[$oneKey];
            }
            if (is_array($curArray) && self::_elementExists($lastKey, $curArray)) {
                return self::_elementExists($lastKey, $curArray);
            } else {
                return 'MSG: '.implode(" - ", $fullKey);
            }
        } else {
            if (is_array($array)) {
                if (isset($array[$key]) || array_key_exists($key, $array)) {
                    return $array[$key];
                }
            }

            return 'MSG: '.$key;
        }
    }

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     */
    private function __wakeup()
    {
    }
}