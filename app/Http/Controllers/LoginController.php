<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('login');
        return view('index');
    }

    public function login(Request $request)
    {
        $userName = $request->userName;
        $password = $request->password;

        $user = User::where('name', $userName)->where('password', $password)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back()->withInput()->withError('Invalid Credentials.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.show.login-page');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
