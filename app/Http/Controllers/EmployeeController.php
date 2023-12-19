<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use App\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Employees = Employee::all();
       
        if(count($Employees) > 0)
        {
            $Employees = Employee::get()->toQuery()->paginate(10, ['*'], 'page', 1);
        }
        $Companies = Company::all();
        return view('Employees.index',compact('Employees', 'Companies'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreEmployee $request)
    {
        try {
            $validated = $request->validated();
            $Employees = new Employee();
            $Employees->firstname = $request->firstname;
            $Employees->lastname = $request->lastname;
            $Employees->company_id = $request->company_id;
            $Employees->email       = $request->email;
            $Employees->phone      = $request->phone;

            $Employees->save();
            return redirect()->route('Employees.index')->with('message','Data added Successfully');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(StoreEmployee $request)
    {
        try {

            $Employees = Employee::findOrFail($request->id);
            $Employees->firstname = $request->firstname;
            $Employees->lastname = $request->lastname;
            $Employees->company_id = $request->company_id;
            $Employees->email       = $request->email;
            $Employees->phone      = $request->phone;
            $Employees->save();

            return redirect()->route('Employees.index')->with('info','Data update Successfully');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $Employees = Employee::findOrFail($request->id)->delete();
        return redirect()->route('Employees.index')->with('warning','Data delete Successfully');

    }



}
