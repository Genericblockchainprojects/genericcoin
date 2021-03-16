<?php

namespace App\Models\Front\Kyc;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model {

    protected $table = 'tbl_kyc';

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
     * Get All Investors
     * @return array $ico
     * @since 0.1
     * @author Minee Soni
     */
    public static function getKycData($id = '')
    {
        $kyc = DB::table('tbl_kyc');
        $kyc->leftjoin('users', 'tbl_kyc.user_id', '=', 'users.id');
        $kyc->leftjoin('investor', 'investor.id', '=', 'users.type_id');
        $kyc->select('users.*','users.id as user_id','investor.*','tbl_kyc.id as kyc_id','tbl_kyc.*','tbl_kyc.status as kyc_status');
        $kyc->orderBy('users.id', 'desc');
        if($id == ''){
          $arrKyc = $kyc->paginate(10);
        }else{
          $kyc->where('tbl_kyc.id', $id);
          $arrKyc = $kyc->first();  
        }

        return ($arrKyc ?: []);
         
        
        
    } 
    

     /**
     * storeData
     * @param 
     * @return array
     * @since 0.1
     * @author Vikrant
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
    
    public static function getKycDataByUserId($user_id)
    {
        $users = DB::table('users');
        $users->leftjoin('tbl_kyc', 'users.id', '=', 'tbl_kyc.user_id');
        $users->leftjoin('investor', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('etheruem_address', 'users.id', '=', 'etheruem_address.user_id');
        $users->select('users.id as uid','tbl_kyc.*','users.fname','users.lname','users.email','investor.citizenship','investor.gender','investor.address1','investor.address2','investor.city','investor.postal_code','users.mobile','etheruem_address.ethereum_address');
        $users->orderBy('users.id', 'desc');
        $users->where('users.id', $user_id);
        $arrUser = $users->first();  
        return ($arrUser ?: []);
    }
    
    public static function checkKycByIUserId($user_id)
    {
        $data = self::where(['user_id' => $user_id])->count();
        return $data;
    }
    
    public static function getKycByUserId($user_id)
    {
        $data = self::where(['user_id' => $user_id])->first();
        return $data;
    }
    
    public static function updateKycByUserID($data,$user_id)
    {
        $data = self::where(['user_id' => $user_id])->update($data);
        return $data;
    } 
    
    
    
}
