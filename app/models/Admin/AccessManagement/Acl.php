<?php

namespace App\Models\Admin\AccessManagement;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Acl extends Authenticatable {

    protected $table = 'tbl_roles';

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
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    /**
     * getAllRole
     * @param 
     * @return
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function getAllRole() {
        $arrRole = DB::table('tbl_roles')
                ->select('tbl_roles.*')
                ->orderBy('name', 'asc')
                ->get();
        return ($arrRole ? $arrRole : []);
    }

    /**
     * saveRole
     * @param array $arrRole
     * @return array arrCategory
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function saveRole($arrRole) {
        $check = SELF::checkRole($arrRole);
        if ($check == 0) {
            self::create($arrRole);
            return (true ? : false);
        }
        return 0;
    }

    /**
     * checkRole
     * @param array $arrRole
     * @return array arrCategory
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function checkRole($arrRole, $id = '') {
        if ($id) {
            $varCount = SELF::select('*')
                    ->WHERE('name', '=', $arrRole['name'])
                    ->WHERE('id', '!=', $id)
                    ->count();
        } else {
            $varCount = SELF::select('*')
                    ->WHERE('name', '=', $arrRole['name'])
                    ->count();
        }
        return ($varCount ? $varCount : 0);
    }

    /**
     * updateRole
     * @param var $role_id
     * @param array $arrRoleData
     * @param array
     * @return boolean
     * @since version 0.1
     * @author Meghendra S Yadav
     */
    public function updateRole($role_id, $arrRoleData) {
        $check = SELF::checkRole($arrRoleData, $role_id);
        if ($check == 0) {
            $rowUpdate = self::find((int) $role_id)->update($arrRoleData);
            return ($rowUpdate ? $rowUpdate : false );
        }
        return 0;
    }

    /**
     * updateRole
     * @param var $role_id
     * @param array $arrRoleData
     * @param array
     * @return boolean
     * @since version 0.1
     * @author Meghendra S Yadav
     */
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * updateRole
     * @param var $role_id
     * @param array $arrRoleData
     * @param array
     * @return boolean
     * @since version 0.1
     * @author Meghendra S Yadav
     */
    public function givePermissionTo(Permission $permission) {
        return $this->permissions()->save($permission);
    }

    /**
     * deleteRole
     * @param $id
     * @return
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function deleteRole($id) {

        /* check assigned role */
        $varCheck = DB::table('tbl_role_user')
                ->where('role_id', $id)
                ->count();
        if ($varCheck == 0) {
            $varDelete = self::where('id', '=', $id)->delete();
            return ($varDelete ? $varDelete : false);
        } else {
            return false;
        }
    }

    /**
     * getRoleByID
     * @param $id
     * @return
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function getRoleByID($id) {
        $arrData = SELF::select('*')
                ->where('id', '=', $id)
                ->first();
        return ($arrData ? $arrData : []);
    }

    /**
     * Get Role By User ID
     * @param int $varId
     * @return array
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function getAllRoleByUserID($varId) {
        $arrRole = DB::table('tbl_role_user')
                ->select('tbl_role_user.*')
                ->WHERE('user_id', '=', $varId)
                ->get();
        return ($arrRole ? : 0);
    }

    /**
     * Delete User Role
     * @param var $varUID
     * @return integer $varProduct->id
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function deleteUserRole($varUID) {
        $varID = DB::table('tbl_role_user')->where('user_id', '=', $varUID)->delete();
        return ($varID ? : false);
    }

    /**
     * Save Role Permission
     * @param var $role_id
     * @param array $arrPermissionData
     * @param array
     * @return boolean
     * @since version 0.1
     * @author Ashish Vishwakarma
     */
    public static function saveUserRole($arrUserRole) {
        DB::table('tbl_role_user')->insert($arrUserRole);
        return (true ? : false);
    }

}
