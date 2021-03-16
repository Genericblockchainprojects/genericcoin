<?php

namespace App\Models\Admin\AccessManagement;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Role extends Authenticatable {

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
        'parent_id',
        'user_type',
        'name',
        'display_name',
        'description',
        'is_active'
    ];

    /**
     * getAllRole
     * @param 
     * @return
     * @since 0.1
     * @author Meghendra S Yadav
     */
//    public static function getAllRole() {
//        $arrRole = DB::table('tbl_roles')
//                ->select('tbl_roles.*')
//                ->orderBy('name', 'asc')
//                ->get();
//        return ($arrRole ? $arrRole : []);
//    }

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
        $varCheck = DB::table('role_user')
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
        $arrRole = DB::table('role_user')
                ->select('role_user.*')
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

    /**
     * Scope to get default role on registration
     * 
     * @param  Eloquent $query
     * @return Eloquent
     */
    public function scopeRoleAfterRegistration($query) {
        return $query->where('is_reg_role', config('b2c_common.YES'));
    }

    /**
     * Scope to get whether a role is allowed to login in the admin or not
     * 
     * @param Eloquent $query
     * @return Eloquent
     */
    public function scopeAdminLoginAllowed($query) {
        return $query->where('is_admin_login_allowed', config('b2c_common.YES'));
    }

    /**
     * Get All Roles
     * 
     * @param void()
     * 
     * @return object roles
     * 
     * @since 0.1
     */
    public static function getAllRoles($parent_role_id) {
        $arrRoles = self::where(['parent_id' => $parent_role_id])->get();

        return ($arrRoles ? : false);
    }

    /**
     * Get All Roles List
     * 
     * @param void()
     * 
     * @return object roles
     * 
     * @since 0.1
     */
    public static function getRoleLists($parent_id = 0) {
        $arrRoles = self::where(['parent_id' => $parent_id])->pluck('name', 'id');

        return ($arrRoles ? : false);
    }

    public static function pluckParentRoles() {
        $arrRoles = self::where(['parent_id' => '0'])->pluck('name', 'id');

        return ($arrRoles ? : false);
    }

    /**
     * Save role data
     * 
     * @param array $roleData
     * 
     * @return object role
     */
    public static function addRole($roleData, $role_id) {

        $roleObj = self::updateOrCreate($role_id, $roleData);

        return ($roleObj ? : false);
    }

    /**
     * Check role assign to any user
     * 
     * @param integer $role_id
     * 
     * @return integer
     */
    public static function checkRoleAssigntoUser($role_id) {

        $countRow = self::where('roles.id', $role_id)->join('role_user', 'roles.id', '=', 'role_user.role_id')->count();

        return ( $countRow ? : 0 );
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     * @return mixed
     */
    public function assignRolePermission($permission) {

        return $this->permissions()->sync($permission);
    }

    public static function getRolesByUserType($user_type) {
        $data = self::where(['user_type' => $user_type])->get();
        return $data;
    }

    public function users() {
        return $this->belongsToMany(\App\Models\User::class);
    }
    
    public static function getAllRoleDataforAcl()
    {
        $data = DB::table('tbl_roles')->orderBy('id', 'desc')
            ->where('parent_id',0)
                ->pluck('display_name', 'id')->toArray();
        return $data;
    }

}
