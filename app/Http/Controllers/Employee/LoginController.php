<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(EmployeeLoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = Auth::user()->createToken('EmployeeToken')->plainTextToken;

            return response()->json([
                'message' => 'Logged in successfully.',
                'token' => $token,
            ]);
        }

        return response()->json(['message' => 'Invalid login credentials.']);
    }
}
