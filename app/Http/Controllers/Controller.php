<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $type;

    public function __construct(){
        $this->type = [
            '0' => 'Opps! Some error occured While performing this action',
            '1' => 'Great! Data has been Entered Successfully',
            '2' => 'Great! Data has been Updated Successfully',
            '3' => 'Great! Data has been Deleted Successfully',
            '4' => 'Great! You have been Registered with us , Happy Journey.',
            '5' => 'Great! Your account has been activated',
            '6' => 'Great! OTP has been sent to your mobile number',
            '7' => 'Great! Product has been wishlisted',
            '8' => 'Great! Product has been removed from wishlist',
            '9' => 'Opps! Result Could not found',
        ];

    }

    function validateIncomingRequest($validation_rules ){
        $validator = Validator::make(request()->all(), $validation_rules);

        if ($validator->fails()) {
            return [
                'status'=>0,
                'message'=>'Incoming parameters are not Appropriate',
                'error' => $validator->messages()
            ];
        } else {
            return [
                'status' => 1
            ];
        }

    }


    function sendOperationResponse($result,$type = 1 , $data = []){
        $response_array['message'] = $result ? $this->type[$type] : $this->type['0'];
        $response_array['status']  = $result ? '1' : '0';
        if($result && !empty($data)){
            $response_array['result']  = $data;
        }

        return response()->json($response_array);
    }


    function setSessionData($result , $type){
        if($result){
            request()->session()->flash('success',$this->type[$type]);
        }else{
            request()->session()->flash('error',$this->type[0]);
        }
    }
}
