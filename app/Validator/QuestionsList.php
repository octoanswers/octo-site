<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class QuestionsList_Validator
{
    const PAGE_MIN = 1;
    const PAGE_MAX = 9999;
    const PER_PAGE_MIN = 5;
    const PER_PAGE_MAX = 100;

    #
    # Property validators
    #

    public static function validatePage($page)
    {
        try {
            v::optional(v::intType()->between(self::PAGE_MIN, self::PAGE_MAX, true))->assert($page);
        } catch (NestedValidationException $exception) {
            throw new Exception('Questions list page param '.$exception->getMessages()[0], 0);
        }
    }

    public static function validatePerPage($perPage)
    {
        try {
            v::optional(v::intType()->between(self::PER_PAGE_MIN, self::PER_PAGE_MAX, true))->assert($perPage);
        } catch (NestedValidationException $exception) {
            throw new Exception('Questions list perPage param '.$exception->getMessages()[0], 0);
        }
    }
}
