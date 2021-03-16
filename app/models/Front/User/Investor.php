<?php

namespace App\Models\Front\User;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model {

    protected $table = 'investor';

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
    public static function getInvestorData($id = '')
    {
        $users = DB::table('investor');
        $users->leftjoin('users', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('etheruem_address', 'etheruem_address.user_id', '=', 'users.id');
        $users->leftjoin('bitcoin_address', 'bitcoin_address.user_id', '=', 'users.id');
        $users->select('users.*','users.id as user_id','users.status as user_status','investor.id as invertor_id','investor.citizenship as country','investor.gender','investor.city','investor.postal_code','investor.amount','investor.address1','investor.address2','etheruem_address.ethereum_address','bitcoin_address.bitcoin_address','investor.referral_code','investor.refer_by');
        $users->orderBy('users.id', 'desc');
        if($id == ''){
          $arrUser = $users->paginate(10);
        }else{
          $users->where('users.id', $id);
          $arrUser = $users->first();  
        }

        return ($arrUser ?: []);
       
    } 
    
    /**
     * Get Investor Data
     * @return array 
     * @since 0.1
     * @author Minee Soni
     */
    public static function getUserName($id)
    {
        $users = DB::table('investor');
        $users->leftjoin('users', 'investor.id', '=', 'users.type_id');
        $users->select('users.fname','users.lname');
        $users->where('investor.id',$id);
        $arrUser = $users->first();  
        
        return ($arrUser ?: []);
    } 
    
    /**
     * UpdateInvestorData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function UpdateInvestor($input,$id)
    {
        try {
           $data = self::where('id', (int) $id)->update($input);
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }
        return $data;
    }

     public static function storeData($id = '', $input)
    {
        try {
            $data = self::updateOrCreate(['id' => (int) $id], $input);    
            return ($data ? : false);
            
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }        
    }
    
    public static function getInvestorDataById($id)
    {
        $data = self::where(['id' => $id])->first();
        return $data;
    }
    
    
    public static function getInvestorByUserId($user_id)
    {
        $data = self::where(['user_id' => $user_id])->with(['countryRel'])->first();
        return $data;
    }
    
    public function countryRel()
    {
        return $this->belongsTo(\App\Models\Admin\Master\Country::class, 'country_id');
    }
    
    /****
     ** Filter Customer
     **
    ***/
    
    public static function allCustomerFilter($request)
    {
        $users = DB::table('investor');
        $users->leftjoin('users', 'investor.id', '=', 'users.type_id');
        $users->leftjoin('etheruem_address', 'etheruem_address.user_id', '=', 'users.id');
        $users->leftjoin('tbl_order', 'tbl_order.user_id', '=', 'users.id');
        $users->groupBy('users.id');
    
        if ($request['download'] != "") {
            $users->select('users.customer_id','users.fname','users.lname','users.email','users.mobile',DB::raw('sum(tbl_order.pay) as total_token'));
        } else {
            $users->select('users.*','users.id as user_id','investor.id as invertor_id','investor.citizenship as country','investor.gender','investor.city','investor.postal_code','investor.amount','investor.address1','investor.address2','etheruem_address.ethereum_address');
        }
    
        $name = explode(" ",$request['customer_name']);

        if(count($name)>0){
            if (isset($name[0])) {
                if ($name[0] != "") {
                    $name = trim($name[0]);
                    $users->where('users.fname', 'LIKE', "%$name%");
                }
            }
            if (isset($name[1])) {
                if ($name[1] != "") {
                    $name = trim($name[1]);
                    $users->where('users.lname', 'LIKE', "%$name%");
                }
            }
        }else{
            if (isset($request['customer_name'])) {
                if ($request['customer_name'] != "") {
                    $name = trim($request['customer_name']);
                    $users->where('users.fname', 'LIKE', "%$name%");
                }
            }    
        }
        
       
        if (isset($request['customer_email'])) {
            if ($request['customer_email'] != "") {
                $email = trim($request['customer_email']);
                $users->where('users.email', 'LIKE', "%$email%");
            }
        }
        
        if (isset($request['mobile'])) {
            if ($request['mobile'] != "") {
                $mobile = trim($request['mobile']);
                $users->where('users.mobile', 'LIKE', "%$mobile%");
            }
        }
        
        if (isset($request['filter_by'])) {
            if ($request['filter_by'] != "") {

                if ($request['filter_type'] == 'A') {
                    if ($request['filter_by'] == 'N') {
                        $users->orderBy('users.fname', 'asc');
                    } elseif ($request['filter_by'] == 'E') {
                        $users->orderBy('users.email', 'asc');
                    } elseif ($request['filter_by'] == 'M') {
                        $users->orderBy('users.mobile', 'asc');
                    } 
                } else {
                    if ($request['filter_by'] == 'N') {
                        $users->orderBy('users.fname', 'desc');
                    } elseif ($request['filter_by'] == 'E') {
                        $users->orderBy('users.email', 'desc');
                    } elseif ($request['filter_by'] == 'M') {
                        $users->orderBy('users.mobile', 'desc');
                    } 
                }
            }
        } else {
            $users->orderBy('users.id', 'desc');
        }

        if (isset($request['download'])) {
            if ($request['download'] != "") {
                $usersArr = $users->get();
            }
        } else {
            if ($request['no_of_records'] != "") {
                $usersArr = $users->paginate($request['no_of_records']);
            } else {
                $usersArr = $users->paginate(10);
            }
        }

        return ($usersArr ?: []);
    }
    
    public static function checkReferralCode($referral_code)
    {
        $data = self::where(['referral_code' => $referral_code])->first();
        return $data;
    }
    
    /*Function for perchentage tree on registration*/
    public static function getAffiliateTreeForRegistration($child_id=NULL,$tree)
    {
        $data = self::where('id', $child_id)->first()->toArray();
        if($data['refer_by']>0){
           $child_id=$data['refer_by'];
           array_push($tree,$data);
           $tree = self::getAffiliateTreeForRegistration($child_id,$tree);

        }else{
            array_push($tree,$data);
        }
    return $tree;
    }
    
    public static function getAffiliateTree($user_id)
    {
        
             $data = self::with(['childrenRecursive','childrenPercent','childrenName'])
                ->where('id', $user_id)
                ->get()
                ->toArray();
            
            
            $tree = [];
            try {
                foreach ($data as $i => $value) {
                     
                    $percent = 0;
                    foreach($value['children_percent'] as $childrenPercent){
                       $percent          = $childrenPercent['percentage']+$percent;
                      // $refer_type       = $childrenPercent['refer_type'] == 'W'?'Internal':'External';
                    }
                    
                    
                    $spanclass = 'pull-right';
                    $tags             = count($value['children_recursive']);
                    //$tree[$i]['text'] = ucfirst($value['children_name']['fname']).' '.ucfirst($value['children_name']['lname']).' - '.$refer_type.'&nbsp;&nbsp; ('.$tags.') <span class='.$spanclass.'>('.$percent.'%)</span>';
                    $tree[$i]['text'] = ucfirst($value['children_name']['fname']).' '.ucfirst($value['children_name']['lname']).'&nbsp;&nbsp; ('.$tags.') <span class='.$spanclass.'>('.$percent.'%)</span>';
                    
                    $tree[$i]['tags'] = "[$tags]";
                    $tree[$i]['href'] = $value['id'];
                    $tree[$i]['percent'] = "[$percent]";
                    if (!empty($value['children_recursive'])) {
                        $tree[$i]['nodes'] = self::buildTree($value['children_recursive']);
                    }

                }
                
                
            } catch (\Exception $ex) {
                return $ex->getMessage();
            }
        return $tree;
    }
    
    // recursive, loads all descendants
    public function childrenRecursive()
    {
        return $this->children()->with(['childrenRecursive', 'childrenPercent', 'childrenName']);
   }
    
    
    // Survey model
    // loads only direct children - 1 level
    public function children()
    {
        return $this->hasMany(\App\Models\Front\User\Investor::class, 'refer_by');
    }
    
    public function childrenPercent()
    {
        return $this->hasMany(\App\Models\Admin\Master\UserReferralPercentage::class, 'refer_by')->select('refer_by','percentage','refer_type');
    }
    
    public function childrenName()
    {
        return $this->hasOne(\App\User::class, 'type_id')->select('type_id','fname','lname');
    }
    
    public static function buildTree($data)
    {
        foreach ($data as $i => $value) {
            $percent = 0;
            foreach($value['children_percent'] as $childrenPercent){
               $percent          = $childrenPercent['percentage']+$percent;
               //$refer_type       = $childrenPercent['refer_type'] == 'W'?'Internal':'External';
            }
            $spanclass = 'pull-right';
            $tags             = count($value['children_recursive']);
            
            //$tree[$i]['text'] = ucfirst($value['children_name']['fname']).' '.ucfirst($value['children_name']['lname']).' - '.$refer_type.'&nbsp;&nbsp; ('.$tags.') <span class='.$spanclass.'>('.$percent.'%)</span>';
            $tree[$i]['text'] = ucfirst($value['children_name']['fname']).' '.ucfirst($value['children_name']['lname']).'&nbsp;&nbsp; ('.$tags.') <span class='.$spanclass.'>('.$percent.'%)</span>';
            $tree[$i]['tags'] = "[$tags]";
            $tree[$i]['percent'] = "[$percent]";
            $tree[$i]['href'] = $value['id'];
             
            if (!empty($value['children_recursive'])) {
                $tree[$i]['nodes'] = self::buildTree($value['children_recursive']);
            }
            
        }
        return $tree;
    }
    
    
    

}
