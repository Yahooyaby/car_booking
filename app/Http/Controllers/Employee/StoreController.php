<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(EmployeeStoreRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $employee =Employee::create($data);

        if ($employee) {
            Auth::login($employee);
            $token = $employee->createToken('EmployeeToken')->plainTextToken;
        }

        return response()->json(['message' => 'Employee added successfully.', 'token' => $token]);
    }
}
