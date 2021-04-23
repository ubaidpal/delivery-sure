<?php
/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 17-Oct-16 7:02 PM
 * File Name    : ApiPasswordController.php
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ApiPasswordController extends Controller
{
    use ResetsPasswords;

    /*public function forget_password(Request $request) {
     $this->sendResetLinkEmail($request);
        return \Api::success_with_message('Check your email');
    }*/

    public function forget_password(Request $request) {
        if(!isset($request->email) || empty($request->email)) {
            return \Api::invalid_param();
        }
        $response = \Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject('Your Password Reset Link');
        });
        switch ($response) {
            case \Password::RESET_LINK_SENT:
                return \Api::success_with_message(trans($response));

            case \Password::INVALID_USER:
                return \Api::other_error('Invalid Email');
        }
    }
}
