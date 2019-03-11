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


//admin
Route::get('/manage/informations/create', 'adminController@create_information')->name('create_information');
Route::patch('/manage/informations/create', 'adminController@submit_information')->name('submit_information');
Route::get('/manage/informations', 'adminController@manage_informations')->name('manage_informations');
Route::get('/manage/users', 'adminController@manage_users')->name('manage_users');



//home
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notification_all', 'HomeController@allNotification')->name('allNotification');


//bu
Route::get('/bu/data_recap', 'buController@allRekapData')->name('allRekapData');
Route::get('/bu/new_file', 'buController@new_files_bu')->name('new_files');
Route::get('/bu/{id}/forward', 'buController@forward_files')->name('forward_files');


//asesmen
Route::get('/asesmen/new_file', 'asesmenController@asesmen_new_file')->name('asesmen_new_file');
Route::get('/asesmen/{id}/forward', 'asesmenController@asesmen_forward_files')->name('asesmen_forward_files');
Route::get('/asesmen/data_recap', 'asesmenController@asesmen_all_recap')->name('asesmen_all_recap');

//jft
Route::get('/jft/new_file', 'jftController@jft_new_files')->name('jft_new_files');
Route::get('/jft/{id}/forward', 'jftController@jft_forward_files')->name('jft_forward_files');
Route::get('/jft/data_recap', 'jftController@jft_all_recap')->name('jft_all_recap');

//konseptor
Route::get('/konseptor/new_file', 'konseptorController@konseptor_new_files')->name('konseptor_new_files');
Route::patch('/konseptor/{id}/forward', 'konseptorController@konseptor_make_supeng')->name('konseptor_make_supeng');
Route::get('/konseptor/data_recap', 'konseptorController@konseptor_recap')->name('konseptor_recap');

//ketua tim
Route::get('/ketuatim/new_file', 'ketuaController@ketuatim_new_files')->name('ketuatim_new_files');
Route::get('/ketuatim/new_file/{id}/define_team', 'ketuaController@make_team_for')->name('make_team_for');
Route::patch('/ketuatim/new_file/{id}/define_team', 'ketuaController@define_teams')->name('define_teams');

//tim penilai

Route::get('/timpenilai/new_file', 'penilaiController@timpenilai_new_files')->name('timpenilai_new_files');
Route::get('/timpenilai/new_file/{id}/detail', 'penilaiController@detail_penilaian')->name('detail_penilaian');
Route::patch('/timpenilai/new_file/{id}/detail', 'penilaiController@submit_individual_score')->name('submit_individual_score');
Route::get('/timpenilai/final', 'penilaiController@define_final_score')->name('define_final_score');
Route::get('/timpenilai/final/{id}/detail', 'penilaiController@detail_penilaian_final')->name('detail_penilaian_final');
Route::patch('/timpenilai/final/{id}/detail', 'penilaiController@submit_final_score')->name('submit_final_score');


//kesekretariatan
Route::get('/kesekretariatan/new_file', 'sekretariatController@kesekretariatan_new_file')->name('kesekretariatan_new_file');
Route::get('/kesekretariatan/new_file/{id}/verify', 'sekretariatController@sekretariat_verifications')->name('sekretariat_verifications');
Route::patch('/kesekretariatan/new_file/{id}/verify', 'sekretariatController@sekretariat_verify_files')->name('sekretariat_verify_files');
Route::get('/kesekretariatan/data_recap', 'sekretariatController@sekretariat_recap_files')->name('sekretariat_recap_files');
Route::patch('/kesekretariatan/new_file/{id}/reject', 'sekretariatController@sekretariat_reject')->name('sekretariat_reject');

//tu kepeg
Route::get('/tu/data_recap', 'tuController@tu_recap_files')->name('tu_recap_files');
Route::get('/tu/new_file', 'tuController@new_files_tu')->name('tu_new_file');
Route::get('/tu/new_file/{id}/verify', 'tuController@tu_verification_files')->name('tu_verification_files');
Route::patch('/tu/new_file/{id}/verify', 'tuController@verify_file_disposition')->name('verify_file_disposition');
Route::patch('/tu/new_file/{id}/disposition', 'tuController@tu_disposition')->name('tu_disposition');
Route::patch('/tu/new_file/{id}/reject', 'tuController@tu_reject')->name('tu_reject');



//user / verificator
Route::get('/newapplicant', 'UserController@fetchnewapplicant')->name('newapplicant');
Route::get('/information/{id}', 'UserController@detail_information')->name('detail_information');
Route::get('/newapplicant/detail/{id}', 'UserController@detailAplicant')->name('detail_Aplicant');
Route::patch('/newapplicant/detail/{id}', 'UserController@acccept_applicant')->name('acccept_applicant');


//terampil submission route
Route::get('/submission/terampil/create', 'SubmissionController@createTerampil')->name('terampil_create');
Route::patch('/submission/terampil/create', 'SubmissionController@submitTerampil')->name('terampil_submit');

Route::get('/submission/saved', 'SubmissionController@submission_saved')->name('submission_saved');
Route::patch('/submission/saved/{id}', 'SubmissionController@save_or_submit_fromSaved')->name('save_or_submit_fromSaved');
Route::get('/submission/saved/{id}/detail', 'SubmissionController@detail_saved')->name('detail_saved');
Route::delete('/submission/saved/administration/{id}/delete', 'SubmissionController@delete_saved_administration')->name('delete_saved_administration');
Route::delete('/submission/saved/item/{id}/delete', 'SubmissionController@delete_saved_item')->name('delete_saved_item');


//ahli submission route
Route::get('/submission/ahli/create', 'SubmissionController@createAhli')->name('ahli_create');

// edit settings user
Route::get('/user/{id}/settings','UserController@settings')->name('user.settings');
Route::patch('/user/{id}/settings','UserController@edit')->name('user.edit');
Route::get('/submission/history', 'UserController@fetch_history')->name('fetch_history');
Route::get('/submission/history/{id}', 'UserController@fetch_history_detail')->name('fetch_history_detail');
Route::patch('/submission/history/{id}', 'UserController@save_or_submit_fromHistory')->name('save_or_submit_fromHistory');


Route::patch('/user/{id}/detailEditHapusManage','UserController@edit')->name('editData');

Route::get('read/{id}',function(){
      $id = auth()->user()->unreadNotifications[0]->id;
     auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
     return redirect('home');
})->name('readNotif');
