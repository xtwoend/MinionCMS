<?php

namespace Minion\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Minion\Entities\User;
use Minion\Http\Controllers\Controller;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the Application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your Applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * [$users description]
     * @var [type]
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->users = $users;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider, Request $request)
    {
        $driver = Socialite::driver($provider);
        if($request->has('scope')){
            $scope = (array) explode(',', $request->scope);
            $driver = $driver->scopes($scope);
        }
        return $driver->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider, Request $request)
    {
        $user = Socialite::driver($provider)->user();
        $token = $user->token;
        $user_id = $user->getId();
        $nickname = $user->getNickname();
        $fullname = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();

        if(is_null($email) || $email == '') return redirect()->to('/login')->withError('Information user not complate');

        try {
            $userLocal = $this->users->whereEmail($email)->firstOrFail();
            Auth::login($userLocal);

        } catch (\Exception $e) {
            $newUser = $this->users->create([
                'name' => $fullname,
                'email' => $email,
                'status' => 1,
                'password' => bcrypt(str_random(6)),
            ]);

            $newUser->assignRole('user');
            
            Auth::login($newUser);
        }

        return redirect()->intended($this->redirectTo);
    }       
}
