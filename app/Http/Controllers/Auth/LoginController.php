<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return string
     */
    protected function redirectTo()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        // Pastikan $user adalah instance Eloquent User
        if ($user && $user instanceof \App\Models\User) {
            if ($user->tokos()->exists()) {
                return route('my-products');
            }
        } else if ($user) {
            // Fallback: cari ulang user sebagai Eloquent
            $eloUser = \App\Models\User::find($user->id);
            if ($eloUser && $eloUser->tokos()->exists()) {
                return route('my-products');
            }
        }
        return '/products';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
