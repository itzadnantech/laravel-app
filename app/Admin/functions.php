<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;


///UserFullName
if (!function_exists('GetUserFullName')) {
    function GetUserFullName($user_id)
    {
        $rec = GetByWhereRecord('tbl_name', array('user_id' => $user_id));
        $full_name = $rec[0]->first_name . ' ' . $rec[0]->last_name;
        return $full_name;
    }
}
