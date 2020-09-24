<?php

namespace DTO\ViewData;

abstract class Basic
{
    //
    // Required properties
    //

    public $lang;
    public $page_title;
    public $page_description;
    public $canonical_URL;

    //
    // Properties with default values
    //

    public $auth_user = null;

    public $show_footer = true;

    public $include_CSS = [];
    public $include_modals = [];
    public $include_JS = [];
}
