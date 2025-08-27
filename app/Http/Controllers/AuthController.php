<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginSubmit(Request $request)
    {
        // form validation
        $request->validate(
            [
                'text_username' => 'required | email',
                'text_password' => 'required |min:6|max:20',
            ],
            //error messages
            [
                'text_username.required' => 'O nome de usuário é obrigatório.',
                'text_username.email' => 'O nome de usuário deve ser um e-mail válido.',
                'text_password.required' => 'A senha é obrigatória.',
                'text_password.min' => 'A senha deve ter no mínimo :min caracteres',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres'
            ]

        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // check if user exists
        $user = User::where('email', $username)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Usuário e/ou senha incorreto(s).');
        }

        //check if password is correct
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'Usuário e/ou senha incorreto(s).');
        }

        //update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //login user
        session([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]

        ]);

        // redirect to home
        return redirect()->to('/');
    }

    public function logout()
    {
        //logout from the application
        session()->forget('user');
        return redirect()->to('/login');
    }
}
