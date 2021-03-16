<?php

namespace App\Models\Admin\Master;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'mst_packages';

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
     * Get All Packages
     * @param var $packages
     * @return array $packages
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

    
    public static function getAllPackages()
    {
        $data = self::where('status','A')
                ->orderBy('start_date', 'asc')
                ->get()->toArray();
        return $data;
    }
 

    
    public static function getPackageDetail($id)
    {
        $package = DB::table("mst_packages")
            ->where("id", $id)
            ->select("*")->get();
        return ($package ?: []);
        
    }
    
    public static function getCurrentPackage()
    {
        date_default_timezone_set('Asia/Kolkata');
        $currentDate = date('Y-m-d H:i:s'); 
        
        $data = self::where('status','A')
                ->orderBy('start_date', 'asc')
                ->whereDate('start_date', '<=', $currentDate)
                ->whereDate('end_date', '>=', $currentDate)
                ->first();
        return $data;
    }
    
   
   
}