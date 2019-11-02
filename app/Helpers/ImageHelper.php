<?php
if (!function_exists('srcImageUse')) {
    function srcImageUse($user)
    {
        dd($user);
        if ($user->image_id) {
            return asset($user->file->base_folder . '/' . $user->file->name);
        } else {
            return asset(config('constant.icon.link_country_placeholder'));
        }
    }
}
