<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


use Auth;
use Mail;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateSecuritySettings;
use App\Http\Requests\UpdateEmail;
use App\Mail\EmailChangeRequest;
use App\Mail\EmailConfirmationSuccessful;

use App\User;
use App\Shop;
use App\EmailVerification;



class UserController extends Controller
{   
    protected $rules;

    public function edit(){
        if( auth()->check() ){
            $user = auth()->user();
        }

        return view('profile')->withUser($user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUser $request){
        $input = Input::all();

        $response = ['success' => 0];
        $response['msg'] = __('messages.no_changes_saved');

        if( auth()->check() ){
            $user = auth()->user();
        }else{
            $user = User::find($input['id']);
        }
        
        $user->first_name  = $input['first_name'];
        $user->last_name  = $input['last_name'];
       // $user->email  = $input['email'];
        $user->gender  = $input['gender'];
        
        if( auth()->guard('api')->check() && auth()->guard('api')->user()->isAdmin() ){
            $user->role  = $input['role'];
            $user->email  = $input['email'];
        }

        $user->telephone  = $input['telephone'];
        $user->mobile  = $input['mobile'];
        //$user->social_security_id  = $input['social_security_id'];
        $user->address_1  = $input['address_1'];
        $user->address_2  = $input['address_2'];
        $user->city  = $input['city'];
        $user->zip_code  = $input['zip_code'];
        $user->country  = $input['country'];
        $user->lang  = $input['lang'];

        if( $user->update() ){

            $response['success'] = 1; 
            $response['msg'] = __('messages.changes_saved');
        }

        return $response;
    }

    public function updatePassword(UpdateSecuritySettings $request){
        if( auth()->check() ){
            $input = Input::all();
            $old_pass = auth()->user()->password;
            if( !Hash::check($input['old_password'], $old_pass) ){
                return ['success' => 0, 'errors' => [
                    'old_password' =>  [__('errors.confirm_old_password')]
                ]];
            }

            auth()->user()->password = bcrypt($input['new_password_confirmation']);
            if( auth()->user()->save() )
                return ['success' => 1, 'msg' => __('messages.changes_saved')];
            return ['success' => 0, 'msg' => __('messages.no_changes_saved')];
        }
    }

    public function updateAvatar(Request $request){
        if( auth()->check() ){
            $this->validate($request, [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('avatar');
            $avatar = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/avatar');
            $image->move($destinationPath, $avatar);
            auth()->user()->avatar = '/images/avatar/'.$avatar;

            $flash_msg = [
                'msg' => __("errors.error_while_processing"),
                'type' => 'error',
                'is_important' => false
            ];

            if( auth()->user()->save() ){
                $flash_msg['type'] = 'success';
                $flash_msg['msg'] = __("messages.changes_saved");
            }

                return redirect()->back()->withFlash_message($flash_msg);

        }
    }

    public function updateEmail(UpdateEmail $request){
        if( auth()->check() ){
            $email = Input::get('email_confirmation');
            auth()->user()->email = $email;
            if( auth()->user()->save() )
                return [
                    'success' => 1,
                    'msg' => __('messages.email_updated', ['email' => $email])
                ];
            
        }

        return ['success' => 0, 'msg' => __('messages.no_changes_saved')];
    }



    // Requests to change email
    public function changeEmail(UpdateEmail $request){
        // $new_email = Input::get($email);
        $user = auth()->user();
        $new_email = Input::get('email_confirmation');

        $verify = new EmailVerification();
        $verify->email = $new_email;
        $verify->token = str_random(64);
        $verify->user_id = $user->id;
        $verify->save();

        $response = [
            'msg' => __('errors.error_while_processing'),
            'success' => 0
        ];

        $mail = new EmailChangeRequest($new_email, $user, $verify->token);
        try {
            Mail::to($user->email)->send($mail);

            // return redirect()->back()->withFlash_message([
            //     'type' => 'success',
            //     'msg' => __('messages.email_changed_confirmed', ['new_email' => $verify->email]),
            //     'is_important' => true
            // ]);
            $response['msg'] = __('messages.email_change_request', ['old_email' => $user->email]);
            $response['success'] = 1;
        } catch (\Exception $e) {
            $response['msg'] = __('errors.mail_noti_failed');
        }
        return $response;
    }

    // confirm email when the user changes his email
    public function confirmEmail($token){
        $verify = EmailVerification::where('token', $token)->first();
        if( isset($verify->id) ){
            $user = User::find($verify->user_id);
            $old_email = $user->email;
            $user->email = $verify->email;

            if( $user->update() ){
                $verify->delete();
                // send notification email
                try {
                    $mail = new EmailConfirmationSuccessful($user);
                    Mail::to($old_email)->send($mail);

                    return redirect('/')->withFlash_message([
                        'msg' => __('emails.email_change_noti', ['new_email' => $user->email]),
                        'type' => 'info',
                        'is_important' => true
                    ]);
                } catch (\Exception $e) {
                    
                }
            }

            return redirect('/')->withFlash_message([
                        'msg' => __('errors.you_are_lost'),
                        'type' => 'info',
                        'is_important' => true
                    ]);

        }
    }


    public function test(){
        $user = User::find(1);

        $shops = $user->shops()->first();

        dd($shops);
    }

    public function shops(User $user){
        return $user->ownedShops()->get();
    }

    public function verifyEmail($confirmation_code){
        $user = User::where('confirmation_code', $confirmation_code)->first();
        if( isset($user->id) ){
            $user->is_email_confirmed = 1;
            $user->save();

            return redirect('/')->withFlash_message([
                'type' => 'success',
                'msg' => __('messages.email_verified'),
                'is_important' => true
            ]);
        }

        return redirect('/');
    }
}
