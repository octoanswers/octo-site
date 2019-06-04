<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserFollowCategory_Relation_Validator
{
    #
    # Model validator
    #

    public static function validateExists(UserFollowCategory_Relation_Model $relation)
    {
        self::validateID($relation->id);
        self::validateNew($relation);

        return true;
    }

    public static function validateNew(UserFollowCategory_Relation_Model $relation)
    {
        self::validateUserID($relation->userID);
        self::validateCategoryID($relation->categoryID);
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
            throw new Exception('UserFollowCategory relation "id" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateUserID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowCategory relation "userID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateCategoryID($id)
    {
        try {
            v::intType()->min(1, true)->assert($id);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowCategory relation "questionID" property '.$exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('UserFollowCategory relation "createdAt" property '.$exception->getMessages()[0], 0);
        }
    }
}
