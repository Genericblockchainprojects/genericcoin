<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = 'admin.dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('guest', ['except' => 'logout']);
    }

    public function getAdminLogin() {

      
        if(Auth::check()){
            return redirect()->route($this->redirectTo);
        }else{
             $data['is_login']   =   'active';
             return view('adminLogin',$data);
        }
       
    }


   

    public function adminAuth(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ],[ 'email.required' => 'Email Id is required',
            'email.email' => 'Please enter valid Email Id',
            'password.required' => 'Password is required']);
    
        $user = User::getUserByemail($request->email);
        
        if((count($user)>0) && ($user->user_type != 'I')){

         
            $credentials = ['email' => $request->email, 'password' => $request->password];
            if (!Auth::attempt($credentials)) {
                return redirect()->back()->withInput()->withErrors(['password' => 'Wrong password.']);
            }
            
            
            if (Auth::user()['user_type'] == 'A') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()['user_type'] == 'O') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect('admin')->withErrors(['Please fill correct credentials'])->withInput();
            }
         
        } else {
            Auth::logout();
            return redirect('admin')->withErrors(['Please fill correct credentials'])->withInput();
        }
        
    }

    
     public function getAdminLogout(Request $request)
    {
       // Auth::guard('admin')->logout();
        //$request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('admin-login');
    }

    //adminSignup
     public function adminSignup()
    {
        if (auth()->guard('admin')->user())
            return redirect()->route('admin.dashboard');

       
        $data['is_signup'] = 'active';
        return view('signup',$data);
    }
}
