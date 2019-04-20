<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserFollowHashtag_Relation_Validator
{
    #
    # Model validator
    #

    public static function validateExists(UserFollowHashtag_Relation_Model $relation)
    {
        self::validateID($relation->id);
        self::validateNew($relation);

        return true;
    }

    public static function validateNew(UserFollowHashtag_Relation_Model $relation)
    {
        self::validateUserID($relation->userID);
        self::validateHashtagID($relation->hashtagID);
        self::validateCreatedAt($relation->createdAt);

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
            throw new Exception('UserFollowHashtag relation "id" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateUserID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowHashtag relation "userID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateHashtagID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowHashtag relation "questionID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowHashtag relation "createdAt" property '.$exception->getMessages()[0], 0);
        }
    }
}
