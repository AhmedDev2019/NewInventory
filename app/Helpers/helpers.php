<?php

use App\Models\Admin;
use App\Models\User;

################ admin url function ######################
if( !function_exists('adminurl') ){
    function adminurl(){
        return auth()->guard('admin')->user();
    }
}

################ user url function ######################
if( !function_exists('userurl') ){
    function userurl(){
        return auth()->guard('web')->user();
    }
}