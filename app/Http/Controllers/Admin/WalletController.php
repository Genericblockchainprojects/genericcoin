<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Models\Auction\Auction;
use App\Models\Admin\Order\Order;
use App\Http\Controllers\Controller;


class WalletController extends Controller
{

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
        $data['users']          =   array();//User::getTenLatestUsers();
        $data['totalUsers']     =   array();//User::getCustomerCount();
        $data['completedOrder'] =   array();//Order::allOrderByStatus('S');
        $data['pendingOrder']   =   array();//Order::allOrderByStatus('P');
        $data['cancelOrder']    =   array();//Order::allOrderByStatus('C');
        $data['collectBTC']     =   array();//Order::getAllOrdersByMOD('','BTC');
        $data['collectETH']     =   array();//Order::getAllOrdersByMOD('','ETH');
        $data['collectWIRED']   =   array();//Order::getAllOrdersByMOD('','WIRED');
        $data['is_wallet']      =   'active';
        return view('admin.wallet.wallet', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        $data['users']          =   array();//User::getTenLatestUsers();
        $data['totalUsers']     =   array();//User::getCustomerCount();
        $data['completedOrder'] =   array();//Order::allOrderByStatus('S');
        $data['pendingOrder']   =   array();//Order::allOrderByStatus('P');
        $data['cancelOrder']    =   array();//Order::allOrderByStatus('C');
        $data['collectBTC']     =   array();//Order::getAllOrdersByMOD('','BTC');
        $data['collectETH']     =   array();//Order::getAllOrdersByMOD('','ETH');
        $data['collectWIRED']   =   array();//Order::getAllOrdersByMOD('','WIRED');
        $data['is_send']      =   'active';
        return view('admin.wallet.send', $data);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receive()
    {
        $data['users']          =   array();//User::getTenLatestUsers();
        $data['totalUsers']     =   array();//User::getCustomerCount();
        $data['completedOrder'] =   array();//Order::allOrderByStatus('S');
        $data['pendingOrder']   =   array();//Order::allOrderByStatus('P');
        $data['cancelOrder']    =   array();//Order::allOrderByStatus('C');
        $data['collectBTC']     =   array();//Order::getAllOrdersByMOD('','BTC');
        $data['collectETH']     =   array();//Order::getAllOrdersByMOD('','ETH');
        $data['collectWIRED']   =   array();//Order::getAllOrdersByMOD('','WIRED');
        $data['is_receive']      =   'active';
        return view('admin.wallet.received', $data);
    }

    //

    
}