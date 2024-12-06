<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\ApiMessages;
use App\Constants\Resources;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Http\Resources\CustomerResource;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\CustomMediaProperties;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {
    }

    public function register(RegisterRequest $request)
    {
        
        $otp_code = $this->authService->register($request->validated());
        // dd
        return $this->okResponse($otp_code, __(ApiMessages::MSG_EMAIL_SENDED_SUCCESSFULLY));
    }

    public function login(LoginRequest $request)
    {
        $token = $this->authService->login($request->validated());

        return $this->okResponse($token, __(ApiMessages::MSG_LOGIN_SUCCESSFULLY));
    }
    public function logout()
    {
        $this->authService->logout();

        return $this->okResponse([], __(ApiMessages::MSG_LOGOUT_SUCCESSFULLY));
    }
    public function sendCode(EmailRequest $request)
    {
        $response = $this->authService->sendCode($request->validated());

        return $this->okResponse($response, __(ApiMessages::MSG_EMAIL_SENDED_SUCCESSFULLY));
    }
    public function checkCode(VerifyEmailRequest $request)
    {
        $response = $this->authService->checkCode($request->validated());
        // dd('f');
        // dd($response);
        if($response == 'correct_code') {
            return $this->okResponse([], __(ApiMessages::MSG_CORRECT_OTP));
        } else if($response == 'invalid_code') {
            return $this->unauthorizedResponse([], __(ApiMessages::MSG_INVALID_OTP_CODE));
        } else {
            return $this->unauthorizedResponse([], __(ApiMessages::MSG_UNMATCHED_USER_TYPE));
        }
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $res = $this->authService->changePassword($request->validated());
        // dd($res);
        if($res == 'true') {
            return $this->okResponse([], __(ApiMessages::MSG_RESET_PASSWORD_SUCCESSFULLY));
        } 

        return $this->unauthorizedResponse([], __(ApiMessages::MSG_WRONG_OLD_PASSWORD));
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->authService->updateProfile($request->validated());

        return $this->okResponse(
            [],
            messageHandler(ApiMessages::MSG_UPDATED_SUCCESSFULLY , Resources::RES_PROFILE)
        );
    }

    public function getMyProfile()
    {
        $profile = $this->authService->getProfile();

        $response = CustomerResource::make($profile);

        return $this->okResponse($response, messageHandler(
            ApiMessages::MSG_FETCHED_SUCCESSFULLY , Resources::RES_PROFILE
        ));
    }
}
