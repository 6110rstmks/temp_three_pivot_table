<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.registration_form');
    }

    /**
     * @param
     * @return void
     */
    public function register(Request $request)
    {

        // すでに登録済みのユーザ名があるかどうかというのはいらない,schema builderでunique()をつかっているため
        // if ($this->user->)

        // check password and password_cnf is match
        if ($request->password != $request->password_conf)
        {
            return back()->withErrors([
                'match_error' => 'password is not matched.',
            ]);
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = $request->only('username', 'password');


        if (Auth::attempt($credentials))
        {
            return redirect('categories');
        }


    }


}
