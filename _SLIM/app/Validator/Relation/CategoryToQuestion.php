<?php

namespace Validator\Relation;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class CategoryToQuestion
{
    //
    // Model validator
    //

    public static function validateExists(\Model\Relation\CategoriesToQuestions $rel)
    {
        self::validateID($rel->id);
        self::validateNew($rel);

        return true;
    }

    public static function validateNew(\Model\Relation\CategoriesToQuestions $rel)
    {
        self::validateCategoryID($rel->categoryID);
        self::validateQuestionID($rel->questionID);
        self::validateCreatedAt($rel->createdAt);

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
            throw new \Exception('CategoryToQuestion relation "id" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateCategoryID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new \Exception('CategoryToQuestion relation "categoryID" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateQuestionID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new \Exception('CategoryToQuestion relation "questionID" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new \Exception('CategoryToQuestion relation "createdAt" property ' . $exception->getMessages()[0], 0);
        }
    }
}
