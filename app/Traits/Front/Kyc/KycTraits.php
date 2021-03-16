<?php

namespace App\Traits\Front\Kyc;

use Auth;
use App\Helpers\Helper;

trait KycTraits {

    function createKycRequest($request) {
        $input['user_id'] = Auth::user()->id;
        $input['other'] = $request['other'];
        $input['state'] = $request['state'];
        $input['country_code'] = $request['country_code'];
        $input['dob'] = date("Y-m-d" ,strtotime(str_replace('/','-',$request['dob'])));
        $input['id_type'] = $request['id_type'];
        $input['issue_date'] = $request['issue_date']!= ''?date("Y-m-d" ,strtotime(str_replace('/','-',$request['issue_date']))):null;
        $input['valid_id'] = $request['valid_id'];
        return $input;
    }
    
    function createKycOccupationRequest($request) {
        $input['account_number'] = $request['account_number'];
        $input['bank_name'] = $request['bank_name'];
        $input['ifsc_code'] = $request['ifsc_code'];
        $input['beneficiary_name'] = $request['beneficiary_name'];
        $input['account_type'] = $request['account_type'];
        $input['remark'] = $request['remark'];
        $input['kyc_identity'] = @$request['id_proof'];
        $input['kyc_address'] = @$request['add_proof'];
        return $input;
    }


}
