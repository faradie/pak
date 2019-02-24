<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Unit;
use App\sk;
use App\PkPosition;
use Illuminate\Support\Facades\DB;
use Storage;
use Response;
use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;


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
        $roles = \Spatie\Permission\Models\Role::all();
        $permissions = \Spatie\Permission\Models\Permission::all();
        $userRoles = $user->getRoleNames();

        return view('pages.setting',compact('user','roles','permissions','userRoles'));
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

        if(auth()->user()->hasRole('admin')){


            $getRoles = $request->input('get_roles');
            $getPermission = $request->input('get_permissions');

            $user->syncRoles($getRoles);
            $user->syncPermissions($getPermission);

            return redirect()->route('user.settings',$user->id);
        }

        return redirect()->route('home');
    }

    public function detailAplicant($id){
        $detail_user = User::find($id);
        $skUrls = sk::find($detail_user->lastSKUrl);
        $unitsName = Unit::find($detail_user->unit);
        $positionName = PkPosition::find($detail_user->pkPosition);
        return view('pages.detail_user',compact('detail_user','skUrls','unitsName','positionName'));
    }

    public function acccept_applicant($id,Request $request){
        try{
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

                $arr = [
                    'notification_subject'=>auth()->user()->id,
                    'notification_content'=>'Selamat akun anda telah aktif'
                ];
                Notification::send($userRoles, new allNotification($arr));

                break;
            }
            return redirect()->route('newapplicant')->with('result_berhasil', 'Penerimaan Berhasil');
        }catch(\Exception $e){
            return redirect()->route('newapplicant')->with('result_gagal', 'Penerimaan Gagal');
        }
        
    }


}
