<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginFormRequest;
use illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     *
     * @param void
     * @return View
     *
     */
    public function showLogin()
    {
        return view('auth.login_form');
    }

    /**
     *
     * @param App\Http\Request\LoginFormRequest $request
     * @return
     */

    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('username', 'password');

        // $remember_me = $request->input('remember_me');

        $remember_me = $request->has('remember_me') ? true : false;


        // ユーザの一レコードの値を取得。
        $user = $this->user->getUser($credentials['username']);

        Log::debug($user);

        // ユーザがあるかどうか
        if ($user != false)
        {
            // アカウントがロックされたら弾く処理
            if ($this->user->isAccountLocked($user))
            {
                return back()->withErrors([
                    'login_error' => 'account is being locked.'
                ]);
            }

            if (Auth::attempt($credentials, $remember_me))
            {
                // session hijacking countermeasure
                $request->session()->regenerate();

                // ログインに成功したらエラーアカウントを0にする（次回のログイン時にまた使えるようにするため）
                if ($user->error_count > 0)
                {
                    $user->error_count = 0;
                    $user->save();
                }

                // recipehouseへ移動
                return redirect('categories');
                // return redirect()->route('posts.index');
            }

            // ログインに失敗したらエラーカウントを1増やす
            $user->error_count = $this->user->addErrorCount($user->error_count);

            // エラーの回数が６回を超えたらロックをかける
            // エラー回数の仕様が変更されることを考慮して定数にしてもいいな

            if ($this->user->lockAccount($user))
            {
                $user->locked_flg = 1;
                $user->save();
                return back()->withErrors([
                    'login_error' => 'account is being locked. if you unlock, please contact administrator.'
                ]);
            }
            $user->save();
        }

        // if username or password are wrong, redirect to back page.
        return back()->withErrors([
            'login_error' => 'mail address or password is incorrect'
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \IlluminateHttp\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        // これの意味を理解したい。

        $request->session()->regenerateToken();

        return redirect()->route('showLogin')->with('logout_msg', 'logout is done.');
    }
}
