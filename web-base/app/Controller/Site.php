<?php

namespace Controller;

use Illuminate\Database\Capsule\Manager as DB;
use Model\Post;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\View;
class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }
    public function hello()
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if($request->method==='POST' && User::create($request->all())){
            app()->route->redirect('/go?id=1');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if($request->method=== 'GET')
        {
            return new View('site.login');
        }

        if(Auth::attempt($request->all()))
        {
            app()->route->redirect('/hello');
        }

        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}
