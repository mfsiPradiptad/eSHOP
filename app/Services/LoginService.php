<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginService
{
    public function login(array $data): array
    {
        $error = 10;
        $validator = Validator::make(
            $data,
            [
                'email' => 'bail|required',
                'password' => 'required|min:8|max:16',
            ]
        );

        $role = $data['role'];

        if ($validator->fails()) {
            $error = 1;
        } else {

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => $role])) {
                $error = 0;
            }
        }

        return array(
            'error' => $error,
            'role' => $role
        );
    }

    public function signUpUser(array $data): string
    {
        $validator = Validator::make(
            $data,
            [
                'email' => 'bail|required',
                'password' => 'required|min:8|max:16',
                'name' => 'required'
            ]
        );

        if ($validator->fails()) {
            $msg = 'Some error occured';
        } else {
            $name = $data['name'];
            $email = $data['email'];
            $role = 7;
            $password = Hash::make($data['password']);

            try {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                ]);
                $msg = "Succefully Registred.";
            } catch (\Throwable $e) {
                $exception = $e->getMessage();
                Log::info('Error at sign up: ' . $exception);
                $msg = "Some error occured.";
            }
        }

        return $msg;
    }
}
