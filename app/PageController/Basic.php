<?php

namespace PageController;

abstract class Basic
{
    public function __construct(string $lang)
    {
        $this->lang = $lang;

        $GLOBALS['lang_code'] = $lang;

        // Prepare the FileLoader
        $file_system = new \Illuminate\Filesystem\Filesystem();
        $loader = new \Illuminate\Translation\FileLoader($file_system, ROOT_PATH . '/lang');

        // Register the Translator
        $GLOBALS['illuminate_translation'] = new \Illuminate\Translation\Translator($loader, lang());

        $cookieStorage = new \Helper\CookieStorage(); // @TODO Вынести бы
        $this->authUser = $cookieStorage->get_auth_user();
    }
}
