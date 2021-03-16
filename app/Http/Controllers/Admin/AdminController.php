<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Front\PasswordRequest;
use App\Http\Requests\Front\EmailRequest;
use App\Http\Requests\SendRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Auction\Auction;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $redirectTo = 'admin';
    public function __construct()
    {
         
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
           
            return view('admin.dashboard')->with('is_dashboard','left-menu-list-active');
        }else{
            return redirect()->route('admin-login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function balance()
    {
        if(Auth::check()){
            $fields       = [];
            $fields       = array(
                'jsonrpc' => "2.0",
                'method' => "getbalance",
                'params' => ""
            );
            $data_string  = json_encode($fields);
            $ch           = curl_init();

     



            //curl_setopt($ch, CURLOPT_URL,"http://crypto-testnets.sofodev.co:12034/json_rpc");  // For Testing
           curl_setopt($ch, CURLOPT_URL,"http://admin.simwal.gnrc.io:29133/json_rpc"); // For Production

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                'Content-Type: application/json',
                'Content-Length: '.strlen($data_string))
            );
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            $result       = curl_exec($ch);
            $varBitWallet = json_decode($result, true);
            curl_close($ch);
            //return view('super_admin.dashboard')->with('walletBalance', $varBitWallet["result"]);
            //$data['is_dashboard']='active';
            //$data['walletBalance']=$varBitWallet["result"];
            return view('admin.balance')->with('walletBalance',$varBitWallet["result"])->with('is_balance','left-menu-list-active');
        }else{
            return redirect()->route('admin-login');
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        if(Auth::check()){
            
            return view('admin.send')->with('is_send','left-menu-list-active');
        }else{
            return redirect()->route('admin-login');
        }
    }

     

    public function checkBalance(Request $request)
    {
       
        $varEmail = trim($request->get("varEmail"));
        if ($varEmail != "") {
            $fields       = [];
            $fields       = array(
                'address' => $varEmail,
                'token' => "toj9Geithuco2aDei7kash3ru"
            );
            $data_string  = json_encode($fields);
            $ch           = curl_init();

            curl_setopt($ch, CURLOPT_URL,"https://www.myciwallet.com/api/getUser");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                'Content-Type: application/json',
                'Content-Length: '.strlen($data_string))
            );
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            $result       = curl_exec($ch);
            $varBitWallet = json_decode($result,true);

            curl_close($ch);
            if(is_array($varBitWallet)){
                $varBitWallet['status']="success";
                return json_encode($varBitWallet);
            }else{

                $arrData        = [];
                $arrData["error_msg"] = "Invalid Email Address";
                $arrData["status"] = "error";

                return json_encode($arrData);
            }
            
        }else{
            $arrData        = [];
            $arrData["error_msg"] = "Email Address is required";
            $arrData["status"] = "error";

            return json_encode($arrData);
        }
    }

    public function sendToken(SendRequest $request)
    {


        $varAddress  = trim($request->get("transferEmail"));
        $varAmount = trim($request->get("txtAmount"));
        $varFee    = trim($request->get("txtFee"));
        $varFactor	=	100000000;

        if ($varAmount <= 0) {
           
            $request->session()->flash('alert-danger','Invalid Amount');
            return Redirect('send');
            

            
        }
        
        if ($varFee <= 0) {
            
            $request->session()->flash('alert-danger','Invalid Fee Amount');
            return Redirect('send');

        }

        if ($varAddress != "") {



            /*$fields       = [];
            $fields       = array(
                'address' => $varEmail,
                'token' => "toj9Geithuco2aDei7kash3ru"
            );
            $data_string  = json_encode($fields);
            $ch           = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://www.myciwallet.com/api/getUser");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                array(
                'Content-Type: application/json',
                'Content-Length: '.strlen($data_string))
            );
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            $result       = curl_exec($ch);
            $varBitWallet = json_decode($result, true);
            curl_close($ch);*/
           //------------------

/*reqObject = {

      "params" : {
        "anonymity": 0,
        "fee" : << fee >>,
        "unlockTime":0,
        "mixin":0,
        "desinations" : [{
            amount: << amount >>,
            address: << recipientAddress >>
          }],  
      },
      "jsonrpc" : '2.0',
      "id" : 'test',
      "method" : 'transfer'
}

var options = {
        uri: << api url simple wallet > ,
        method: 'POST',
        headers: { 'Content-Type': 'application/json'};, 
    };
        

*/

    //------------------

            if ($varAddress != "") {
                if($varAddress != "") {
                    $fields = [];

                    $arrData            = [];


                    $arrData["amount"]  = (int) ($varAmount * $varFactor);


                    //$arrData["amount"]  = (int) ($varAmount * 1);
                    $arrData["address"] = $varAddress;
                    $varDest[]          = $arrData;

                    $fields       = array(
                        'jsonrpc' => "2.0",
                        'method' => "transfer",
                        "id"=> 'test',
                        'params' => array(
                            'destinations' => $varDest,
                            'fee' => (int) ($varFee*$varFactor),
                            'mixin' => 0,
                            'unlock_time' => 0
                        )
                    );

                   /* $fields       = array(
                        'toemail' => "$varEmail",
                        'amount'  => "$varAmount",
                        'fee'=>"$varFee",
                        'token' => "toj9Geithuco2aDei7kash3ru",
                        
                    );*/
                   
                    //dd($fields);
                    $data_string  = json_encode($fields);
                    $varBitWallet = [];
                    $ch           = curl_init();


                    //curl_setopt($ch, CURLOPT_URL,"http://crypto-testnets.sofodev.co:12034/json_rpc"); //For Testing


                    curl_setopt($ch, CURLOPT_URL,"http://admin.simwal.gnrc.io:29133/json_rpc"); //For Production
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,
                        array(
                        'Content-Type: application/json',
                        'Content-Length: '.strlen($data_string))
                    );
                    curl_setopt($ch, CURLOPT_POST, count($fields));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                    $result       = curl_exec($ch);
                    $err = curl_error($ch);
                   
                    curl_close($ch);
                    if($err){
                       
                        $request->session()->flash('alert-danger',$err);
                        return Redirect('send');
                    }

                    $varBitWallet = json_decode($result, true);
                   // dd($varBitWallet);
                    
                    if(@$varBitWallet['result']['tx_hash']!='') {
                       
                            $request->session()->flash('alert-success', "Transaction Success. [".@$varBitWallet['result']['tx_hash']."]");
                            return Redirect('send');
                    }else{
                        

                       $request->session()->flash('alert-danger',$varBitWallet['error']['message']);
                        return Redirect('send');
                    }
                    
                } else {
                    
                    $request->session()->flash('alert-danger','Invalid Address.');
                    return Redirect('send');
                }
            } else {
                
                $request->session()->flash('alert-danger','Address is required');
                return Redirect('send');
            }
        } else {
            
            $request->session()->flash('alert-danger','Address is required');
            return Redirect('send');
        }
    }

    public function changePassword() {
        $data['data'] = User::getUserWithPersonalDetails(Auth::id());
        return view('admin.profile.change_password', $data);
    }

    public function changeEmail() {
        $data['data'] = User::getUserWithPersonalDetails(Auth::id());
        return view('admin.profile.profile', $data);
    }

    public function updateEmail(EmailRequest $request){
        $user = User::find(auth()->user()->id);
        $data['email'] = $request['email'];
        User::updateProfile($data, (int) $user->id);
        $request->session()->flash('alert-success', 'Email Updated Successfully');
        return Redirect::to('change-email');
    }

    public function updatePassword(PasswordRequest $request) {

        $user = User::find(auth()->user()->id);
        if(!Hash::check($request['current_password'], $user->password)){
            return redirect()->back()->withErrors(['current_password'=>'Current Password mis-match.'])->withInput();
        }

        $data['password'] = bcrypt($request['confirm_password']);
        User::updateProfile($data, (int) $user->id);


        //Mail to User
        $arrData = ['fname'=> $user->fname, 'lname'=> $user->lname, 'email'=> $user->email, 'mobile'=> $user->mobile];
        Mail::send('email/change-pwd', $arrData, function($message) use ($user) {
                $message->to($user->email)
                 ->subject('Password Changed');
        });


        $request->session()->flash('alert-success', 'Password Updated Successfully');
        return Redirect::to('change-password');
       

    }
}
