<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('employees')
                ->select('name', 'email', 'department', 'phone', 'salary')
                ->get();
            return datatables()->of($data)->make(true);
        }

        $employees = Employee::all();
        $names = $employees->sortBy('name')->pluck('name')->unique();
        $departments = $employees->sortBy('department')->pluck('department')->unique();

        return view('employee.index', compact('names', 'departments'));
    }

    public function ajax()
    {
        
    }
}