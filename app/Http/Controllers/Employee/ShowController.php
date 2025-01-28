<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;

class ShowController extends Controller
{
    public function __invoke(int $id)
    {
        $employee = Employee::with(['position'])->findOrFail($id);

        return new EmployeeResource($employee);
    }
}
