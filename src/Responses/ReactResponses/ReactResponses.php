<?php
namespace TwoFactorAuth\Responses\ReactResponses;

use Illuminate\Http\Response;

class ReactResponses{


    public function NoTwoFactorAuth()
    {
        return response()->json(
            [
                'status' => '400',
                'message' => 'No two factor type associated with this pattern'], Response::HTTP_BAD_REQUEST);
    }


    public function tokenNotFound(){
        return response()->json(
            [
                'status' => '404',
                'message' => 'کد معتبر نیست'],Response::HTTP_NOT_FOUND);
    }


    public function twoFactorAutTokenSentWithSms(){
        return response()->json(
            [
                'status' => '200',
                'message' => 'کد ورود دومرحله‌ای به موبایل شما ارسال شد'],Response::HTTP_OK);
    }

    public function twoFactorAutTokenSentWithEmail(){
        return response()->json(
            [
                'status' => '200',
                'message' => 'کد ورود دومرحله‌ای به ایمیل شما ارسال شد'],Response::HTTP_OK);
    }

    
    public function loggedIn($apiToken){
        return response()->json(
            [
                'status' => '200',
                'message' => '!وارد شدید',
                'token' => $apiToken ],Response::HTTP_OK);
    }
}