<?php

namespace PageController;

abstract class PageController
{
    protected $lang;
    protected $l = null;

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

    public function __construct(\Slim\Container $container)
    {
        $this->container = $container;

        $cookieStorage = new \Helper\CookieStorage(); // @TODO Вынести бы
        $this->authUser = $cookieStorage->get_auth_user();

        $this->_init_common_modals();
        $this->_init_common_JS();
    }

    // handleRequest name set by Slim framework
    public function handleRequest($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->translator = new \Helper\Translator\Translator($this->lang, ROOT_PATH . '/app/Lang');
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
