<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Unit;
use App\sk;
use App\pkPosition;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Webpatser\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
//     protected function redirectTo()
// {
//     // $userName = Auth::user()->name;
//     // //use your own route
//     return redirect('/login')->with('erro_login', 'Registrasi berhasil. Mohon tunggu persetujuan dari admin');
// }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nip' => ['required', 'string', 'max:255'],
            'credit' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'pkPosition' => ['required', 'string', 'max:255'],
            'workUnit' => ['required', 'string', 'max:255'],
            'serialCard' => ['required', 'string', 'max:255'],
            'inputGender' => ['required', 'string', 'max:255'],
            'inputPlace' => ['required', 'string', 'max:255'],
            'inputDate' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'lastSKUpload' => ['required','max:10000'],
            'photoUpload' => ['required','max:2000'],
        ]);
    }

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
            $request = request();
            $sk = $request->file('lastSKUpload')->store('SK');
            $photo = $request->file('photoUpload')->store('profil');
            // $profileImageSaveAsName = time() . Auth::id() . "-profile." . 
            //                           $profileImage->getClientOriginalExtension();

            // $upload_path = 'profile_images/';
            // $profile_image_url = $upload_path . $profileImageSaveAsName;
            // $success = $profileImage->move($upload_path, $profileImageSaveAsName);

        // $sk = $data->file('lastSKUpload')->store('lastSK');
           
        $uid = Uuid::generate();
        sk::create([
            'id' => $uid,
            'nip' => $data['nip'],
            'skUrl' => $sk,
        ]);
        return User::create([
            'id' => $data['nip'],
            'nama' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'credit' => $data['credit'],    
            'pkPosition' => $data['pkPosition'],    
            'unit' => $data['workUnit'],    
            'CardSerialNumber' => $data['serialCard'],    
            'gender' => $data['inputGender'],    
            'birth_place' => $data['inputPlace'],    
            'birth_date' => $data['inputDate'],    
            'photoUrl' => $photo,    
            'lastSKUrl' => $uid,
        ]);

    }

    public function showRegistrationForm(){
        $units = Unit::all();
        $pkPositions = pkPosition::all();
        return view('auth.register', compact('units','pkPositions'));
    }
}
