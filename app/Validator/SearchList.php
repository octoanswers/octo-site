<?php

namespace Validator;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class SearchList
{
    const PAGE_MIN = 1;
    const PAGE_MAX = 9999;
    const PER_PAGE_MIN = 5;
    const PER_PAGE_MAX = 100;

    //
    // Property validators
    //

    public static function validatePage($page)
    {
        try {
            v::optional(v::intType()->between(self::PAGE_MIN, self::PAGE_MAX, true))->assert($page);
        } catch (NestedValidationException $exception) {
            throw new Exception('List "page" param ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validatePerPage($perPage)
    {
        try {
            v::optional(v::intType()->between(self::PER_PAGE_MIN, self::PER_PAGE_MAX, true))->assert($perPage);
        } catch (NestedValidationException $exception) {
            throw new Exception('List "perPage" param ' . $exception->getMessages()[0], 0);
        }
    }
}
