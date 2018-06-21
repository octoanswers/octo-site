<?php

abstract class Abstract_PageController
{
    protected $lang;
    protected $l = null;

    protected $template = null;
    protected $showFooter = true;

    protected $pageTitle;
    protected $pageDescription;
    protected $canonicalURL;

    protected $v = [];
    protected $authUser = null;
    protected $additionalJavascript = [];

    public $container;

    public function __construct(Slim\Container $container)
    {
        $this->container = $container;

        //$this->authUser = $this->container->get('auth_user');

        $cookieStorage = new CookieStorage(); // @TODO Вынести бы
        $this->authUser = $cookieStorage->getAuthUser();

        // JS for all pages
        $this->additionalJavascript[] = 'question/create';

        if (!$this->authUser) {
            $this->additionalJavascript[] = 'user/login';
            $this->additionalJavascript[] = 'user/signup';
        }
    }

    protected function renderPage()
    {
        if (!$this->template) {
            exit('Page template not set!');
        }

        $fullPage = TEMPLATE_PATH.'/'.$this->template.'_full.phtml';

        ob_start();
        if (file_exists($fullPage)) {
            include $fullPage;
        } else {
            include TEMPLATE_PATH.'/wrapper.phtml';
        }
        $output = ob_get_clean();

        return $output;
    }
}
