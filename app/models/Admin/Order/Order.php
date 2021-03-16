<?php

namespace App\Models\Admin\Order;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_order';

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
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
   /**
     * Get All Orders
     * @param var $orders
     * @return array $orders
     * @since 0.1
     * @author Minee Soni
     */
    public static function allData()
    {
        $packages = self::orderBy('id', 'desc')->paginate(10);
        return $packages;
    }
    
    public static function updateData($input, $id)
    {
        self::where('id', $id)->update($input);
    }

    /**
     * storeData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
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
    
     /**
     * Get Total Assign Token
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function getTokenByID($id)
    {
        try {
            $data = self::select(DB::raw('sum(pay) as total_pay'))->where('status' , 'S')->where('user_id' , $id)->get();    
            return ($data ? : false);
            
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }        
    }
    
    /**
     * Get All Orders
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function getAllOrders($id ='',$user_id='',$status='')
    {
        
        $users = DB::table('tbl_order');
        $users->leftjoin('users', 'users.id', '=', 'tbl_order.user_id');
        $users->leftjoin('investor', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('tbl_kyc', 'tbl_kyc.user_id', '=', 'users.id');
        $users->leftjoin('etheruem_address', 'etheruem_address.user_id', '=', 'users.id');
        $users->leftjoin('bitcoin_address', 'bitcoin_address.user_id', '=', 'users.id');
        $users->select('users.*','tbl_order.id as order_id','tbl_order.status as order_status','tbl_order.*','etheruem_address.*','tbl_kyc.*','investor.*','bitcoin_address.*');
        $users->orderBy('tbl_order.id', 'desc');
        $users->where('users.user_type', 'I');
        
        if($id != ''){
            $users->where('tbl_order.id', $id);
        }
        if($user_id != ''){
            $users->where('tbl_order.user_id', $user_id);
        }
        
        if($status != ''){
            $users->where('tbl_order.status', $status);
        }
        $arrUser = $users->paginate(10);  
        return ($arrUser ?: []);
    }
   
    /**
     * Get Orders By Status
     * @param var $orders
     * @return array $orders
     * @since 0.1
     * @author Minee Soni
     */
    public static function allOrderByStatus($status)
    {
        $orders = self::where('status',$status)->orderBy('id', 'desc')->get();
        return $orders;
    }
    
    
     /**
     * Get All Orders By Package Name
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function getOrdersByPackageName($package_title = '')
    {
        $users = DB::table('tbl_order');
        $users->leftjoin('users', 'users.id', '=', 'tbl_order.user_id');
        $users->leftjoin('investor', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('tbl_kyc', 'tbl_kyc.user_id', '=', 'users.id');
        $users->leftjoin('etheruem_address', 'etheruem_address.user_id', '=', 'users.id');
        $users->select('users.*','tbl_order.id as order_id','tbl_order.*','etheruem_address.*','tbl_kyc.*','investor.*');
        $users->orderBy('tbl_order.id', 'desc');
        $users->where('users.user_type', 'I');
        if($package_title != ''){
            $users->where('tbl_order.name', $package_title);
        }
        $arrUser = $users->paginate(10);  
        return ($arrUser ?: []);
    }
    
    
     /**
     * Get All Orders By Customer ID
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function getOrdersByCustomerID($CustomerID = '')
    {
        $users = DB::table('tbl_order');
        $users->leftjoin('users', 'users.id', '=', 'tbl_order.user_id');
        $users->leftjoin('investor', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('tbl_kyc', 'tbl_kyc.user_id', '=', 'users.id');
        $users->leftjoin('etheruem_address', 'etheruem_address.user_id', '=', 'users.id');
        $users->select('users.*','tbl_order.id as order_id','tbl_order.*','etheruem_address.*','tbl_kyc.*','investor.*');
        $users->orderBy('tbl_order.id', 'desc');
        $users->where('users.user_type', 'I');
        if($CustomerID != ''){
            $users->where('tbl_order.user_id', $CustomerID);
        }
        $arrUser = $users->paginate(10);  
        return ($arrUser ?: []);
    }
    
    /**
     * Get All Orders By Payment MOD
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function getAllOrdersByMOD($user_id ='',$mod='')
    {
        
        $users = DB::table('tbl_order');
        $users->leftjoin('users', 'users.id', '=', 'tbl_order.user_id');
        $users->leftjoin('investor', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('tbl_kyc', 'tbl_kyc.user_id', '=', 'users.id');
        $users->leftjoin('etheruem_address', 'etheruem_address.user_id', '=', 'users.id');
        $users->leftjoin('bitcoin_address', 'bitcoin_address.user_id', '=', 'users.id');
        if($mod == ''){
            $users->select(DB::raw('sum(pay) as total_pay'));
        }else{
            $users->select(DB::raw('sum(qty) as total_pay'));
        }
        
        $users->orderBy('tbl_order.id', 'desc');
        $users->where('users.user_type', 'I');
        $users->where('tbl_order.status' , 'S');
        if($user_id != ''){
            $users->where('tbl_order.user_id', $user_id);
        }
        if($mod != ''){
            $users->where('tbl_order.mod', $mod);
        }
        $arrUser = $users->get();  
        return ($arrUser ?: []);
    }
    
    
   
}