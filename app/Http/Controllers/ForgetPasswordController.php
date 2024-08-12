<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    //Forget password view
    public function forgetPass(){
        return view('auth.forget-password');
    }

    //sent reset link in email functionality
    public function sendResetLink(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
       try{
            $existingToken = DB::table('password_reset_tokens')->where('email', $request->email)->first();
            if($existingToken){
                $token = $existingToken->token;
                DB::table('password_reset_tokens')->where('email', $request->email)->update([
                    'created_at' => Carbon::now(),
                ]);
            }else{

                $token = Str::random(64);
                DB::table('password_reset_tokens')->insert([
                    'token' => $token,
                    'email' => $request->email,
                    'created_at' => Carbon::now(),
                ]);
            }

            $action_link = route('reset.password.token',['token' =>$token, 'email' =>$request->email]);
            $body = 'We are received a request to reset the password for <b> Your app name<b> account associated with ' .$request->email. ' You can reset your password by clicking the link below';
            Mail::send('email-forgot',['action_link' =>$action_link, 'body' => $body], function($message) use ($request){
                $message->from('noreply@gmail.com', 'Your App name')
                        ->to($request->email, 'Your name')
                        ->subject('Reset password');
            });

            return back()->with('success', 'We have e-mailed your password reset link');
       }catch(Exception $e){
            Log::error('Error sending reset link: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while sending the password reset link. Please try again later.');
       }

    }

    //Show reset password form
    public function showResetForm (Request $request, $token = null){

        return view('auth.reset-form')->with(['token' => $token,'email'=>$request->email]);
    }


    //Reset password and check email 
    public function resetPassword(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        try{
            $check_token = DB::table('password_reset_tokens')->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

            if(!$check_token){
                return back()->withInput()->with('fail', 'Invalid token');
            }else{
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password),
                ]);
                DB::table('password_reset_tokens')->where([
                    'email' => $request->email,
                ])->delete();

                return redirect()->route('login')->with('success','Your password has been changed! You can login with new password');
            }
        }catch(Exception $e){
            Log::error('Error sending reset link: ' . $e->getMessage());
            return back()->withInput()->with('error', 'An error occurred while resetting your password. Please try again later.');
        }
    }
}
