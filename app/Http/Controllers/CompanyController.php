<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $Companies = Company::all();
        if(count($Companies) > 0)
        {
            $Companies = Company::get()->toQuery()->paginate(10, ['*'], 'page', 1);
        }
        return view('Companies.index',compact('Companies'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(StoreCompany $request)
    {
        try {
            $validated = $request->validated();
            $Companies = new Company();
            $Companies->name = $request->name;
            $Companies->email = $request->email;
            $Companies->website = $request->website;
            if($request->file('logo'))
           { 
               $Companies->logo = "http://localhost:8000/storage/app/public/".$request->file('logo')->getClientOriginalName();
                $request->file('logo')->move('storage/app/public/', $Companies->logo);
            }

            $Companies->save();
            return redirect()->route('Companies.index')->with('message','Data added Successfully');
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
    public function update(StoreCompany $request)
    {
        try {

            $Companies = Company::findOrFail($request->id);
            $Companies->name = $request->name;
            $Companies->email = $request->email;
            $Companies->website = $request->website;
            if($request->file('logo'))
           { 
               $Companies->logo = "http://localhost:8000/storage/app/public/".$request->file('logo')->getClientOriginalName();
                $request->file('logo')->move('storage/app/public/', $Companies->logo);
            }
            $Companies->save();

            return redirect()->route('Companies.index')->with('info','Data update Successfully');
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
        $Companies = Company::findOrFail($request->id)->delete();
        return redirect()->route('Companies.index')->with('warning','Data delete Successfully');

    }



}
