<?php

namespace App\Http\Controllers;

use App\DataTables\ConcursosDataTable;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateConcursosRequest;
//use App\Http\Requests\UpdateConcursosRequest;
use App\Models\Concursos;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class ConcursosController extends Controller
{
    /**
     * Display a listing of the Concursos.
     *
     * @param ConcursosDataTable $concursosDataTable
     * @return Response
     */
    public function index(ConcursosDataTable $concursosDataTable)
    {
        return $concursosDataTable->render('concursos.index');
    }

    /**
     * Show the form for creating a new Concursos.
     *
     * @return Response
     */
    public function create()
    {
        $concursos = new Concursos();
        $concursos->loadDefaultValues();
        return view('concursos.create', compact('concursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateForm($request);

        if(($model = Concursos::create($validatedAttributes)) ) {
            //flash(Concursos saved successfully.');
            //Flash::success('Concursos saved successfully.');
            return redirect(route('concursos.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified Concursos.
     *
     * @param  Concursos  $concursos
     * @return Response
     */
    public function show(Concursos $concursos)
    {
        return view('concursos.show', compact('concursos'));
    }

    /**
     * Show the form for editing the specified Concursos.
     *
     * @param  Concursos $concursos
     * @return Response
     */
    public function edit(Concursos $concursos)
    {
        return view('concursos.edit', compact('concursos'));
    }

    /**
     * Update the specified Concursos in storage.
     *
     * @param  Request  $request
     * @param  Concursos $concursos
     * @return Response
     */
    public function update(Request $request, Concursos $concursos)
    {
        $validatedAttributes = $this->validateForm($request, $concursos);
        $concursos->fill($validatedAttributes);
        if($concursos->save()) {
            //flash('Concursos updated successfully.');
            //Flash::success('Concursos updated successfully.');
            return redirect(route('concursos.show', $concursos));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified Concursos from storage.
      *
      * @param  \App\Models\Concursos  $concursos
      * @return Response
      */
    public function destroy(Concursos $concursos)
    {
        $concursos->delete();
        //Flash::success('Concursos deleted successfully.');

        return redirect(route('concursos.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, Concursos $model = null): array
    {

        $validate_array = Concursos::$rules;

        return $request->validate($validate_array, [], Concursos::attributeLabels());
    }
}
