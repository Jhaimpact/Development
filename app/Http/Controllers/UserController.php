<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{



    public function socialLogin(Request $request){
        
        $validation_array = [
            /*'email' => 'required|email|unique:users,email',*/
            'name' => 'required|string',
            'social_media_platform' => 'required|numeric',
            'social_id' => 'required',
            'device_id' => 'required'
        ];

        $error_response = $this->validateIncomingRequest($validation_array);

        if($error_response['status'] == '0'){
            return response()->json($error_response);
        }
        // $user = User::where("email" , "=" ,$request->email)
        //         ->first();

        // if($user->is_social_login == 0 || $user->is_social_login != $request->social_media_platform ){

        //     return response()->json([
        //         'status' => 0,
        //         'message'=>'You have been already registered with us , try logging in'
        //     ]);
        //     die; 
        // }
        $user = User::where("social_id" , "=" ,$request->social_id)
                ->first();

        if(!$user){
          
            $user = User::create([
                'email' => $request->email ?? null,
                'name' => $request->name,
                'username' => $request->name,
                'contact' => $request->contactt ?? null,
                'is_social_login' => $request->social_media_platform,
                'user_detail_json' => json_encode($request),
                'is_active' => $request->social_media_platform
            ]);
        }

        DB::table('personal_access_tokens')->where("tokenable_id","=",$user->id)->delete();

        
        $token = $user->createToken($request->device_id)->plainTextToken;
            
        return response()->json([
            'status' => 1,
            'message'=> 'please Use this token for further Request',
            'token' => $token
        ]);
    }


    public function login(Request $request){
       
        $validation_array = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'device_id' => 'required',
        ];

        $error_response = $this->validateIncomingRequest($validation_array);

        if($error_response['status']){
            
            $user = User::where("email","=",$request->email)->where('is_active','=','1')->first();
            if($user){
                if (Hash::check($request->password, $user->password)) {
                    
                    DB::table('personal_access_tokens')->where("tokenable_id","=",$user->id)->delete();

                    $token = $user->createToken($request->device_id)->plainTextToken;
                    
                    return response()->json([
                        'status' => 1,
                        'message'=> 'please Use this token for further Request',
                        'token' => $token
                    ]);    

                }else{
                    return response()->json([
                        'status' => 0,
                        'message'=>'You are Unauthorized'
                    ]);
                }
            }else{
                return response()->json([
                    'status' => 0,
                    'message'=>'Your account is not yet active , Please generate OTP.'
                ]);
            }

        }
       
        return response()->json($error_response);
       
    }

    public function signup(Request $request){

        $validation_array = [
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|numeric|digits_between:6,11|unique:users,contact',
            'name' => 'required|string',
            'username' => 'required|alpha_num|unique:users,username',
            'password' =>'required|min:8'
        ];

        $error_response = $this->validateIncomingRequest($validation_array);
        
        if($error_response['status'] == '1'){
            
            $user = new User();

            $user->email = $request->email;
            $user->contact =  $request->contact;
            $user->name =  $request->name;
            $user->username =  $request->username;
            $user->password =  Hash::make($request->password);

            $response = $user->save() ? true : false;

            if($response){
               $otp =  $this->getOtp($request);
            }
            return $this->sendOperationResponse($response,4,['otp' => $otp]);
        }

        return response()->json($error_response);
    }

    public function getOtp(Request $request){
        
        // $error_response = $this->validateIncomingRequest([
        //     'contact' => 'required|numeric'
        // ]);
        
        // if($error_response['status'] == '0'){
        //     return response()->json($error_response);
        // }

        $user = User::where("contact","=",$request->contact)->first();

        if($user){
                if($user->is_active == '1'){
                    return response()->json(['status'=>0,'message'=>'You are already an active user']);
                }

                $random_otp = rand('100000','999999');
                $user->otp = $random_otp;
                $user->save();
                return $random_otp;
                // return $this->sendOperationResponse($user->save(),6,['otp'=>$random_otp]);
        
        }else{
            return response()->json(['status'=>0,'message'=>'Your Mobile numbers are not registered']);
        }

    }

    public function verifyOtp(Request $request){

        $error_response =   $this->validateIncomingRequest([
                                'contact' => 'required',
                                'otp' => 'required|numeric'
                            ]);

        if($error_response['status'] == '0'){
            return response()->json($error_response);
        }

        $user =  User::where('contact',"=",$request->contact)
                    ->where('otp','=',$request->otp)
                    ->first();
        if($user){
            $user->otp = null;
            $user->is_active = 1;
            return $this->sendOperationResponse($user->save(),5);
        }

        return response()->json([
            'status' => 0,
            'message'=> 'opps! OTP and contact number did not match'
        ]);
    }

    public function forgotPassword(Request $request){

        $error_response = $this->validateIncomingRequest([
            'contact'=>'required'
        ]);
      
        if($error_response['status'] == '0'){
            return response()->json($error_response);
        }

        $user = User::where("contact","=",$request->contact)->where('is_active','=','1')->first();
        
        if($user){

                $random_otp = rand('100000','999999');

                $user->forgot_password_otp = $random_otp;

                $user->forgot_password_time = date('Y-m-d h:i:s');
           
                return $this->sendOperationResponse($user->save(),6,['otp'=>$random_otp , 'message'=>'This OPT be Expired after 30 Minutes']);
        
        }else{
            return response()->json(['status'=>0,'message'=>'Seems that either your mobile numbers are not registered Or you are not active yet']);
        }
    }

    public function resetPassword(Request $request){

        $error_response = $this->validateIncomingRequest([
            'contact'=>  'required',
            'otp'    =>  'required',
            'password'=> 'required|min:8'
        ]);

        if($error_response['status'] == '0'){
            return response()->json($error_response);            
        }

        $user =  User::where("contact","=",$request->contact)
                       ->first();
        $response = ['status'=>1];

        if(!$user){

            return response()->json(['status'=>0,'message'=>'You are not Registerd user']);

        }else if($user->forgot_password_otp != $request->otp){

            $response = ['status'=>0,'message'=>'OTP mismatched! Please Re-Generate your OTP'];
        
        }else{
        
            $to_time = strtotime($user->forgot_password_time);
            $from_time = strtotime(date('Y-m-d h:i:s'));
            $minutes = round(abs($to_time - $from_time) / 60,2);
            if($minutes > 30){
                $response = ['status'=>0,'message'=>'OTP expired! Please Re-Generate your OTP'];
            }
        }

        $user->forgot_password_otp = null;
        $user->forgot_password_time = null;

        if($response['status']){
            $user->password = Hash::make($request->password);

            $response['message'] = 'Password has been changed successfully.';
        }

        $user->save();

        DB::table("personal_access_tokens")->where("tokenable_id","=",$user->id)->delete();

        return response()->json($response);
       
    }

    public function index(){

        $data = User::all();
        return view('customer',['result'=>$data]);
        
    }

    public function destroy(User $customer){
        return json_encode(['code'=>$customer->delete()]);
    }
}

// 1.Login DONE
// 2 registration DONE
// 3 social login 
// 4 password reset and update DONE
// 5 otp wala work DONE
// 6 Home page (structure only)
// 7 user account/profile  screen