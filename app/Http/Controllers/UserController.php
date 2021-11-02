<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Services\LoginService;

class UserController extends Controller
{
    public  $loginService;

    public function __construct()
    {
        $this->loginService = new LoginService();
    }
    public function login(Request $request)
    {
        $data = (array) $request->all();
        $dto = $this->loginService->login($data);

        if ($dto['error'] == 0) {
            if ($dto['role'] == 1) {
                return redirect('/productList');
            } else {
                return redirect('/home');
            }
        } else {
            return view('user.userLogin', ['msg' => 'Email or password is not correct.']);
        }
    }


    public function register(Request $request)
    {
        $data = (array) $request->all();
        $msg = $this->loginService->signUpUser($data);

        return view('user.register', ['msg' => $msg]);
    }


    public function logOut()
    {
        Auth::logout();
        return redirect('/home');

    }
}
