<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class User_Validator
{
    const USERNAME_MIN_LENGHT = 3;
    const USERNAME_MAX_LENGHT = 64;

    const NAME_MIN_LENGHT = 2;
    const NAME_MAX_LENGHT = 255;

    const PASSWORD_MIN_LENGHT = 6;
    const PASSWORD_MAX_LENGHT = 32;
    const SIGNATURE_MIN_LENGHT = 3;
    const SIGNATURE_MAX_LENGHT = 255;

    //
    // Model validator
    //

    public static function validateExists(User_Model $user)
    {
        self::validateID($user->id);
        self::validateNew($user);

        return true;
    }

    public static function validateNew(User_Model $user)
    {
        self::validateUsername($user->username);
        self::validateName($user->name);
        self::validateEmail($user->email);
        self::validateSignature($user->signature);
        self::validateSite($user->site);
        self::validatePasswordHash($user->passwordHash);
        self::validateAPIKey($user->apiKey);
        self::validateCreatedAt($user->createdAt);

        return true;
    }

    public static function validateAuthUser(User_Model $user)
    {
        self::validateID($user->id);
        self::validateName($user->name);
        self::validateEmail($user->email);
        self::validateSignature($user->signature);
        self::validateSite($user->site);

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
            throw new Exception('User id param ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateUsername($username)
    {
        try {
            v::stringType()->length(self::USERNAME_MIN_LENGHT, self::USERNAME_MAX_LENGHT, null)->alnum()->noWhitespace()->assert($username);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "username" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateName($title)
    {
        try {
            v::stringType()->length(self::NAME_MIN_LENGHT, self::NAME_MAX_LENGHT, null)->assert($title);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "name" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateEmail($email)
    {
        try {
            v::stringType()->email()->assert($email);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "email" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateSignature($signature)
    {
        try {
            v::optional(v::stringType()->length(self::SIGNATURE_MIN_LENGHT, self::SIGNATURE_MAX_LENGHT, null))->assert($signature);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "signature" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateSite($site)
    {
        try {
            v::optional(v::url())->assert($site);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "site" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validatePassword($password)
    {
        try {
            v::stringType()->length(self::PASSWORD_MIN_LENGHT, self::PASSWORD_MAX_LENGHT, true)->assert($password);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "password" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validatePasswordHash($passwordHash)
    {
        try {
            v::stringType()->length(55, 65, true)->assert($passwordHash);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "passwordHash" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateAPIKey($APIKey)
    {
        try {
            v::stringType()->length(25, 45, true)->assert($APIKey);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "apiKey" property ' . $exception->getMessages()[0], 0);
        }
    }

    public static function validateCreatedAt($createdAt)
    {
        // @todo ->dateTime
        try {
            v::optional(v::stringType())->assert($createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('User "timestamp" property ' . $exception->getMessages()[0], 0);
        }
    }
}
