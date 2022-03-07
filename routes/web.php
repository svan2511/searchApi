<?php

use App\Http\Controllers\SearchController;
use App\Models\Record;
use Illuminate\Support\Facades\Route;

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
Route::view('/','register',['title'=>'Welcome to Google search']);

Route::get('register', function()
{
    return view('register',['title'=>'Welcome to Google search']);
});

Route::get('login', [SearchController::class,'login']);
Route::post('auth',[SearchController::class,'auth_login']);
Route::post('register',[SearchController::class,'register_customer']);


Route::get('logout', function () {
    session()->forget('USER_LOGIN');
    session()->forget('USER_ID');
    session()->forget('USER_NAME');
    session()->flash('logoutMsg' ,'Logout Successfully ');
    return redirect('login');
});

Route::group(['middleware'=> 'admin_authCheck'],function()
{
    Route::get('search', [SearchController::class,'index']);
   
});
