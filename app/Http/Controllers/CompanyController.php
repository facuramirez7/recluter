<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the request
        $request->validate([
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png|max:4000',
            'description' => 'required|min:10'
        ]);

        $new_company = $request->all();

        /* Proceso de carga de logo */
        if ($logo = $request->file('photo')) {
            $rutaGuardarImg = 'img/companies'; /* Ruta donde se guarda dentro del servidor*/
            $logoCompany = time() . "." . $logo->getClientOriginalExtension(); /* Nomenclatura del archivo */
            $logo->move($rutaGuardarImg, $logoCompany);
            $new_company['photo'] = "$logoCompany";
        }

        Company::create($new_company);
        return redirect()->route('empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('admin.company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        //Valdate the request
        $request->validate([
            'name' => 'required',
            'photo' => 'image|mimes:jpeg,png|max:4000',
            'description' => 'required|min:10'
        ]);

        if (!is_null($request->photo)) {
            $update = $request->all();
            if ($logo = $request->file('photo')) {
                $path = 'img/companies'; /* Ruta donde se guarda dentro del servidor*/
                $logoCompany = time() . "." . $logo->getClientOriginalExtension(); /* Nomenclatura del archivo */
                if ($logo->move($path, $logoCompany)) {
                    $update['photo'] = "$logoCompany";
                    unlink('img/companies/' . $company->photo);
                }
            }
        } else {
            $update =  $request->only(['name', 'description']);
        }
        $company->update($update);
        return redirect()->route('empresas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);

        //delete photo path
        $img = public_path() . '/img/companies/' . $company->photo;
        if (@getimagesize($img)) {
            unlink($img);
        }

        $company->delete();

        return redirect()->route('empresas.index');
    }


    //create company for recluters
    public function recluter(Request $request)
    {
        return view('admin.company.recluter');
    }

    //store company for recluters
    public function recluter_store(Request $request)
    {
        //Validate the request
        $request->validate([
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png|max:4000',
            'description' => 'required|min:10',
            'user_id' => 'required'
        ]);

        $new_company = $request->all();

        /* Proceso de carga de logo */
        if ($logo = $request->file('photo')) {
            $rutaGuardarImg = 'img/companies'; /* Ruta donde se guarda dentro del servidor*/
            $logoCompany = time() . "." . $logo->getClientOriginalExtension(); /* Nomenclatura del archivo */
            $logo->move($rutaGuardarImg, $logoCompany);
            $new_company['photo'] = "$logoCompany";
        }

        $user = User::find($request->user_id);
        $comp = Company::create($new_company);        
        $user_update['company_id'] = $comp->id;
        $user->update($user_update);
        return redirect()->route('admin.dashboard');
    }
}
