<?php

namespace App\Models\Admin\AccessManagement;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';


    /**
     * Custom primary key is set for the table
     * 
     * @var integer
     */
    protected $primaryKey = 'id';

    /**
     * Maintain created_at and updated_at automatically
     * 
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_id',
        
    ];

   

    public static function storeData($data)
    {
        foreach($data as $val){
            self::create($val);
        }
    }

    public static function updateUserRole($roleArr, $id) {
        
       self::where('user_id', $id)->update($roleArr);
    }

    public static function GetPrivilegedData($id)
    {
        $Data = DB::table('users')
            ->select('mst_module.name as module_name')
            ->leftjoin('user_role', 'users.id', '=', 'user_role.user_id')
            ->leftjoin('role_permission', 'user_role.role_id', '=', 'role_permission.role_id')
            ->leftjoin('mst_permission', 'mst_permission.id', '=', 'role_permission.permission_id')
            ->leftjoin('mst_module', 'mst_module.id', '=', 'mst_permission.module_id')
            ->where('users.id', $id)
            ->get();

        return ($Data ?: []);
        //return self::where('user_id', $id)->get()->toArray();
    }

}