<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserFollowUser_Relation_Validator
{
    //
    // Model validator
    //

    public static function validate_exists(UserFollowUser_Relation_Model $relation)
    {
        self::validateID($relation->id);
        self::validate_new($relation);

        return true;
    }

    public static function validate_new(UserFollowUser_Relation_Model $relation)
    {
        self::validateUserID($relation->userID);
        self::validateFollowedUserID($relation->followedUserID);
        self::validateCreatedAt($relation->createdAt);

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
            throw new Exception('UserFollowUser relation "id" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateUserID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowUser relation "userID" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateFollowedUserID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowUser relation "questionID" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowUser relation "createdAt" property ' . $exception->getMessages()[0], 0);
        }
    }
}
