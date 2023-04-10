<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'password' => 'required|min:3',
            'role' => 'required'
        ]);
        // dd($request->role);
        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('name', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'name' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('name');
    }

    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }

        return redirect()->route('login')
            ->withErrors([
                'name' => 'Please login to access the dashboard.',
            ])->onlyInput('name');
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }
}
