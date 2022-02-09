<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Companie;


class EmployeeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {

        $employee = Employee::select('employees.*', 'companies.name as nombre_empresa')->
        join('companies', 'employees.company', '=', 'companies.id')->
        paginate(10)->setPath('employee');
        return view('employee.index')
        ->with('employees', $employee);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $companies = Companie::all();
        return view('employee.create')
        ->with('companies', $companies);

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'phone' => 'required',
            'company' => 'required',
        ],
        [
            'email.unique' => "Ya hay un empleado registrado con este correo"
            ]
        );

        $employee = new Employee;
        $employee->first_name     = $request->get('first_name');
        $employee->last_name     = $request->get('last_name');
        $employee->email    = $request->get('email');
        $employee->phone = $request->get('phone');
        $employee->company = $request->get('company');

        if($employee->save()) {
            return redirect('employee')->with('status', 'Empleado <strong>'.$employee->first_name .' '. $employee->last_name .'</strong> Adicionado con Exito!');
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show')->with('employee', $employee);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $companies = Companie::all();

        return view('employee.edit')
        ->with('companies', $companies)
        ->with('employee', $employee);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|email|unique:employees,email,{$id}",
            'phone' => 'required',
            'company' => 'required',
        ],
        [
            'email.unique' => "Ya hay un empleado registrado con este correo"
            ]
        );

        $employee = Employee::find($id);
        $employee->first_name     = $request->get('first_name');
        $employee->last_name     = $request->get('last_name');
        $employee->email    = $request->get('email');
        $employee->phone = $request->get('phone');
        $employee->company = $request->get('company');

        if($employee->save()) {
            return redirect('employee')->with('status', 'Empleado <strong>'.$employee->first_name .' '. $employee->last_name .'</strong> Actualizado con Exito!');
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        if($employee->delete()) {
            return redirect('employee')->with('status', 'Empleado <strong>'.$employee->first_name .' '. $employee->last_name.'</strong> Eliminado con Exito!');
        }
    }
}
