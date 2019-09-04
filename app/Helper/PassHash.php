<?php

/**
 * The best way to secure the user passwords is not store them as plain text, instead all the passwords should be  encrypted before storing in db. The following class takes care of encrypting the user password.
 */
class PassHash
{
    /**
     * Blowfish.
     *
     * @var string
     */
    private static $algo = '$2a';

    /**
     * Cost parameter.
     *
     * @var string
     */
    private static $cost = '$10';

    /**
     * Generate unique salt.
     *
     * @return string
     */
    public function unique_salt()
    {
        return substr(sha1(mt_rand()), 0, 22);
    }

    /**
     * Generate a hash-string.
     *
     * @return string
     */
    public function hash($password)
    {
        return crypt($password, self::$algo .
            self::$cost .
            '$' . $this->unique_salt());
    }

    /**
     * Compare a password against a hash.
     *
     * @return bool
     */
    public function check_password($hash, $password)
    {
        $full_salt = substr($hash, 0, 29);
        $new_hash = crypt($password, $full_salt);

        return $hash == $new_hash;
    }

    /**
     * Generating random Unique MD5 String for user Api key.
     *
     * @return string
     */
    public function generate_API_key()
    {
        return md5(uniqid(rand(), true));
    }
}
