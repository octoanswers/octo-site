<?php

namespace Model;

class User extends Model
{
    use \Traits\Model\User\Init;
    use \Traits\Model\User\Avatar;
    use \Traits\Model\User\Signature;

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
