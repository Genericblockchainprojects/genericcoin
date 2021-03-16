<?php

namespace App\Traits\Front\ContactUs;

use Auth;
use App\Helpers\Helper;

trait ContactUsTraits {

    function createContactUsRequest($request) {
        
        $input['name'] = $request['name'];
        $input['email'] = $request['email'];
        $input['subject'] = $request['subject'];
		$input['comment'] = $request['comment'];
       
        return $input;
    }
    
   
}
