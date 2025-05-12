<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\users\Manager;
use Illuminate\Support\Facades\Hash;

class AuthControllerrs extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/");
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|unique:managers,name',
                "password" => "required|min:6",
                "password_confirmation" => "required|same:password"
            ]);
    
            if($request->password !== $request->password_confirmation ){
                return back()->withErrors("Password comfirmation not macth");
            }
    
            $model = new Manager();
            $model->name = $request->name;
            $model->password = Hash::make($request->password);
            
            $result = $model->save();

            if(!$result){
                return back()->withErrors("Error in registering");
            }
            return redirect("/login")->with("message", "Registration sucessfull");
    
        } catch (\Exception $e) {

            return back()->withErrors($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}