<?php

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
Route::get('/', ['middleware' => 'auth', 'uses' => 'HomeController@index']);


// Route::get('/', function()
// {
//     return View::make('pages.home');
// });

Route::get('/about', 'HomeController@about')->name('about');



// Route::get('about', function()
// {
//     return View::make('pages.about');
// });
Route::get('projects', function()
{
    return View::make('pages.projects');
});
Route::get('contact', function()
{
    return View::make('pages.contact');
});


// Route::get('/', function () {

//     return View::make('pages.home');

//     // if(session()->has('package_id')){
        
//     // }
//     // return view('auth.login');
//     // // auth()->user()->assignRole('admin');
// });

// Route::group(['prefix' => '/'], function()
// {
//     if ( Auth::check() ) // use Auth::check instead of Auth::user
//     {
//         Route::get('/', 'HomeController@index');
//     } else{
//         Route::get('/', 'HomeController@guest_index');
//     }
// });

Route::get('/main', function () {
    return view('home');
});

// Route::get('/log', function () {
//     return view('log');
// });

// Route::get('ijin/', 'HomeController@kelolaIjin')->name('ijin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
