<?php

namespace App\Helpers;

use App;
use Auth;
use Request;
use App\User;
use App\Models\Admin\Order\Order;
use App\Models\Front\User\Investor;
use App\Models\Admin\Master\Country;
use App\Models\Admin\SiteSetting\SiteSetting;

class Helper
{


    public static function getAdminDetail()
    {
        $admin_data = SiteSetting::getAllSettings();
        $arrData = [];
        foreach ($admin_data as $settingdata) {
            $arrData[$settingdata->option_name] = $settingdata->option_value;
        }
        return $arrData;
    }
    
    public static function getTokenByID($id)
    {
        $assign_token = Order::getTokenByID($id);
        if(count($assign_token)>0){
            $total_assign_token = (($assign_token[0]['total_pay']));
        }else{
            $total_assign_token = 0;
        }
        
        return $total_assign_token;
    }
    
    public static function getAlCountries()
    {
        $country = Country::getAllCountries();
        return $country;
    }
    
    public static function getUserDetail()
    {
        $data = User::getUserWithPersonalDetails(Auth::id());
        return $data;
    }
    
    public static function getUserName($investor_id)
    {
        $data = Investor::getUserName($investor_id);
        return $data;
    }

    public static function getAllSettings()
    {
        $data = SiteSetting::getAllSettings();
        return $data;
    }


    
}