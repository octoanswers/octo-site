<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class HashtagToQuestion_Relation_Validator
{
    #
    # Model validator
    #

    public static function validateExists(TopicsToQuestions_Relation_Model $rel)
    {
        self::validateID($rel->getID());
        self::validateNew($rel);

        return true;
    }

    public static function validateNew(TopicsToQuestions_Relation_Model $rel)
    {
        self::validateTopicID($rel->getTopicID());
        self::validateQuestionID($rel->getQuestionID());
        self::validateCreatedAt($rel->getCreatedAt());

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
            throw new Exception('TopicToQuestion relation "id" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateTopicID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('TopicToQuestion relation "topicID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateQuestionID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('TopicToQuestion relation "questionID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('TopicToQuestion relation "createdAt" property '.$exception->getMessages()[0], 0);
        }
    }
}
