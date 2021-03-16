<?php

namespace App\Models\Admin\Master;

use Illuminate\Database\Eloquent\Model;

class ReferralCommission extends Model
{
    protected $table = 'tbl_referral_commission';

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
    protected $fillable = [];
    
    protected $gaurded = ['updated_at'];

    /**
     * storeData
     * @param $input
     * @return array data
     * @since 0.1
     * @author Meenu Singh
     */
    public static function storeData($input_batch)
    {
       self::truncate();
       $data = self::insert($input_batch);       
       return $data;
    }

    public static function getCommissionLevels(){
        $data = self::get();
        return $data;
    }

}