<?php

namespace Query;

abstract class Query
{
    protected $lang;
    protected $pdo;

    public function __construct(string $lang)
    {
        $this->lang = $lang;
        $this->pdo = \Helper\PDOFactory::getConnectionToLangDB($lang);
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
