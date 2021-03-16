<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function isAdmin()
    {
        if ($this->user_type == "A") {
            return true;
        } else {
            return false;
        }
    }


    public function isOther()
    {
        if ($this->user_type == "O") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * getUserByemail
     * @param $email
     * @return array $arrUser
     * @since 0.1
     * @author Minee Soni
     */
    public static function getUserByemail($email)
    {
        $arrUser = SELF::select('*')
            ->where('email', '=', $email)
            ->first();
        return ($arrUser ? $arrUser : []);
    }

    /**
     * getUserDetailsByID
     * @param $userID
     * @param type $userID
     * @author Minee Soni
     */
    public static function getUserDetailsByID($userID)
    {
        $arrUser = self::select('users.*')
            ->where('users.id', '=', $userID)
            ->first();
        return ($arrUser ? $arrUser : []);
    }

    public static function getUserWithPersonalDetails($userID)
    {
       $arrUser = self::select('users.*')
            ->where('users.id', '=', $userID)
            ->first();
        return ($arrUser ? $arrUser : []);

    }

     /**
     * UpdateProfileData
     * @param
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function updateProfile($input,$id)
    {
        try {
           $data = self::where('id', (int) $id)->update($input);
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }
        return $data;
    }
}
