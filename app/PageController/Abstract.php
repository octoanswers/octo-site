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
    protected $includeJS = [];

    public $container;

    public function __construct(Slim\Container $container)
    {
        $this->container = $container;

        //$this->authUser = $this->container->get('auth_user');

        $cookieStorage = new CookieStorage(); // @TODO Вынести бы
        $this->authUser = $cookieStorage->getAuthUser();

        $this->includeCSS = [];
        $this->includeModals = [];
        
        // JS for all pages
        $this->includeJS[] = 'navbar_search_form';
        $this->includeJS[] = 'question/create';

        if (!$this->authUser) {
            $this->includeJS[] = 'user/login';
            $this->includeJS[] = 'user/signup';
        }
    }

    public function handleRequest($request, $response, $args)
    {
        $this->lang = $args['lang'];
        $this->translator = new Translator($this->lang, ROOT_PATH."/resources/lang");
    }

    protected function renderPage()
    {
        if (!$this->template) {
            throw new Exception("Page template not set!", 1);
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

    //if (! function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param string $key
     */
    public function foo(...$keys): string
    {
        return $this->translator->get($keys);
    }
//}
}
