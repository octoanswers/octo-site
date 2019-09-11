<?php

trait Init_User_Model_Trait
{
    public static function init_with_DB_state(array $state): self
    {
        $user = new self();

        $user->id = (int) $state['u_id'];
        $user->username = isset($state['u_username']) ? $state['u_username'] : null;
        $user->name = $state['u_name'];
        $user->email = $state['u_email'];
        $user->signature = isset($state['u_signature']) ? $state['u_signature'] : null;
        $user->site = isset($state['u_site']) ? $state['u_site'] : null;
        $user->passwordHash = isset($state['u_password_hash']) ? $state['u_password_hash'] : null;
        $user->apiKey = isset($state['u_api_key']) ? $state['u_api_key'] : null;
        $user->is_avatar_uploaded = isset($state['is_avatar_uploaded']) ? (bool) $state['is_avatar_uploaded'] : false;
        $user->createdAt = $state['u_created_at'];

        return $user;
    }
}
