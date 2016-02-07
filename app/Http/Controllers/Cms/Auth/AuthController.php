<?php

namespace App\Http\Controllers\Cms\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;

class AuthController extends Controller
{
    use RedirectsUsers;

    protected $redirectPath = 'cms/dashboard';

    protected $loginPath = 'cms/login';

    public function __construct() 
    {    
        $this->middleware('guest', ['except' => ['destroy']]);   
        parent::__construct();
    }

    public function index() 
    {
        return view('cms.auth.login');
    }

    public function store(Request $request) 
    {
        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        if (!Auth::attempt($request->only('email', 'password')) || !Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect($this->loginPath())
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => $this->getFailedLoginMessage(),
                ]);
        }

        return redirect()->intended($this->redirectPath());

    }

    public function destroy() 
    {
        Auth::logout();

        return redirect(route('cms.login_path'));
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    private function loginPath()
    {
        return property_exists($this, 'loginPath') ? $this->loginPath : '/auth/login';
    }

    private function getFailedLoginMessage()
    {
        return \Lang::has('auth.failed')
                ? \Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }
}
