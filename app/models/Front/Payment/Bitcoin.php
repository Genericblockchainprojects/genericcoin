<?php

namespace App\Models\Front\Payment;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Bitcoin extends Model {

    protected $table = 'bitcoin_address';

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
     * storeData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee
     */
    public static function storeData($id = '', $input)
    {
        
        try {
            $data = self::updateOrCreate(['id' => (int) $id], $input);    
            return ($data ? : false);
            
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }        
    }
    
    public static function getDataByStatus($status)
    {
        $data = self::where(['status' => $status])->first();
        return $data;
    }
        
}
