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

// Route::get('/', function () {

//     // return View::make('pages.home');

//     // if(session()->has('package_id')){

//     // }
//     // return view('auth.login');
//     // auth()->user()->assignRole('admin');
//   // $arr = [
//   //   'acceptedById'=>auth()->user()->id,
//   //   'notification_content'=>'Selamat akun anda telah aktif'
//   // ];

  

// });


// Route::get('/', function()
// {
//     return View::make('pages.home');
// });

// Route::post('/login', [
//     'uses'          => 'Auth\AuthController@login',
//     'middleware'    => 'checkstatus',
// ]);
// Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);



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




// Route::group(['prefix' => '/'], function()
// {
//     if ( Auth::check() ) // use Auth::check instead of Auth::user
//     {
//         Route::get('/', 'HomeController@index');
//     } else{
//         Route::get('/', 'HomeController@guest_index');
//     }
// });


// Route::get('/log', function () {
//     return view('log');
// });

// Route::get('ijin/', 'HomeController@kelolaIjin')->name('ijin');

// Auth::routes();

// Authentication Routes...
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm',
  'middleware'    => 'checkstatus'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login',
  'middleware'    => 'checkstatus'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

  // Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => '',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

  // Registration Routes...
Route::get('register', [
  'as' => 'register',
  'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
  'as' => '',
  'uses' => 'Auth\RegisterController@register'
]);


Route::get('/about', 'HomeController@about')->name('about');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notification_all', 'HomeController@allNotification')->name('allNotification');

Route::get('/bu/data_recap', 'buController@allRekapData')->name('allRekapData');
Route::get('/bu/new_file', 'buController@new_files_bu')->name('new_files');
Route::get('/bu/{id}/forward', 'buController@forward_files')->name('forward_files');

Route::get('/manageusers', 'UserController@fetch')->name('manageusers');
Route::get('/newapplicant', 'UserController@fetchnewapplicant')->name('newapplicant');

Route::get('/newapplicant/detail/{id}', 'UserController@detailAplicant')->name('detail_Aplicant');
Route::patch('/newapplicant/detail/{id}', 'UserController@acccept_applicant')->name('acccept_applicant');


//terampil submission route
Route::get('/submission/terampil/create', 'SubmissionController@createTerampil')->name('terampil_create');
Route::patch('/submission/terampil/create', 'SubmissionController@submitTerampil')->name('terampil_submit');


//ahli submission route
Route::get('/submission/ahli/create', 'SubmissionController@createAhli')->name('ahli_create');

// edit settings user
Route::get('/user/{id}/settings','UserController@settings')->name('user.settings');
Route::patch('/user/{id}/settings','UserController@edit')->name('user.edit');

Route::patch('/user/{id}/detailEditHapusManage','UserController@edit')->name('editData');

Route::get('read/{id}',function(){
      $id = auth()->user()->unreadNotifications[0]->id;
     auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
     return redirect('home');
})->name('readNotif');
