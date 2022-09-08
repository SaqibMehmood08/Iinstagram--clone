<?php
use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|-+
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Auth::routes();
// emails route



// vue follow
Route::post('follow/{user}','App\Http\Controllers\FollowsController@store');
//show posts you are following on login 
Route::get('/','App\Http\Controllers\PostsController@index');

//show image on new page

Route::get('/p/create','App\Http\Controllers\PostsController@create');

//image post to new page for lookup
Route::get('/p/{post}','App\Http\Controllers\PostsController@show');
//end


Route::post('/p','App\Http\Controllers\FollowsController@store');

Route::get('/profile/{user}', [App\Http\Controllers\profileController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\profileController::class, 'edit'])->name('profile.edit');
//update
Route::patch('/profile/{user}', [App\Http\Controllers\profileController::class, 'update'])->name('profile.update');

Route::get('/email',function(){
    return new NewUserWelcomeMail();
});