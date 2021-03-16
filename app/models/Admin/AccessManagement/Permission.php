<?php

namespace App\Models\Admin\AccessManagement;

use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Permission extends Authenticatable {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_permissions';

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
        'post_login_route',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    protected $guarded = ['id'];

    /**
     * Scope to get default route after login
     * 
     * @param  Eloquent $query
     * @return Eloquent
     */
    public function scopeDefaultRoute($query) {
        return $query->where('post_login_route', 1);
    }

    /**
     * Get All Permission
     * 
     * @param void()
     * 
     * @return object permissions
     * 
     * @since 0.1
     */
    public static function getAllPermissions($role_id) {

        $arrPermissions = self::select('id', 'display_name', 'parent_permission_id', 'name')
                        ->where('parent_permission_id', 0)
                        ->where('route_type', 0)
                        ->where('is_display', 1)
                        ->orderBy('parent_permission_id', 'ASC')->get();
        $i = 0;
        foreach ($arrPermissions as $arrPermission) {

            $arrPermissions[$i]['children'] = $arrPermission->children()->get();
            $i++;
        }


        return ($arrPermissions ? : false);
    }

    public function children() {
        return $this->hasMany(Permission::class, 'parent_permission_id', 'id')->where('is_display', 1);
    }

    public static function getChildByPermissionId($parent_permission_id) {
        $permission = Permission::find($parent_permission_id);
        return $permission->hasMany(Permission::class, 'parent_permission_id', 'id')
                        ->where('parent_permission_id', $parent_permission_id)->get();
    }

    /**
     * Get All Permission List
     * 
     * @param void()
     * 
     * @return object permissions
     * 
     * @since 0.1
     */
    public static function getPermissionList() {
        $arrPermissions = self::whereIn('permissions.route_type', [0, 1, 2])
                        ->where('roles.user_type', config('aiims.yes'))
                        ->join('tbl_permission_role', 'permissions.id', '=', 'tbl_permission_role.permission_id')
                        ->join('roles', 'roles.id', '=', 'tbl_permission_role.role_id')
                        ->select('roles.id', 'roles.name', 'permissions.display_name', 'tbl_permission_role.permission_id')
                        ->groupBY('roles.name')->get();

        return $arrPermissions;
    }

    /**
     * Get All Permission List For View
     * 
     * @param void()
     * 
     * @return object permissions
     * 
     * @since 0.1
     */
    public static function getPermissionListForView($role_id) {
        $arrPermissions = self::whereIn('permissions.route_type', [config('b2c_common.ROUTES_BACKEND'), config('b2c_common.ROUTES_AFFILIATE')])
                        ->where('roles.id', $role_id)
                        ->join('tbl_permission_role', 'permissions.id', '=', 'tbl_permission_role.permission_id')
                        ->join('roles', 'roles.id', '=', 'tbl_permission_role.role_id')
                        ->select('permissions.display_name', 'tbl_permission_role.permission_id')->get();

        return ( $arrPermissions ? : false );
    }

    /**
     * Get all routes
     * 
     * @return routes object
     */
    public static function getRoute() {
        $arrRoutes = self::where('route_type', config('b2c_common.NO'))->select('id', 'name', 'display_name', 'created_at');
        return ( $arrRoutes ? : false );
    }

    /**
     * Save route data
     * 
     * @param array $routeData
     * @param array $route_id route id
     * 
     * @return object route
     */
    public static function addRoute($routeData, $route_id) {
        $routeObj = self::updateOrCreate($route_id, $routeData);
        return ($routeObj ? : false);
    }

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Get Permission By Role ID
     * @param int $roleId
     * @return
     * @since 0.1
     * @author Meghendra S Yadav
     */
    public static function getAllPermissionByRoleID($roleId) {
        $arrRolePermission = DB::table('permission_role')
                ->select('permission_role.*')
                ->WHERE('role_id', '=', $roleId)
                ->get();
        return ($arrRolePermission ? : []);
    }

}
