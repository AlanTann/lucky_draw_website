<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Models\Admin;
use View;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin()
    {
        // show the form
        return View::make('login');
    }

    public function processLogin()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
            
            // attempt to do the login
            if (Auth::attempt($userdata)) {

                $user_id = $this->getUserId($userdata['email']);
                $admin_exist = $this->checkIfUserIsAdmin($user_id);

                if($admin_exist > 0) {
                    return redirect('/admin');
                }

                // validation successful!
                // redirect them to the secure section or whatever
                // return Redirect::to('secure');
                // for now we'll just echo success (even though echoing in a controller is bad)
                echo 'SUCCESS!';

            } else {        

                // validation not successful, send back to form 
                echo 'Fail!';

            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function getUserId($email)
    {
        $user = new User();
        $user_id = $user->select('id')->where('email','=', $email)->get()->toArray();

        return $user_id;
    }

    public function checkIfUserIsAdmin($user_id)
    {
        $admin = new Admin();
        $count_winner_exist = $admin->where('user_id','=', $user_id)->get()->count();

        return $count_winner_exist;
    }
}
