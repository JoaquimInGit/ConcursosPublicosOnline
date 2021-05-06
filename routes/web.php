<?php

use App\Http\Controllers\FilterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\BaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
    //return view('home');
    //return view('index');
});
Route::get('/', function () {
    return view('welcome');
    //return view('home');
    //return view('index');
});*/

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/base', [BaseController::class,'insertContest2']);
//only users autenticated and with email verified can access the following routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/api-upload', [HomeController::class,'apiUpload'])->name('home.api_upload');

    Route::get('/users', [UserController::class,'index'])->name('users.index');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::get('/users/get-users', [UserController::class,'getUsers'])->name('users.get_users');
    Route::get('/users/{user}', [UserController::class,'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class,'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class,'destroy'])->name('users.destroy');
    Route::delete('/users/{user}/delete', [UserController::class,'delete'])->name('users.delete');
    //Route::middleware('can:adminApp')->group(function () { // dava problemas no leave impersonation
        Route::impersonate();
    //});


    Route::resource('roles', RoleController::class)->middleware('can:adminFullApp');
    Route::patch('/roles/{role}/update-permissions', [RoleController::class,'updatePermissions'])->name('roles.update_permissions')->middleware('can:adminFullApp');
    Route::resource('permissions', PermissionController::class)->middleware('can:adminFullApp');

    Route::resource('settings', SettingController::class)->middleware('can:adminFullApp');
    //Route::resource('settings', SettingController::class)->middleware('can:viewAny,App\Models\Setting'); // não funciona porque vai aplicar sempre a mesma policy tinha que separar todas as routes

    Route::get('/contests', [ContestController::class,'index'])->name('contests.index');
    Route::post('/contests', [ContestController::class,'store'])->name('contests.store');
    Route::get('/contests/create', [ContestController::class,'create'])->name('contests.create');
    Route::get('/contests/{contest}', [ContestController::class,'show'])->name('contests.show');
    Route::get('/contests/{contest}/edit', [ContestController::class,'edit'])->name('contests.edit');

    Route::get('/entities', [EntityController::class,'index'])->name('entities.index');
    Route::post('/entities', [EntityController::class,'store'])->name('entities.store');
    Route::get('/entities/create', [EntityController::class,'create'])->name('entities.create');
    Route::get('/entities/{entity}', [EntityController::class,'show'])->name('entities.show');
    Route::get('/entities/{entity}/edit', [EntityController::class,'edit'])->name('entities.edit');

    Route::get('/filters', [FilterController::class,'index'])->name('filters.index');
    Route::post('/filters', [FilterController::class,'store'])->name('filters.store');
    Route::get('/filters/create', [FilterController::class,'create'])->name('filters.create');
    Route::get('/filters/{filter}', [FilterController::class,'show'])->name('filters.show');
    Route::get('/filters/{filter}/edit', [FilterController::class,'edit'])->name('filters.edit');

    /*Route::resource('testes', TesteController::class)->parameters([
        'testes' => 'teste'
    ]); //para escolher um parametro diferentes dava erro e em vez de teste estava a meter testis*/

});

// Quick search dummy route to display html elements in search dropdown (header search)
//Route::get('/pages/quick-search', 'PagesController@quickSearch')->name('quick-search');



Route::resource('entities', App\Http\Controllers\EntityController::class);

Route::resource('filters', App\Http\Controllers\FilterController::class);

Route::resource('contests', App\Http\Controllers\ContestController::class);