<?php

namespace App\Models\Admin\Master;

Use DB;
use Illuminate\Database\Eloquent\Model;

class UserReferralPercentage extends Model
{
    protected $table = 'tbl_user_referral_percentage';

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
    protected $fillable = ['investor_id', 'refer_by', 'percentage', 'level'];
    
    protected $gaurded = [];
    
    /**
     * Get All Investors
     * @return array $ico
     * @since 0.1
     * @author Minee Soni
     */
    public static function getReferralData($id = '')
    {
        
        $users = DB::table('tbl_user_referral_percentage');
        $users->leftjoin('investor', 'investor.id', '=', 'tbl_user_referral_percentage.investor_id');
        $users->leftjoin('users', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('tbl_order', 'tbl_order.user_id', '=', 'users.id');
        $users->select('users.fname','users.lname','users.email','tbl_user_referral_percentage.*','tbl_order.id as order_id','tbl_order.pay as purchase_token','tbl_order.date as purchase_date','tbl_order.point as token','tbl_order.qty as token_qty','tbl_order.reward_point as reward_token');
        $users->orderBy('tbl_user_referral_percentage.id', 'asc');
        $users->whereNotNull('tbl_order.id');
        if($id != ""){
            $users->where('tbl_user_referral_percentage.refer_by', $id);
        }
        $arrUser = $users->paginate(10);

        return ($arrUser ?: []);
        
    } 

    /**
     * storeData
     * @param $input
     * @return array data
     * @since 0.1
     * @author Minee Soni
     */
    public static function storeData($input_batch)
    {
       //self::truncate();
       $data = self::insert($input_batch);       
       return $data;
    }

    public static function getCommissionLevels(){
        $data = self::get();
        return $data;
    }
    
     

}