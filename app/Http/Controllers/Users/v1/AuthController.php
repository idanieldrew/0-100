<?php

namespace App\Http\Controllers\Users\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(): array
    {
        $request = request();
        $user = User::query()
            ->where('email', $request->email)
            ->first();

        // Check exist user
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response_api(
                'error',
                Response::HTTP_UNAUTHORIZED,
                'invalid email or password',
                null
            );
        }

        $token = $user->createToken('test')->plainTextToken;

        return response_api(
            'success',
            Response::HTTP_OK,
            'Successfully login',
            ['user' => $user, 'token' => $token]
        );
    }
}
