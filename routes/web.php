<?php

use App\Http\Controllers\ContestFilterController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\subscribedUser;
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

Route::get('/orders/eupago-callback', [OrderController::class,'eupagoCallback'])->name('orders.eupago_callback');

Auth::routes(['verify' => true]);

//Route::get('/teste', [HomeController::class,'index'])->name('home');



Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/base', [BaseController::class,'insertContest2']);
Route::get('/basefiltro', [BaseController::class,'applyfilter']);
//Route::get('/filtros', [BaseController::class,'applyFilterToAllContests']);
Route::get('/mail', [BaseController::class,'filterNotification']);

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

    Route::get('/contests/{contest}/follow', [ContestController::class,'follow'])->name('contests.follow');
    Route::post('/contests/followdatatable', [ContestController::class,'followDatatable'])->name('contests.followDatatable');
    Route::resource('contests', App\Http\Controllers\ContestController::class)->middleware('subscribed');;

    Route::resource('entities', App\Http\Controllers\EntityController::class);

    Route::resource('filters', App\Http\Controllers\FilterController::class)->middleware('subscribed');

    Route::resource('products', App\Http\Controllers\ProductController::class)->middleware('can:adminFullApp');

    Route::post('/orders/generate-invoice/{order}', 'App\Http\Controllers\OrderController@generateInvoice')->name('orders.generate_invoice')->middleware('can:adminApp');
    Route::resource('orders', App\Http\Controllers\OrderController::class);

    Route::resource('contest_filters', App\Http\Controllers\ContestFilterController::class)->middleware('subscribed');
    /*Route::resource('testes', TesteController::class)->parameters([
        'testes' => 'teste'
    ]); //para escolher um parametro diferentes dava erro e em vez de teste estava a meter testis*/

});

// Quick search dummy route to display html elements in search dropdown (header search)
//Route::get('/pages/quick-search', 'PagesController@quickSearch')->name('quick-search');













Route::resource('products', App\Http\Controllers\ProductController::class);

Route::resource('orders', App\Http\Controllers\OrderController::class);

