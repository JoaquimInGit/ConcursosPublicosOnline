<?php

namespace App\Http\Controllers;

use App\DataTables\ContestDataTable;
use App\Models\ContestEntity;
use App\Models\Entity;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateContestRequest;
//use App\Http\Requests\UpdateContestRequest;
use App\Models\Contest;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ContestController extends Controller
{
    /**
     * Display a listing of the Contest.
     *
     * @param ContestDataTable $contestDataTable
     * @return Response
     */
    public function index(ContestDataTable $contestDataTable,Request $request)
    {
        //return $contestDataTable->render('contests.index');
        return $request->isMethod('post') ? $this->create($request) : $contestDataTable->render('contests.index');
        /*$contests = DB::table('contests')->get();
        return view('contests.index', ['contests' => $contests]);*/
    }

    /**
     * Show the form for creating a new Contest.
     *
     * @return Response
     */
    public function create()
    {
        $contest = new Contest();
        $contest->loadDefaultValues();
        return view('contests.create', compact('contest'));
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

        if(($model = Contest::create($validatedAttributes)) ) {
            //flash(Contest saved successfully.');
            //Flash::success('Contest saved successfully.');
            return redirect(route('contests.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified Contest.
     *
     * @param  Contest  $contest
     * @return Response
     */
    public function show(Contest $contest)
    {
        //recebe a entidade do user autenticado
        $entity = Entity::getCurrentEntity();

        //se o user tiver permissões de acesso de user
        if(auth()->user()->can('accessAsUser')){
            //recebe se existir o registo entre contest e entidade
            $contestentity = ContestEntity::getRegisto($contest,$entity);
            if(!$contestentity->exists()){
                //se não existir então cria um registo
                ContestEntity::create([
                    'contest_id' =>  $contest->id,
                    'entity_id' => $entity->id,
                ]);
            }else{
                //se existir então atualiza a hora de visualização
                $contestentity->update([
                    'viewed_at' => Carbon::now(),
                ]);
            }
        }
        $contestentity = ContestEntity::getRegisto($contest,$entity)->first();
        return view('contests.show', compact('contest','contestentity'));
    }

    /**
     * Follow the specified Contest.
     *
     * @param  Contest  $contest
     * @return Response
     */
    public static function follow(Contest $contest)
    {
        //recebe a entidade do user autenticado
        $entity = Entity::getCurrentEntity();

        //se o user tiver permissões de acesso de user
        if(auth()->user()->can('accessAsUser')){
            //recebe se existir o registo entre contest e entidade
            $valor = ContestEntity::getRegisto($contest,$entity);
            if(!$valor->exists()){
                //se não existir então cria um registo
                ContestEntity::create([
                    'contest_id' =>  $contest->id,
                    'entity_id' => $entity->id,
                    'follow' => 1,
                ]);
            }else{
                //se existir altera o valor no atributo follow(segue(1) e não segue(0))
                $contestentity = ContestEntity::getRegisto($contest,$entity)->first();
                if ($contestentity->follow == '0'){
                    $contestentity->update([
                        'follow' => 1,
                    ]);
                }else{
                    $contestentity->update([
                        'follow' => 0,
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified Contest.
     *
     * @param  Contest $contest
     * @return Response
     */
    public function edit(Contest $contest)
    {
        return view('contests.edit', compact('contest'));
    }

    /**
     * Update the specified Contest in storage.
     *
     * @param  Request  $request
     * @param  Contest $contest
     * @return Response
     */
    public function update(Request $request, Contest $contest)
    {
        $validatedAttributes = $this->validateForm($request, $contest);
        $contest->fill($validatedAttributes);
        if($contest->save()) {
            //flash('Contest updated successfully.');
            //Flash::success('Contest updated successfully.');
            return redirect(route('contests.show', $contest));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified Contest from storage.
      *
      * @param  \App\Models\Contest  $contest
      * @return Response
      */
    public function destroy(Contest $contest)
    {
        $contest->delete();
        //Flash::success('Contest deleted successfully.');

        return redirect(route('contests.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, Contest $model = null): array
    {

        $validate_array = Contest::$rules;

        return $request->validate($validate_array, [], Contest::attributeLabels());
    }
}
