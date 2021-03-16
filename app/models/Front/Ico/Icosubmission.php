<?php

namespace App\Models\Front\Ico;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Icosubmission extends Model {

    protected $table = 'ico_submission';

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
     * SaveIcoSubmission
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function storeData($input,$id)
    {
        
        try {
           $data = self::updateOrCreate(['id' => (int) $id], $input);
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }
        return $data;
    }
    
   
    /**
     * getAllSubmissionData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function getAllData($input)
    {
        $varData = self::create($input);
        return ($varData->id ? : []);
    }
    
    public function icoTeamRel()
    {
        return $this->hasMany(\App\Models\Front\Ico\Icoteam::class, 'ico_id');
    }
    
    public static function teamMembers($id,$userID)
     {
         if($id != ''){
             $data = self::where('id', $id)->where('user_id', $userID)->with(['icoTeamRel'])->get();
         }else{
             $data = self::where('user_id', $userID)->with(['icoTeamRel'])->get();
         }

         return $data;
     }
    
    

    /**
     * Get All Ico
     * @param var $status
     * @return array $ico
     * @since 0.1
     * @author Minee Soni
     */
    public static function getIcoDataByStatus($status)
    {
        $users = DB::table('ico_submission');
        $users->select('ico_submission.*');
        $users->where('ico_submission.ico_status', $status);
        $users->orderBy('ico_submission.id', 'desc');
        $arrUser = $users->paginate(10);
        return ($arrUser ?: []);
        
    }
     
    public static function updateIcoStatus($statusArr, $id) {
        self::where('id', $id)->update($statusArr);
    }
 
    /**
     * Get ICO Data By Title Name
     */
    public static function getIcoDataByID($title){
        $data = self::where('name', 'LIKE', "%$title%")
                      ->where('ico_status', '1')
                      ->select('id','name','start_time','end_time')
                      ->get();

        return ($data ?: []);
    }
}
