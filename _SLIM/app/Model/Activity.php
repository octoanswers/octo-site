<?php

namespace Model;

class Activity extends Model
{
    // Activity types

    const F_U_FOLLOW_Q        = 'F_U_FOLLOW_Q';

    const F_U_FOLLOW_U        = 'F_U_FOLLOW_U';

    const F_U_REPOST_Q        = 'F_U_REPOST_Q';  // @TODO don`t used

    const F_U_REQUEST_A       = 'F_U_REQUEST_A';  // @TODO don`t used

    const F_U_ASKED_Q         = 'F_U_ASKED_Q';

    const U_RENAME_Q          = 'U_RENAME_Q';

    const F_U_UPDATE_A        = 'F_U_UPDATE_A';

    const U_UPDATE_SIGNATURE  = 'U_UPDATE_SIGNATURE';

    const F_U_GOT_ACHIEVEMENT = 'F_U_GOT_ACHIEVEMENT'; // @TODO don`t used

    const Q_RENAMED_BY_U      = 'Q_RENAMED_BY_U';

    const F_Q_UPDATE_A        = 'F_Q_UPDATE_A';

    // Question Activity Const

    // Answer Activity Const

    // Category Activity Const

    const CATEGORY_RENAMED_BY_USER = 'CATEGORY_RENAMED_BY_USER';

    const CATEGORY_ADDED_QUESTION  = 'CATEGORY_ADDED_QUESTION';

    // User Activity Const

    const USER_RENAME_CATEGORY = 'USER_RENAME_CATEGORY';

    const USER_FOLLOW_CATEGORY = 'USER_FOLLOW_CATEGORY';

    // Achievment Activity Const

    // Activity properties

    public $id; // int

    public $type; // string

    public $subject; // string

    public $data; // string
}
