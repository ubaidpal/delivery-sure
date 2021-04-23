<?php

namespace App\Http\Controllers\Auth;

use App\Referrer;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use Bican\Roles\Models\Permission;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository) {
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'welcomeMessage']]);
        $this->userRepository = $userRepository;

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'first_name'  => 'required|max:255',
            // 'last_name'   => 'required|max:255',
            'email'       => 'required|email|max:255|unique:users',
            'username'    => 'required|max:25|unique:users',
            // 'birth_year'  => 'required',
            //  'birth_month' => 'required',
            // 'birth_day'   => 'required',
            'password'    => 'required|min:6|confirmed',
            'referrer_id' => 'exists:users,username',
        ]);
    }

    public function register(Request $request) {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return redirect('register')->withInput($request->all())->withErrors($validator);
            /*$this->throwValidationException(
                $request, $validator
            );*/
        }

        $this->create($request->all());

        //return redirect($this->redirectPath());
        return redirect('login')->with('message', 'Please check your email for account activation!');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data) {
        //$username = slugify($data[ 'first_name' ], ['table' => 'users', 'field' => 'username']);

        $activation_code = str_random(60) . $data[ 'email' ];
        $user_type       = 1;

        if(isset($data[ 'user_type' ])) {
            $user_type = $data[ 'user_type' ];
        } else {
            $user_type = 100;
        }

        if($user_type == \Config::get('constant_settings.USER_TYPES.RETAILER')) {
            if(isset($data[ 'referrer_id' ]) && !empty($data[ 'referrer_id' ])) {
                $checkReferrer = $this->getReferrer($data[ 'referrer_id' ]);
                if(!$checkReferrer) {
                    return redirect('register')->withInput($data)->with('error', 'Referrer ID not match with our record');
                }
            }
        }
        $user = User::create([
            'first_name'      => $data[ 'first_name' ],
            //'last_name'       => $data[ 'last_name' ],
            'display_name'    => $data[ 'first_name' ],
            'username'        => $data[ 'username' ],
            'email'           => $data[ 'email' ],
            'activation_code' => $activation_code,
            'active'          => 0,
            'password'        => bcrypt($data[ 'password' ]),
            // 'dob'             => $data[ 'birth_year' ] . '-' . $data[ 'birth_month' ] . '-' . $data[ 'birth_day' ],
            'user_type'       => $user_type,
            'phone_number'    => $data[ 'phone_number' ],
            //'retailer_name'   => $data[ 'retailer_name' ],
        ]);

        $user->attachRole(\Config::get('constant_settings.USER_ROLES.' . $user_type));

        if($user_type == \Config::get('constant_settings.USER_TYPES.DELIVERY_MAN')) {
            $user->attachPermission(2);
        }
        if($user_type == \Config::get('constant_settings.USER_TYPES.RETAILER')) {

            $this->saveReferrer($user->id, $checkReferrer);

        }

        $this->sendEmail($user);
        return $user;
    }

    public function sendEmail(User $user) {

        $data = array(
            'name' => $user->first_name . ' ' . $user->last_name,
            'code' => $user->activation_code,
        );

        Mail::queue('emails.activateAccount', $data, function ($message) use ($user) {
            $message->subject('Account Activation: Please activate your account.');
            $message->to($user->email);
            $message->from("demedat@no-reply.com");
        });
    }

    public function resendEmail() {
        $user = \Auth::user();
        if($user->resent >= 5) {
            return view('auth.tooManyEmails')
                ->with('email', $user->email);
        } else {
            if($user->deleted == 1) {
                $activation_code       = str_random(60) . $user->email;
                $user->activation_code = $activation_code;
                $user->deleted         = 0;
            }

            $user->resent = $user->resent + 1;
            $dt           = Carbon::Now();
            $dt->addDays(30);

            $user->token_expiry_date = $dt;

            $user->save();
            $this->sendEmail($user);

            return view('auth.activateAccount')
                ->with('email', $user->email);
        }
    }

    public function activateAccount($code, User $user) {

        if($this->userRepository->accountIsActive($code)) {
            return redirect('/');
        }

        \Session::flash('message', \Lang::get('auth.unsuccessful'));

        return redirect('/');

    }

    public function userAlreadyRegistered(Request $request) {
        $data[ 'email' ] = $request->email;
        return view("auth.activateAccount", $data);
    }

    public function welcomeMessage() {
        return view('welcome');
    }

    public function authenticated(Request $request, $user) {
        if($user->active == 0) {
            $data = array(
                'name' => $user->first_name . ' ' . $user->last_name,
                'code' => $user->activation_code,
            );
            Mail::queue('emails.activateAccount', $data, function ($message) use ($user) {
                $message->subject('Account Activation: Please activate your account.');
                $message->to($user->email);
                $message->from("demedat@no-reply.com");
            });
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function postLogin(Request $request) {
        return $this->login($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if(Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request) {
        return redirect('login')
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    private function saveReferrer($id, $referrer_id) {

        $referrer = new Referrer();

        $referrer->user_id     = $id;
        $referrer->referrer_id = $referrer_id;
        $referrer->save();
        return TRUE;

    }

    private function getReferrer($referrer_id) {
        $referrerId = User::whereUsername($referrer_id)->first();
        if(!empty($referrerId)) {
            return $referrerId->id;
        } else {
            return FALSE;
        }
    }

}
