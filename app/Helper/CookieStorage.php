<?php

class CookieStorage
{
    protected static $authUser = null;

    public function getAuthUser()
    {
        if (static::$authUser) {
            return static::$authUser;
        }

        if (isset($_COOKIE['u_id'])) {
            try {
                static::$authUser = User_Model::initWithDBState([
                    'u_id' => $_COOKIE['u_id'],
                    'u_username' => $_COOKIE['u_username'],
                    'u_name' => $_COOKIE['u_name'],
                    'u_email' => $_COOKIE['u_email'],
                    'u_signature' => isset($_COOKIE['u_signature']) ? $_COOKIE['u_signature'] : null,
                    'u_site' => isset($_COOKIE['u_site']) ? $_COOKIE['u_site'] : null,
                    'u_api_key' => $_COOKIE['u_api_key'],
                    'u_created_at' => $_COOKIE['u_created_at'],
                ]);
                if (!User_Validator::validateAuthUser(static::$authUser)) {
                    $this->clear();
                    return null;
                }
                return static::$authUser;
            } catch (Throwable $e) {
                $this->clear();
                return;
            }
        }

        return;
    }

    public function saveUser(User_Model $user)
    {
        $expireTime = $this->_getExpireTime();

        @setcookie('u_id', $user->id, $expireTime, '/');
        @setcookie('u_username', $user->username, $expireTime, '/');
        @setcookie('u_email', $user->email, $expireTime, '/');
        @setcookie('u_name', $user->name, $expireTime, '/');
        if ($user->signature) {
            @setcookie('u_signature', $user->signature, $expireTime, '/');
        }
        if ($user->site) {
            @setcookie('u_site', $user->site, $expireTime, '/');
        }
        @setcookie('u_created_at', $user->createdAt, $expireTime, '/');
        if ($user->apiKey) {
            @setcookie('u_api_key', $user->apiKey, $expireTime, '/');
        }
        static::$authUser = $user;
    }

    public function setLang(string $lang)
    {
        @setcookie('lang', $lang, $this->_getExpireTime(), '/');
    }

    public function clear()
    {
        $pastTime = $this->_getPastTime();

        @setcookie('u_id', '', $expireTime, '/');
        @setcookie('u_username', '', $expireTime, '/');
        @setcookie('u_email', '', $expireTime, '/');
        @setcookie('u_name', '', $expireTime, '/');
        @setcookie('u_signature', '', $expireTime, '/');
        @setcookie('u_site', '', $expireTime, '/');
        @setcookie('u_created_at', '', $expireTime, '/');
        @setcookie('api_key', '', $expireTime, '/');

        unset($_COOKIE['u_id']);
        unset($_COOKIE['u_username']);
        unset($_COOKIE['u_email']);
        unset($_COOKIE['u_name']);
        unset($_COOKIE['u_signature']);
        unset($_COOKIE['u_site']);
        unset($_COOKIE['u_created_at']);
        unset($_COOKIE['u_api_key']);

        static::$authUser = null;
    }

    private function _getExpireTime(): int
    {
        return time() + (86400 * 30); // 86400 = 1 day
    }

    private function _getPastTime(): int
    {
        return time() - 60;
    }
}
