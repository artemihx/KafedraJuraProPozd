<?php

namespace Controller;

use Model\Post;
use Model\Product;
use Model\User;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class Api
{
    public function index(): void
    {
        $posts = Post::all()->toArray();

        (new View())->toJSON($posts);
    }

    public function echo(Request $request): void
    {
        (new View())->toJSON($request->all());
    }

    public function signup(Request $request): void
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login', 'email'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'email' => 'Поле :field должно быть email'
            ]);

            if($validator->fails()){
                (new View())->toJSON(['errors' => $validator->errors()]);
            }

            if (User::create($request->all())) {
                (new View())->toJSON(['message' => 'Вы успешно зарегистрировались!']);
            }
        }
    }


    public function login(Request $request): void
    {
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'login' => ['required'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
            ]);

            if ($validator->fails()) {
                (new View())->toJSON(['errors' => $validator->errors()]);
            }

            if (Auth::attempt($request->all())) {
                (new View())->toJSON(['message' => 'Вы успешно авторизовались!']);
            }
            else
            {
                (new View())->toJSON(['message' => 'Неверный логин или пароль']);
            }
        }
    }

    public function products(Request $request): void
    {
        $products = Product::all()->toArray();
        (new View())->toJSON($products);
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        (new View())->toJSON(['message' => 'Вы вышли!']);

    }
}
