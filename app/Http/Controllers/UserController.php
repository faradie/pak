<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\sk;
use Illuminate\Support\Facades\DB;
use Storage;
use Response;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function fetch(){
        $users = User::all()->where('is_approved','1');
        // $users = DB::table('users')->where('is_approved', '=', 1)->get();
        // dd($users);
        return view('pages.manageusers', compact('users'));
    }

    public function fetchnewapplicant(){
        $users = User::all()->where('is_approved','0');
        return view('pages.verifyapplicant', compact('users'));
    }

    public function settings($id){
        $user = User::find($id);

        return view('pages.setting',compact('user'));
    }

    public function edit($id, Request $request){
        $user = User::find($id);

        if($request->file('inputPhoto')){
            if($request->user()->photoUrl){
                Storage::delete($request->user()->photoUrl);
            }
            $image = $request->file('inputPhoto')->store('profil');
            $user->update([
                'nama' => request('inputNama'),
                'email' => request('inputEmail'),
                'address' => request('inputAddress'),
                'birth_place' => request('inputPlace'),
                'birth_date' => request('inputDate'),
                'gender'=> request('inputGender'),
                'photoUrl'=> $image,
            ]);
        }else{
            $user->update([
                'nama' => request('inputNama'),
                'email' => request('inputEmail'),
                'address' => request('inputAddress'),
                'birth_place' => request('inputPlace'),
                'birth_date' => request('inputDate'),
                'gender'=> request('inputGender'),
            ]);
        }

        return redirect()->route('home');
    }

    public function detailAplicant($id){
        $detail_user = User::find($id);
        $skUrls = sk::find($detail_user->lastSKUrl);
        return view('pages.detail_user',compact('detail_user','skUrls'));
    }

    public function acccept_applicant($id,Request $request){
        // $activatedUser = User::find($id);
        switch($request->submitbutton) {
            case 'Tolak': 
                $deletedUser = User::find($id);
                $idSK = Sk::find($deletedUser->lastSKUrl);
                Storage::delete($deletedUser->photoUrl);
                Storage::delete($idSK->skUrl);
                $deletedUser->delete();
            break;
        
            case 'Terima': 
            DB::table('users')
            ->where('id', $id)
            ->update(['is_approved' => "1"]);
            $userRoles = User::find($id);
            $userRoles->assignRole('applicant');
            // $activatedUser = User::find($id);
            // $activatedUser->update([
            //     'is_approved' => "1"
            // ]);
            break;
        }
        return redirect()->route('newapplicant');
    }
   

}
