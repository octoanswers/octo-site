<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Question_Validator
{
    const TITLE_MIN_LENGHT = 3;
    const TITLE_MAX_LENGHT = 255;
    const IMAGE_BASENAME_MIN_LENGHT = 4;
    const IMAGE_BASENAME_MAX_LENGHT = 64;

    //
    // Model validator
    //

    public static function validateExists(Question_Model $question)
    {
        self::validateID($question->id);
        self::validateNew($question);

        return true;
    }

    public static function validateNew(Question_Model $question)
    {
        self::validateTitle($question->title);
        self::validateRedirect($question->isRedirect);
        self::validateImageBaseName($question->imageBaseName);

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
            throw new Exception('Question id param ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateTitle($title)
    {
        try {
            v::stringType()->length(self::TITLE_MIN_LENGHT, self::TITLE_MAX_LENGHT, null)->assert($title);

            // question ending must be '?'
            $lastCharacter = substr($title, -1);
            if ($lastCharacter != '?') {
                throw new NestedValidationException('must end with a question mark', 0);
            }

            // The question can not begin with a plus sign
            $firstSign = substr($title, 0, 1);
            if ($firstSign == '+') {
                throw new NestedValidationException('can not begin with a plus sign', 0);
            }
        } catch (NestedValidationException $exception) {
            throw new Exception('Question title param ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateRedirect($isRedirect)
    {
        try {
            v::optional(v::boolVal())->assert($isRedirect);

            if (isset($isRedirect) && !is_bool($isRedirect)) {
                throw new NestedValidationException('not boolean', 0);
            }
        } catch (NestedValidationException $exception) {
            throw new Exception('Question isRedirect param ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateImageBaseName($imageBaseName)
    {
        try {
            v::optional(v::stringType()->length(self::IMAGE_BASENAME_MIN_LENGHT, self::IMAGE_BASENAME_MAX_LENGHT, null))->assert($imageBaseName);

            if ($imageBaseName === '') {
                throw new NestedValidationException('"" must have a length between ' . self::IMAGE_BASENAME_MIN_LENGHT . ' and ' . self::IMAGE_BASENAME_MAX_LENGHT, 0);
            }
        } catch (NestedValidationException $exception) {
            throw new Exception('Question "imageBaseName" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateCategoriesCount($categoriesCount)
    {
        try {
            v::intType()->min(0, true)->assert($categoriesCount);
        } catch (NestedValidationException $exception) {
            throw new Exception('Question property "categoriesCount" ' . $exception->getMessages()[0], 0);
        }
    }
}
