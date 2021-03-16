<?php

namespace App\Models\Front\Ethereum;

Use DB;
use Illuminate\Database\Eloquent\Model;

class Ethereum extends Model {

    protected $table = 'etheruem_address';

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
     * storeData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee
     */
    public static function storeData($id = '', $input)
    {
        try {
            $data = self::updateOrCreate(['id' => (int) $id], $input);    
            
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }   
        return ($data ? : false);
    }
    
     /**
     * UpdateEthereumData
     * @param 
     * @return array
     * @since 0.1
     * @author Minee Soni
     */
    public static function UpdateEthereum($input,$id)
    {
        try {
            $data = self::where('user_id', (int) $id)->get()->count();
            if($data == 1){
                $data = self::where('user_id', (int) $id)->update($input);
            }else{
                $data = self::create($input);
            }   
         
        } catch (\Exception $e) {
            $data['errors'] = $e->getMessage();
        }
        return $data;
    }
    
    
}
