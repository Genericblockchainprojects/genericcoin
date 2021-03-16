<?php

namespace App\Models\Admin\Master;

use DB;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Authenticatable;

class Country extends Model
{
    protected $table = 'mst_country';

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
     * countCountry
     * @param 
     * @return $total
     * @since 0.1
     * @author Vikrant
     */
    public static function countCountry()
    {
        $total = self::count();
        return $total;
    }

    /**
     * Get All Country
     * @return array arrCountry
     * @since 0.1
     * @author Vikrant
     */
    public static function getAllCountry($paging = 0) {
        if ($paging > 0) {
            $arrCountry = DB::table('mst_country')
                    ->select('mst_country.*')
                    ->orderby('id', 'desc')
                    ->paginate($paging);
        } else {
            $arrCountry = DB::table('mst_country')
                    ->select('mst_country.*')
                    ->get();
        }
        return ($arrCountry ? $arrCountry : []);
    }

    /**
     * Get Country By ID
     * param integer varCountryID
     * @return array arrCountry
     * @since 0.1
     * @author Vikrant
     * 
     */
    public static function getCountryByID($varCountryID)
    {
        $arrCountry = DB::table('mst_country')
            ->select('mst_country.*')
            ->where('id', '=', $varCountryID)
            ->first();
        return ($arrCountry ? $arrCountry : []);
    }

    /**
     * Save Country
     * @param array $arrCountry
     * @return true
     * @since 0.1
     * @author Vikrant
     */
    public static function saveCountry($arrCountry)
    {
        $check = SELF::checkCountry($arrCountry);
        if ($check == 0) {
            self::create($arrCountry);
            return (true ? : false);
        }
        return 0;
    }

    /**
     * check country name
     * @param Array $arrCountry
     * @return array arrCountry
     * @since 0.1
     * @author Vikrant
     */
    public static function checkCountry($arrCountry)
    {

        $arrCountryData = SELF::select('*')
            ->WHERE('name', '=', $arrCountry['name'])
            ->get();
        $count          = count($arrCountryData);
        return ($count ? : false);
    }

    /**
     * update Country
     * @param var $country_id
     * @param array $arrCountryData user data
     * @return boolean
     * @since version 0.1
     * @author Vikrant
     */
    public function updateCountry($country_id, $arrCountryData)
    {
        $rowUpdate = self::find((int) $country_id)->update($arrCountryData);
        return ($rowUpdate ? true : false );
    }

    /**
     * Delete Country
     * @param int $varCID
     * @return integer $varCountryID->id
     * @since 0.1
     * @author Vikrant
     */
    public static function deleteCountry($varCID)
    {
        $varCountryID = self::where('id', '=', $varCID)->delete();
        return ($varCountryID ? : false);
    }
    
    /**
     * Get All Country
     * @return array arrCountry
     * @since 0.1
     * @author Minee
     */
    public static function getAllCountries() {
        $arrCountry = self::orderBy('name', 'asc')->pluck("name", "id")->toArray();
        return $arrCountry;
    }
    
}