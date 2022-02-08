<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companie;
use Illuminate\Support\Facades\Storage;

class CompanieController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $companie = Companie::all();
        return view('companie.index')
        ->with('companies', $companie);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('companie.create');
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
            'name' => 'required',
            'logo' => 'required|file',
            'email' => 'required|email|unique:companies',
            'website' => 'required|unique:companies',
        ],
        [
            'email.unique' => "Ya hay una empresa registrado con este correo",
            'website.unique' => "Ya hay una empresa registrado con este website"
            ]
        );

        if($request->hasFile('logo')) {
            $file = time().'.'.$request->logo->extension();
            $path = $request->file('logo')->storeAs('public', $file);

        }
        $companie = new Companie;
        $companie->name     = $request->get('name');
        $companie->logo     = $file;
        $companie->email    = $request->get('email');
        $companie->website = $request->get('website');

        if($companie->save()) {
            return redirect('company')->with('status', 'Empresa <strong>'.$companie->name .'</strong> Adicionado con Exito!');
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
        $companie = Companie::find($id);
        return view('companie.show')->with('companie', $companie);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $companie = Companie::find($id);
        return view('companie.edit')->with('companie', $companie);
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
            'name' => 'required',
            'logo' => 'required|file',
            'email' => "required|email|unique:companies,email,{$id}",
            'website' => "required|unique:companies,website,{$id}",
        ],
        [
            'email.unique' => "Ya hay una empresa registrado con este correo",
            'website.unique' => "Ya hay una empresa registrado con este website"
            ]
        );

        if($request->hasFile('logo')) {
            $file = time().'.'.$request->logo->extension();
            $path = $request->file('logo')->storeAs('public', $file);
        }

        $companie = Companie::find($id);
        $companie->name     = $request->get('name');
        $companie->logo     = $file;
        $companie->email    = $request->get('email');
        $companie->website = $request->get('website');

        if($companie->save()) {
            return redirect('company')->with('status', 'Empresa <strong>'.$companie->name .'</strong> Actualizado con Exito!');
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
        try{
            $companie = Companie::find($id);
            if($companie->delete()) {
                return redirect('company')->with('status', 'Empresa <strong>'.$companie->name .'</strong> Eliminado con Exito!');
            }
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('company')->with('error', 'Empresa <strong>'.$companie->name .'</strong> No puede ser eliminada!');
        }
    }
}
