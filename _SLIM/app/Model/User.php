<?php

namespace Model;

class User extends Model
{
    use \Model\Traits\User\Init;
    use \Model\Traits\User\Avatar;
    use \Model\Traits\User\Signature;

    public $id; // int

    public $username; // string

    public $name; // string

    public $email; // string

    public $signature; // string

    public $site; // string

    public $passwordHash; // string

    public $apiKey; // string

    public $is_avatar_uploaded = false; // bool

    public $createdAt;

    /**
     * Property used only on related to answer context.
     */
    public $contributionToAnswer = null; // \Model\ContributionToAnswer
}
