<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('canSeeMenu')) {
    function canSeeMenu($menu)
    {
        $user = Auth::user();
        if (!$user) return false;
        // super admin เห็นทุกเมนู
        if ($user->hasRole('super admin')) return true;
        // developer (option) เห็นทุกเมนู
        // if ($user->hasRole('developer')) return true;
        return is_array($user->menus) && in_array($menu, $user->menus);
    }
}
