<?php

namespace UniSharp\LaravelFilemanager\Handlers;

class ConfigHandler
{
    public function userField()
    {
    	$user = auth()->guard('admin')->user();
    	$folder_name = $user->admin_id.' '.$user->first_name.' '.$user->last_name;
        return $folder_name;
    }
}
