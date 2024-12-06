<?php

namespace App\Http\Services;

use stdClass;
use App\Models\Admin;
use App\Models\Customer;
use App\Constants\Resources;
use App\Event\SendEmailEvent;
use App\Constants\ApiMessages;
use App\Http\Traits\ModelHelper;
use App\Http\Traits\ApiResponder;
use App\Constants\MediaCollection;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\Mailer\Messenger\MessageHandler;

class AuthService extends BaseService 
{
    public function register($data)
    {
        // dd('f');
        DB::beginTransaction();
        $data['password'] = bcrypt($data['password']);
        
        $customer = Customer::create($data);
        
        $email = $customer->email;

        $code = RandomCode();

        event(new SendEmailEvent($email , $code));

        $customer->otp_code = $code;

        $customer->save();

        if(isset($data['image']) && !empty($data['image']))
        {
            uploadFile($data['image'] , $customer , MediaCollection::CUSTOMER_COLLECTION);
        }

        DB::commit();
        $response = new stdClass;
        
        // $response->token = JWTAuth::customClaims(['exp' => config('constants.exp.ttl')])->fromUser($customer);
        $response->otp_code  = $code;

        return $response;
    }

    public function login($data)
    {
        if ((isset($data['email']) && ! auth()->guard('admin')->attempt(["username" => $data['email'], "password" => $data['password']]))  ||
           (isset($data['phone']) && ! auth()->guard('customer')->attempt(["phone" => $data['phone'], "password" => $data['password']]) )
        ) {
            return $this->unauthorizedResponse([], __(ApiMessages::MSG_WRONG_PASSWORD));
        }
        $user = isset($data['email']) ? Admin::where('username' , $data['email'])->first() : Customer::where('phone' , $data['phone'])->first();

        $response = new stdClass;
        
        $response->token = JWTAuth::customClaims(['exp' => config('constants.exp.ttl')])->fromUser($user);
        $response->email  = isset($data['email']) ? null : $user->email;

        return $response;
    }

    public function logout()
    {
        auth()->guard('customer')->logout();
    }

    public function sendCode($data)
    {
        $email = $data['email'];

        $response = new stdClass;

        $user = Customer::where('email' , $email)->first();

        DB::beginTransaction();

        $code = RandomCode();

        $user->otp_code = $code;

        $user->save();

        DB::commit();

        event(new SendEmailEvent($email , $code));


        $response->otp_code = $code;

        return $response;
    }

    public function checkCode($data)
    {
        $code = $data['otp_code'];

        $customer = Customer::where('email', $data['email'])->first();
        // dd('ff');
        $response = new stdClass;

        if(! $customer)
        {
            return $response->code = 'invalid_user';
        }
        // dd('ff');
        if($customer->otp_code == $code)
        {
            return $response->code = 'correct_code';
        }

        return $response->code = 'invalid_code';
    }

    public function changePassword($data)
    {
        $customer = Customer::find(customer_id());

        $response = new stdClass;
        // dd($data);
        if($data['old_password'] !== $customer->password)
        {
            return $response->success = 'false';
        }
        
        $customer->password = bcrypt($data['new_password']);

        $customer->save();

        return $response->success = 'true';
    }

    public function updateProfile($data)
    {
        DB::beginTransaction();
        $customer = Customer::find(customer_id());

        $customer->update($data);

        if(isset($data['image']) && !empty($data['image']))
        {
            updateFile($data['image'] , $customer , MediaCollection::CUSTOMER_COLLECTION);
        }

        $customer->save();

        DB::commit();
    }

    public function getProfile()
    {
        $customer = Customer::find(customer_id());

        return $customer;
    }
}
