<?php

namespace App\Models\Front\ContactUs;

Use DB;
use Illuminate\Database\Eloquent\Model;

class EmailSubscribe extends Model {

    protected $table = 'email_subscribe';

     /**
     * Custom primary key is set for the tabl
     * @var intesssger
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
    public static function storeData($data) {
        $arrData = self::create($data);
        return ($arrData->id ? : false);
    }
    
    public static function getAllData()
    {
        $data = self::orderBy('id','desc')->select('email','created_at as date&time')->get();
        return $data;
    }

}
