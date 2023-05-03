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
      'logout', 'dashboard', 'store', 'register'
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

    User::create([
      'name' => $request->name,
      'role' => $request->role,
      'password' => Hash::make($request->password)
    ]);

    return redirect()->route('admin.user.index')
      ->withSuccess('You have successfully registered');
  }

  /**
   * Display a login form.
   *
   * @return \Illuminate\Http\Response
   */
  public function login()
  {
    if (Auth::check()) {

      if (auth()->user()->role == 0) {
        return view('admin.index');
      } elseif (auth()->user()->role == 2) {
        return view('tastor.index');
      }
    }
    $users = User::all();
    return view('auth.login', compact('users'));
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
      'password' => 'required|string'
    ]);
    // dd(Auth::user());
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      if (auth()->user()->role == 0) {
        return redirect()->route('admin.index');
      } elseif (auth()->user()->role == 2) {
        return redirect()->route('tastor.index');
        // return redirect()->route('tastor.index');
      } elseif (auth()->user()->role == 1) {
        return back()->withErrors([
          'name' => 'Фукционала для технолога пока нет',
        ]);
      }
    }
    return back()->withErrors([
      'password' => 'Неверный пароль',
    ]);;
  }

  /**
   * Display a dashboard to authenticated users.
   *
   * @return \Illuminate\Http\Response
   */
  public function dashboard()
  {
    if (Auth::check()) {
      // return view('auth.dashboard');
      if (auth()->user()->role == 0) {
        return redirect()->route('admin.index');
      } elseif (auth()->user()->role == 2) {
        return redirect()->route('tastor.index');
      }
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
