<?php

namespace App\Models\Front\Ico;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Icoteam extends Model {

    protected $table = 'ico_team';

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
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
     /**
     * SaveIcoTeamMembers
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */

    public static function SaveIcoTeam($data) {
        
        $varData = self::create($data);
        return ($varData->id ? : false);
    }
    
    public static function getAllDataByID($id)
    {
        $data = self::where('ico_id',$id)->get()->toArray();
        return $data;
    }
    
     public static function deleteTeamMember($ico_id)
    {
        return self::where('ico_id',$ico_id)->delete();
    }
    
    
}
