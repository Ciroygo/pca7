<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    //
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
            session()->flash('success', '欢迎登录！');
            return redirect()->route('users.show', [Auth::user()]);
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
