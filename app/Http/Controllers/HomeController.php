<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //flash('Message1')->overlay()->error();
        //flash('Message2')->overlay()->warning();
        //flash('Message3')->error()->important();
        return view('home.home');
    }

    /**
     * handle the upload of a file
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiUpload(Request $request){
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'file' => 'required|file|max:10240'
        ]);
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $path = $request->file('file')->store('public/uploads');
        $file = $request->file('file');
        $url = Storage::url($path);

        return response()->json([
            'success' => true,
            'name'          => $path,
            'original_name' => $file->getClientOriginalName(),
            'url' => $url
        ]);
    }
}
