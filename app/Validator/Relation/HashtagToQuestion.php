<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class HashtagToQuestion_Relation_Validator
{
    #
    # Model validator
    #

    public static function validateExists(HashtagsToQuestions_Relation_Model $rel)
    {
        self::validateID($rel->id);
        self::validateNew($rel);

        return true;
    }

    public static function validateNew(HashtagsToQuestions_Relation_Model $rel)
    {
        self::validateHashtagID($rel->hashtagID);
        self::validateQuestionID($rel->questionID);
        self::validateCreatedAt($rel->createdAt);

        return true;
    }

    #
    # Property validators
    #

    public static function validateID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('HashtagToQuestion relation "id" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateHashtagID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('HashtagToQuestion relation "hashtagID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateQuestionID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('HashtagToQuestion relation "questionID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('HashtagToQuestion relation "createdAt" property '.$exception->getMessages()[0], 0);
        }
    }
}
