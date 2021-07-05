<?php

namespace App\Http\Controllers;

use App\DataTables\ContestFilterDataTable;
use App\Models\Contest;
use App\Models\Filter;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateContestFilterRequest;
//use App\Http\Requests\UpdateContestFilterRequest;
use App\Models\ContestFilter;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class ContestFilterController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ContestFilter::class, 'contest_filters');
    }

    /**
     * Display a listing of the ContestFilter.
     *
     * @param ContestFilterDataTable $contestFilterDataTable
     * @return Response
     */
    public function index(ContestFilterDataTable $contestFilterDataTable)
    {

        return $contestFilterDataTable->render('contest_filters.index');
    }

    /**
     * Show the form for creating a new ContestFilter.
     *
     * @return Response
     */
    public function create()
    {
        $contestFilter = new ContestFilter();
        $contestFilter->loadDefaultValues();
        return view('contest_filters.create', compact('contestFilter'));
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

        if(($model = ContestFilter::create($validatedAttributes)) ) {
            //flash(Contest Filter saved successfully.');
            //Flash::success('Contest Filter saved successfully.');
            return redirect(route('contest-filters.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified ContestFilter.
     *
     * @param  ContestFilter  $contestFilter
     * @return Response
     */
    public function show(ContestFilter $contestFilter)
    {
        return view('contest_filters.show', compact('contestFilter'));
    }

    /**
     * Show the form for editing the specified ContestFilter.
     *
     * @param  ContestFilter $contestFilter
     * @return Response
     */
    public function edit(ContestFilter $contestFilter)
    {
        return view('contest_filters.edit', compact('contestFilter'));
    }

    /**
     * Update the specified ContestFilter in storage.
     *
     * @param  Request  $request
     * @param  ContestFilter $contestFilter
     * @return Response
     */
    public function update(Request $request, ContestFilter $contestFilter)
    {
        $validatedAttributes = $this->validateForm($request, $contestFilter);
        $contestFilter->fill($validatedAttributes);
        if($contestFilter->save()) {
            //flash('Contest Filter updated successfully.');
            //Flash::success('Contest Filter updated successfully.');
            return redirect(route('contest-filters.show', $contestFilter));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified ContestFilter from storage.
      *
      * @param  \App\Models\ContestFilter  $contestFilter
      * @return Response
      */
    public function destroy(ContestFilter $contestFilter)
    {
        $contestFilter->delete();
        //Flash::success('Contest Filter deleted successfully.');

        return redirect(route('contest-filters.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, ContestFilter $model = null): array
    {

        $validate_array = ContestFilter::$rules;

        return $request->validate($validate_array, [], ContestFilter::attributeLabels());
    }
}
