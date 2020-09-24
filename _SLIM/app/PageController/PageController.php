<?php

namespace PageController;

abstract class PageController
{
    protected $lang;

    // Page properties
    protected $template = null;
    protected $showFooter = true;
    protected $pageTitle;
    protected $pageDescription;
    protected $canonicalURL;

    protected $v = [];
    protected $authUser = null;

    protected $includeCSS = [];
    protected $includeModals = [];
    protected $includeJS = [];

    public $container;

    public function __construct()
    //public function __construct(\Slim\Container $container)
    //public function __construct(string $lang)
    {
        //$this->lang = $lang;
        //  $this->container = $container;

        $this->lang = \Helper\Lang::getLangCodeFromURI();
        $this->__reinitTranslator($this->lang);

        $cookieStorage = new \Helper\CookieStorage(); // @TODO Вынести бы
        $this->authUser = $cookieStorage->getAuthUser();

        $this->_init_common_modals();
        $this->_init_common_JS();
    }

    protected function __reinitTranslator(string $lang)
    {
        $GLOBALS['lang_code'] = $lang;

        // Prepare the FileLoader
        $file_system = new \Illuminate\Filesystem\Filesystem();
        $loader = new \Illuminate\Translation\FileLoader($file_system, ROOT_PATH . '/lang');

        // Register the Translator
        $GLOBALS['illuminate_translation'] = new \Illuminate\Translation\Translator($loader, lang());
    }

    protected function render_page()
    {
        if (!$this->template) {
            throw new \Exception('Page template not set!', 1);
        }

        $fullPage = TEMPLATE_PATH . '/' . $this->template . '/_page.phtml';

        ob_start();
        if (file_exists($fullPage)) {
            include $fullPage;
        } else {
            include TEMPLATE_PATH . '/wrapper.phtml';
        }
        $output = ob_get_clean();

        return $output;
    }

    //
    // Private Methods
    //

    private function _init_common_modals()
    {
        $this->includeModals[] = '_common/ask';

        if (!$this->authUser) {
            $this->includeModals[] = '_common/login';
            $this->includeModals[] = '_common/signup';
        }
    }

    private function _init_common_JS()
    {
        $this->includeJS[] = 'question/create';

        if (!$this->authUser) {
            $this->includeJS[] = 'user/login';
            $this->includeJS[] = 'user/signup';
        }
    }
}
