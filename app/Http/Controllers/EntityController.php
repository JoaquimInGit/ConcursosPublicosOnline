<?php

namespace App\Http\Controllers;

use App\DataTables\EntityDataTable;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateEntityRequest;
//use App\Http\Requests\UpdateEntityRequest;
use App\Models\Entity;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class EntityController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Entity::class, 'entity');
    }

    /**
     * Display a listing of the Entity.
     *
     * @param EntityDataTable $entityDataTable
     * @return Response
     */
    public function index(EntityDataTable $entityDataTable)
    {
        return $entityDataTable->render('entities.index');
    }

    /**
     * Show the form for creating a new Entity.
     *
     * @return Response
     */
    public function create()
    {
        $entity = new Entity();
        $entity->loadDefaultValues();
        return view('entities.create', compact('entity'));
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

        if(($model = Entity::create($validatedAttributes)) ) {
            //flash(Entity saved successfully.');
            //Flash::success('Entity saved successfully.');
            return redirect(route('entities.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified Entity.
     *
     * @param  Entity  $entity
     * @return Response
     */
    public function show(Entity $entity)
    {
        return view('entities.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified Entity.
     *
     * @param  Entity $entity
     * @return Response
     */
    public function edit(Entity $entity)
    {
        return view('entities.edit', compact('entity'));
    }

    /**
     * Update the specified Entity in storage.
     *
     * @param  Request  $request
     * @param  Entity $entity
     * @return Response
     */
    public function update(Request $request, Entity $entity)
    {
        $validatedAttributes = $this->validateForm($request, $entity);
        $entity->fill($validatedAttributes);
        if($entity->save()) {
            //flash('Entity updated successfully.');
            //Flash::success('Entity updated successfully.');
            return redirect(route('entities.show', $entity));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified Entity from storage.
      *
      * @param  \App\Models\Entity  $entity
      * @return Response
      */
    public function destroy(Entity $entity)
    {
        $entity->delete();
        //Flash::success('Entity deleted successfully.');

        return redirect(route('entities.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, Entity $model = null): array
    {

        $validate_array = Entity::$rules;

        return $request->validate($validate_array, [], Entity::attributeLabels());
    }
}
