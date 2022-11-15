<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Services\UserService;
use App\Models\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * Authenticate Login
     *
     * @param UserLoginRequest $request
     * @return View dashboard
     * @return View login with password error
     */
    public function authenticate(UserLoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();
        $auth = Auth::attempt(['email' => $user->email, 'password' => $request['password']]);

        if ($auth) {
            $request->session()->regenerate();
            Session::put('user', $user);
            $roles = $user->getRoleNames();
            $role = $roles[0];
            Session::put('role', $role);
            //need dashboard page
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors([
            'password' => 'Password tidak cocok.'
        ]);
    }

    /**
     * Store New User
     *
     * @param UserCreateRequest $request
     * @return View dashboard
     */
    public function store(UserCreateRequest $request)
    {
        User::create($request);
        //need dashboard page
        return redirect()->intended(route('menu-karyawan'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
