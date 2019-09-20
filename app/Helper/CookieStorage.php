<?php

namespace Helper;

class CookieStorage
{
    protected static $authUser = null;

    public function get_auth_user()
    {
        if (static::$authUser) {
            return static::$authUser;
        }

        if (isset($_COOKIE['u_id'])) {
            try {
                static::$authUser = \Model\User::init_with_DB_state([
                    'u_id'                  => $_COOKIE['u_id'],
                    'u_username'            => $_COOKIE['u_username'],
                    'u_name'                => $_COOKIE['u_name'],
                    'u_email'               => $_COOKIE['u_email'],
                    'u_signature'           => isset($_COOKIE['u_signature']) ? $_COOKIE['u_signature'] : null,
                    'u_site'                => isset($_COOKIE['u_site']) ? $_COOKIE['u_site'] : null,
                    'u_api_key'             => $_COOKIE['u_api_key'],
                    'is_avatar_uploaded'    => isset($_COOKIE['is_avatar_uploaded']) ? $_COOKIE['is_avatar_uploaded'] : null,
                    'u_created_at'          => $_COOKIE['u_created_at'],
                ]);
                if (!\Validator\User::validateAuthUser(static::$authUser)) {
                    $this->clear();

                    return;
                }

                return static::$authUser;
            } catch (\Throwable $e) {
                $this->clear();

                return;
            }
        }
    }

    public function save_user(\Model\User $user)
    {
        $expire_time = $this->_get_expire_time();

        @setcookie('u_id', $user->id, $expire_time, '/');
        @setcookie('u_username', $user->username, $expire_time, '/');
        @setcookie('u_email', $user->email, $expire_time, '/');
        @setcookie('u_name', $user->name, $expire_time, '/');
        if ($user->signature) {
            @setcookie('u_signature', $user->signature, $expire_time, '/');
        }
        if ($user->site) {
            @setcookie('u_site', $user->site, $expire_time, '/');
        }
        @setcookie('is_avatar_uploaded', $user->is_avatar_uploaded, $expire_time, '/');
        @setcookie('u_created_at', $user->createdAt, $expire_time, '/');
        if ($user->apiKey) {
            @setcookie('u_api_key', $user->apiKey, $expire_time, '/');
        }
        static::$authUser = $user;
    }

    public function set_lang(string $lang)
    {
        @setcookie('lang', $lang, $this->_get_expire_time(), '/');
    }

    public function clear()
    {
        $time_in_past = $this->_get_time_in_past();

        @setcookie('u_id', '', $time_in_past, '/');
        @setcookie('u_username', '', $time_in_past, '/');
        @setcookie('u_email', '', $time_in_past, '/');
        @setcookie('u_name', '', $time_in_past, '/');
        @setcookie('u_signature', '', $time_in_past, '/');
        @setcookie('u_site', '', $time_in_past, '/');
        @setcookie('u_created_at', '', $time_in_past, '/');
        @setcookie('is_avatar_uploaded', '', $time_in_past, '/');
        @setcookie('api_key', '', $time_in_past, '/');

        unset($_COOKIE['u_id']);
        unset($_COOKIE['u_username']);
        unset($_COOKIE['u_email']);
        unset($_COOKIE['u_name']);
        unset($_COOKIE['u_signature']);
        unset($_COOKIE['u_site']);
        unset($_COOKIE['u_created_at']);
        unset($_COOKIE['is_avatar_uploaded']);
        unset($_COOKIE['u_api_key']);

        static::$authUser = null;
    }

    private function _get_expire_time(): int
    {
        return time() + (86400 * 30); // 86400 = 1 day
    }

    private function _get_time_in_past(): int
    {
        return time() - 60;
    }
}
