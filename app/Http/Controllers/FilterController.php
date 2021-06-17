<?php

namespace App\Http\Controllers;

use App\DataTables\FilterDataTable;
use App\Models\Contest;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateFilterRequest;
//use App\Http\Requests\UpdateFilterRequest;
use App\Models\Filter;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class FilterController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Filter::class, 'filter');
    }

    /**
     * Display a listing of the Filter.
     *
     * @param FilterDataTable $filterDataTable
     * @return Response
     */
    public function index(FilterDataTable $filterDataTable)
    {
        return $filterDataTable->render('filters.index');
    }

    /**
     * Show the form for creating a new Filter.
     *
     * @return Response
     */
    public function create()
    {
        $filter = new Filter();
        $filter->loadDefaultValues();
        return view('filters.create', compact('filter'));
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

        if(($model = Filter::create($validatedAttributes)) ) {
            //flash(Filter saved successfully.');
            //Flash::success('Filter saved successfully.');
            return redirect(route('filters.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified Filter.
     *
     * @param  Filter  $filter
     * @return Response
     */
    public function show(Filter $filter)
    {
        return view('filters.show', compact('filter'));
    }


    /**
     * Show the form for editing the specified Filter.
     *
     * @param  Filter $filter
     * @return Response
     */
    public function edit(Filter $filter)
    {
        return view('filters.edit', compact('filter'));
    }

    /**
     * Update the specified Filter in storage.
     *
     * @param  Request  $request
     * @param  Filter $filter
     * @return Response
     */
    public function update(Request $request, Filter $filter)
    {
        $validatedAttributes = $this->validateForm($request, $filter);
        $filter->fill($validatedAttributes);
        if($filter->save()) {
            //flash('Filter updated successfully.');
            //Flash::success('Filter updated successfully.');
            return redirect(route('filters.show', $filter));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified Filter from storage.
      *
      * @param  \App\Models\Filter  $filter
      * @return Response
      */
    public function destroy(Filter $filter)
    {
        $filter->delete();
        //Flash::success('Filter deleted successfully.');

        return redirect(route('filters.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, Filter $model = null): array
    {

        $validate_array = Filter::$rules;

        return $request->validate($validate_array, [], Filter::attributeLabels());
    }
}
