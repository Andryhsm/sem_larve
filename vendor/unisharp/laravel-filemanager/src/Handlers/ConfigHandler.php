<?php

namespace UniSharp\LaravelFilemanager\Handlers;

class ConfigHandler
{
    public function userField()
    {
        return auth()->guard('admin')->user()->id;
    }

    public function baseDirectory(){
        //if(auth()->user()->user_type !== "S"){
        //    return 'public/'.auth()->guard('admin')->user()->id;
        // }
        // else{
             return 'public/';
        // }
    }
}
