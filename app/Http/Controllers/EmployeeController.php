<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $employees = Employee::paginate(10);
        return view('employees.index', [
            'employees' => $employees,
        ]);
    }

    public function show($id) {
        $employee = Employee::findOrFail($id);
        return view('employees.show', ['employee' => $employee]);
    }

    public function create() {
        $companies = Company::pluck('name', 'id')->toArray();
        return view('employees.create', ['companies' => $companies]);
    }

    public function store() {
        $employee = new Employee();

        $validatedData = request()->validate([
            'first_name'=>'required|max:255', 
            'last_name'=>'required|max:255', 
            'email'=>'unique:employees|email|max:255', 
            'phone_number'=>'unique:employees|numeric', 
         ]);

        $employee->first_name = request('first_name');
        $employee->last_name = request('last_name');
        $employee->email = request('email');
        $employee->phone_number = request('phone_number');
        $employee->company_id = request('company_id');

        $employee->save();

        return redirect('/home') -> with('mssg', 'Employee has been added!');
    }

    public function destroy($id) {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect('/home') -> with('mssg', 'Employee has been deleted!');
    } 

    public function edit($id) {
        $employee = Employee::findOrFail($id);
        $companies = Company::pluck('name', 'id')->toArray();

        return view('employees.edit', ['employee' => $employee, 'companies' => $companies]);
    }
    
    public function update($id) {
        $validatedData = request()->validate([
            'first_name'=>'required|max:255', 
            'last_name'=>'required|max:255', 
            'email'=>'unique:employees|email|max:255', 
            'phone_number'=>'unique:employees|numeric', 
         ]);
        $data = request()->only(['first_name', 'last_name', 'email', 'phone_number', 'company_id']);
        Employee::where('id', $id)->update($data);
        $employee = Employee::findOrFail($id);
        return view('employees.show', ['employee' => $employee]);
    }
}
