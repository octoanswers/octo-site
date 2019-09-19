<?php

namespace Validator;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Subscription
{
    //
    // Model validator
    //

    public static function validate_exists(\Model\Subscription $s)
    {
        self::validateID($s->id);
        self::validate_new($s);

        return true;
    }

    public static function validate_new(\Model\Subscription $s)
    {
        self::validateQuestionID($s->questionID);
        self::validateEmail($s->email);
        self::validateCreatedAt($s->createdAt);

        return true;
    }

    //
    // Property validators
    //

    public static function validateID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new \Exception('Subscription "id" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateQuestionID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new \Exception('Subscription "questionID" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateEmail($email)
    {
        try {
            v::stringType()->email()->assert($email);
        } catch (NestedValidationException $exception) {
            throw new \Exception('Subscription "email" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new \Exception('Subscription "createdAt" property ' . $exception->getMessages()[0], 0);
        }
    }
}
