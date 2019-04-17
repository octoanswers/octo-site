<?php

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class Revision_Validator
{
    const REVISION_MIN_LENGHT = 3;
    const REVISION_MAX_LENGHT = 255;

    #
    # Model validator
    #

    public static function validate(Revision_Model $revision)
    {
        try {
            v::optional(v::intType()->min(1, true))->assert($revision->getID());
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision id param '.$exception->getMessages()[0], 0);
        }

        try {
            v::intType()->min(1, true)->assert($revision->getAnswerID());
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision answerID param '.$exception->getMessages()[0], 0);
        }

        try {
            v::stringType()->length(2, null)->assert($revision->getOpcodes());
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision opcodes param '.$exception->getMessages()[0], 0);
        }

        try {
            v::optional(v::stringType())->assert($revision->getBaseText());
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision answerText param '.$exception->getMessages()[0], 0);
        }

        self::validateComment($revision->getComment());

        try {
            v::optional(v::intType()->min(1, true))->assert($revision->getParentID());
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision parentID param '.$exception->getMessages()[0], 0);
        }

        try {
            v::intType()->min(1, true)->assert($revision->getUserID());
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision userID property '.$exception->getMessages()[0], 0);
        }

        // @todo ->dateTime
        try {
            v::optional(v::stringType())->assert($revision->createdAt);
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision createdAt param '.$exception->getMessages()[0], 0);
        }

        return true;
    }

    #
    # Property validators
    #

    public static function validateComment($comment)
    {
        try {
            v::optional(v::stringType()->length(self::REVISION_MIN_LENGHT, self::REVISION_MAX_LENGHT, true))->assert($comment);
        } catch (NestedValidationException $exception) {
            throw new Exception('Revision comment param '.$exception->getMessages()[0], 0);
        }
        // @todo WTF?
        if ($comment === '') {
            throw new Exception('Revision comment param "" must have a length between 3 and 255', 0);
        }
    }
}
