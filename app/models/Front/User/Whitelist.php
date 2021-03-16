<?php

namespace App\Models\Front\User;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model {

    protected $table = 'whitelist';

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
     * Get All Whitelist Data
     * @return array $ico
     * @since 0.1
     * @author Minee Soni
     */
    public static function getWhitelistData()
    {
        $users = DB::table('whitelist');
        $users->orderBy('id', 'desc');
        $arrUser = $users->paginate(10);
        return ($arrUser ?: []);
        
    } 
    
    /**
     * UpdateWhitelistData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function UpdateWhitelist($input,$id)
    {
        try {
           $data = self::where('id', (int) $id)->update($input);
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }
        return $data;
    }
    
}
