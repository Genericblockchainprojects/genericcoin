<?php

namespace App\Models\Front\ContactUs;

Use DB;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model {

    protected $table = 'tbl_contactus';

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
     * @author Vikrant
     */
    public static function storeData($data) {
        $arrData = self::create($data);
        return ($arrData->id ? : false);
    }
	
	
    public static function getAllData()
    {
        $data = self::orderBy('id','desc')->get();
        return $data;
    }

}
