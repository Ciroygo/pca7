<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    public function create()
    {
        return view('sessions.create');
    }


    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:25',
            'password' => 'required'
        ]);

        if (Auth::Attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->activated) {
                session()->flash('success', '欢迎登录！');
                return redirect()->intended(route('users.show', [Auth::user()]));
            } else {
                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
               return redirect('/');
            }

        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不相符');
            return redirect()->back();
        }
    }


    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '成功退出');
        return redirect('login');
    }
}
