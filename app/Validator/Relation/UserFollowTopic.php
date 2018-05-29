<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserFollowTopic_Relation_Validator
{
    #
    # Model validator
    #

    public static function validateExists(UserFollowTopic_Relation_Model $relation)
    {
        self::validateID($relation->getID());
        self::validateNew($relation);

        return true;
    }

    public static function validateNew(UserFollowTopic_Relation_Model $relation)
    {
        self::validateUserID($relation->getUserID());
        self::validateTopicID($relation->getTopicID());
        self::validateCreatedAt($relation->getCreatedAt());

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
            throw new Exception('UserFollowTopic relation "id" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateUserID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowTopic relation "userID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateTopicID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowTopic relation "questionID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowTopic relation "createdAt" property '.$exception->getMessages()[0], 0);
        }
    }
}
