<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\User;
use App\Submission;
use App\Unit;
use App\sk;
use App\Information;
use App\Administration;
use App\ItemAdministration;
use App\File;
use App\Item;
use App\PkPosition;
use Illuminate\Support\Facades\DB;
use Storage;
use Response;
use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;
use Webpatser\Uuid\Uuid;

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
        try {
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
                try {
                    $getRoles = $request->input('get_roles');
                    $getPermission = $request->input('get_permissions');

                    $user->syncRoles($getRoles);
                    $user->syncPermissions($getPermission);
                    return redirect()->route('user.settings',$user->id)->with('result_berhasil', 'Perubahan Berhasil');
                } catch (Exception $e) {
                 return redirect()->route('user.settings',$user->id)->with('result_gagal', 'Perubahan Gagal');
             }
         }

         return redirect()->route('user.settings',$user->id)->with('result_berhasil', 'Perubahan Berhasil');
     } catch (Exception $e) {
        return redirect()->route('user.settings',$user->id)->with('result_gagal', 'Perubahan Gagal');
    }
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
                'pj'=>auth()->user()->id,
                'notification_subject'=> 'Pemberitahuan Akun Aktif',
                'notification_content'=>'Selamat akun anda telah aktif dan dapat digunakan!'
            ];
            Notification::send($userRoles, new allNotification($arr));

            break;
        }
        return redirect()->route('newapplicant')->with('result_berhasil', 'Penerimaan Berhasil');
    }catch(\Exception $e){
        return redirect()->route('newapplicant')->with('result_gagal', 'Penerimaan Gagal');
    }
    
}

public function fetch_history(){
    $submission_histories = Submission::all()->where('nip',auth()->user()->id)->where('submission_position','!=','0');
    return view('pages.user.submission_history', compact('submission_histories'));
}

public function fetch_history_detail($id){
    $butir_terampil1A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '1')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->get();
    $butir_terampil1B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '1')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->get();

    $butir_terampil2A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->get();
    $butir_terampil2B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->get();
    $butir_terampil2C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->get();

    $butir_terampil3A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->get();
    $butir_terampil3B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->get();
    $butir_terampil3C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->get();
    $butir_terampil3D = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'D')->get();

    $butir_terampil4A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->get();
    $butir_terampil4B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->get();
    $butir_terampil4C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->get();

    $butir_terampil5A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->get();
    $butir_terampil5B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->get();
    $butir_terampil5C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->get();
    $butir_terampil5D = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'D')->get();
    $butir_terampil5E = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'E')->get();
    $butir_terampil5F = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'F')->get();

    $administration_items = ItemAdministration::orderBy('id', 'DESC')->get();

    $submission_this = Submission::find($id);

    $join_files = DB::table('items')
    ->join('files', 'files.id', '=', 'items.id')
    ->select('items.*', 'files.*')
    ->where('files.submission_id',$id)
    ->get();
    
    $saved_administrations = Administration::orderBy('id', 'DESC')->where('submission_id',$id)->get();
    $saved_files = File::all()->where('submission_id',$id);

    return view('pages.user.detail_submission_history',compact('butir_terampil1A','butir_terampil1B','butir_terampil2A','butir_terampil2B','butir_terampil2C','butir_terampil3A','butir_terampil3B','butir_terampil3C','butir_terampil3D','butir_terampil4A','butir_terampil4B','butir_terampil4C','butir_terampil5A','butir_terampil5B','butir_terampil5C','butir_terampil5D','butir_terampil5E','butir_terampil5F','saved_files','administration_items','id','submission_this'))->with('saved_administrations',$saved_administrations);
}

public function detail_information($id){
    $info = Information::find($id);
    return view('pages.user.info_detail',compact('info'));
}

public function save_or_submit_fromHistory($id,Request $request){
    try {
        switch($request->submitbutton) {
            case 'Simpan':
                 //For items upload
            $files_administration =[];
            $items_administration = ItemAdministration::all();
            foreach ($items_administration as $item) {
                if ($request->file($item->id)){
                    $files_administration[] = $request->file($item->id);
                    $nameID[] = $item->id;
                    $nameAdministration[] = ItemAdministration::find($item->id)->item_name;
                //buat masing" files_administration
                // File::create([
                //     'id' => $item->id,
                //     'nip' => auth()->user()->id,
                //     'submission_position' => '1',
                // ]);
                }
            }

            foreach ($files_administration as $index => $ads)
            {
                if(!empty($ads)){
                    //delete previous file

                    $ad_file = DB::table('administrations')
                    ->where('id', $nameID[$index])->where('submission_id',$id)->first();
                    Storage::delete($ad_file->fileUrl);
                    $deleteFile = Administration::where('id',$nameID[$index])->where('submission_id',$id);
                    $deleteFile->delete();

                //move file into directory
                    $random_name = Uuid::generate();
                    $ads->move(
                        base_path().'/public/dupakFiles/administrationFiles/', $random_name.'.pdf'
                    );
                    Administration::create([
                        'id'=>$nameID[$index],
                        'name'=> $nameAdministration[$index],
                        'nameID'=>$nameID[$index],
                        'submission_id' => $id,
                        'fileUrl' => 'administrationFiles/'.$random_name.'.pdf'
                    ]);
                }

            }

            $files =[];
            $items = Item::all();
            foreach ($items as $item) {
                if ($request->file($item->id)){
                    $files[] = $request->file($item->id);
                    $itemID[] = $item->id;
                    $timesItem[] = request($item->id.'times');
                //buat masing" files
                // File::create([
                //     'id' => $item->id,
                //     'nip' => auth()->user()->id,
                //     'submission_position' => '1',
                // ]);
                }
            }
        // dd($files,$itemID,$timesItem);

            foreach ($files as $index => $file )
            {
                if(!empty($file)){
                //create in files
                    if($timesItem[$index]==null){
                     return back()->with('result_gagal', 'Gagal Perbarui File (Pengali) ');
                 }else{
                        //move file into directory
                    $random_string = Uuid::generate();
                    $file->move(
                        base_path().'/public/dupakFiles/submissionFiles/', $random_string.'.pdf'
                    );
                    File::create([
                        'id' => $itemID[$index],
                        'submission_id' => $id,
                        'fileUrl' => 'submissionFiles/'.$random_string.'.pdf',
                        'times' => $timesItem[$index]
                    // 'type'=> 'berkas_butir'
                    ]);
                }

            }

        }

        //change period
        $period = Submission::where('id',$id);
        $period->update([
            'starts' => request('startDate'),
            'ends' => request('endDate')
        ]);
        break;
        case 'Ajukan':
        try {
                //For items upload
            $files_administration =[];
            $items_administration = ItemAdministration::all();
            foreach ($items_administration as $item) {
                if ($request->file($item->id)){
                    $files_administration[] = $request->file($item->id);
                    $nameID[] = $item->id;
                    $nameAdministration[] = ItemAdministration::find($item->id)->item_name;
                //buat masing" files_administration
                // File::create([
                //     'id' => $item->id,
                //     'nip' => auth()->user()->id,
                //     'submission_position' => '1',
                // ]);
                }
            }

            foreach ($files_administration as $index => $ads)
            {
                if(!empty($ads)){

                    //delete previous file
                    $ad_file = DB::table('administrations')
                    ->where('id', $nameID[$index])->where('submission_id',$id)->first();
                    Storage::delete($ad_file->fileUrl);
                    $deleteFile = Administration::where('id',$nameID[$index])->where('submission_id',$id);
                    $deleteFile->delete();

                //move file into directory
                    $random_name = Uuid::generate();
                    $ads->move(
                        base_path().'/public/dupakFiles/administrationFiles/', $random_name.'.pdf'
                    );
                    Administration::create([
                        'id'=>$nameID[$index],
                        'name'=> $nameAdministration[$index],
                        'nameID'=>$nameID[$index],
                        'submission_id' => $id,
                        'fileUrl' => 'administrationFiles/'.$random_name.'.pdf'
                    ]);
                }

            }

            $files =[];
            $items = Item::all();
            foreach ($items as $item) {
                if ($request->file($item->id)){
                    $files[] = $request->file($item->id);
                    $itemID[] = $item->id;
                    $timesItem[] = request($item->id.'times');
                //buat masing" files
                // File::create([
                //     'id' => $item->id,
                //     'nip' => auth()->user()->id,
                //     'submission_position' => '1',
                // ]);
                }
            }
        // dd($files,$itemID,$timesItem);

            foreach ($files as $index => $file )
            {
                if(!empty($file)){
                //create in files
                    if($timesItem[$index]==null){
                     return back()->with('result_gagal', 'Gagal Perbarui File (Pengali) ');
                 }else{

                    //delete previous file
                    $file_file = DB::table('files')
                    ->where('id', $itemID[$index])->where('submission_id',$id)->first();
                    Storage::delete($file_file->fileUrl);
                    $deleteFile_item = File::where('id',$itemID[$index])->where('submission_id',$id);
                    $deleteFile_item->delete();

                        //move file into directory
                    $random_string = Uuid::generate();
                    $file->move(
                        base_path().'/public/dupakFiles/submissionFiles/', $random_string.'.pdf'
                    );
                    File::create([
                        'id' => $itemID[$index],
                        'submission_id' => $id,
                        'fileUrl' => 'submissionFiles/'.$random_string.'.pdf',
                        'times' => $timesItem[$index]
                    // 'type'=> 'berkas_butir'
                    ]);
                }

            }

        }

        // $current_events = DB::table('periods')->select( 'id','starts', 'ends' )
        // ->where( DB::raw('now()'), '>=', DB::raw('starts') )
        // ->where( DB::raw('now()'), '<=', DB::raw('ends') )->get();

        DB::table('submissions')
        ->where('id', $id)
        ->update([
            'submission_status' => "accepted",
            'starts' => request('startDate'),
            'ends' => request('endDate')
        ]);

        return redirect()->route('fetch_history')->with('result_berhasil', 'Pengajuan Berhasil');
    } catch (Exception $e) {
        return redirect()->route('fetch_history')->with('result_gagal', 'Pengajuan Gagal');
    }
    break;
}
} catch (Exception $e) {

}
}

}
