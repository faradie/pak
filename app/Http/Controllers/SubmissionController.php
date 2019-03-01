<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Submission;
use App\File;
use App\Period;
use App\ItemAdministration;
use App\Administration;
use Webpatser\Uuid\Uuid;
use Crisu83\ShortId\ShortId;
use Illuminate\Support\Facades\DB;
use Storage;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class SubmissionController extends Controller
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

    public function createTerampil(){
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
        
        $periods = Period::where('starts', '<=', \Carbon\Carbon::now())
        ->where('ends', '>=', \Carbon\Carbon::now())
        ->get();

        return view('pages.submission.createTerampil',compact('butir_terampil1A','butir_terampil1B','butir_terampil2A','butir_terampil2B','butir_terampil2C','butir_terampil3A','butir_terampil3B','butir_terampil3C','butir_terampil3D','butir_terampil4A','butir_terampil4B','butir_terampil4C','butir_terampil5A','butir_terampil5B','butir_terampil5C','butir_terampil5D','butir_terampil5E','butir_terampil5F','periods'));
    }

    public function submitTerampil(Request $request){
        try {
            switch($request->submitbutton) {
                case 'Simpan': 
                $myStats = User::find(auth()->user()->id);

                if($myStats->status == 'free'){

                 //status 1 bu

                    $shortid = ShortId::create();
             // $idSub = Uuid::generate();
                    $idSub = $shortid->generate();

                    Submission::create([
                        'id' => $idSub,
                        'nip' => auth()->user()->id,
                        'submission_position' => '0',
                        'submissionType' => 'terampil',
                        'submission_status'=> 'accepted'
                    ]);

                    $administrativeFiles =[];
                    $nameIDFile=['lastSKUpload','skCPNSUpload','karpegUpload','skpUpload','dupakUpload','pakUpload'];
                    $nameFile=['SK Terakhir','SK CPNS','KARPEG','SKP 2 Tahun terakhir','DUPAK','PAK'];
                    if ($request->file('lastSKUpload')) $administrativeFiles[] = $request->file('lastSKUpload');
                    if ($request->file('skCPNSUpload')) $administrativeFiles[] = $request->file('skCPNSUpload');
                    if ($request->file('karpegUpload')) $administrativeFiles[] = $request->file('karpegUpload');
                    if ($request->file('skpUpload')) $administrativeFiles[] = $request->file('skpUpload');
                    if ($request->file('dupakUpload')) $administrativeFiles[] = $request->file('dupakUpload');
                    if ($request->file('pakUpload')) $administrativeFiles[] = $request->file('pakUpload');

                    foreach ($administrativeFiles as $index => $ads)
                    {
                        if(!empty($ads)){
                //move file into directory
                            $random_name = Uuid::generate();
                            $ads->move(
                                base_path().'/public/dupakFiles/administrationFiles/', $random_name.'.pdf'
                            );
                            Administration::create([
                                'id'=>$nameIDFile[$index],
                                'name'=> $nameFile[$index],
                                'nameID'=>$nameIDFile[$index],
                                'submission_id' => $idSub,
                                'fileUrl' => 'administrationFiles/'.$random_name.'.pdf'
                            ]);
                        }

                    }
            //For items upload
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
                //move file into directory
                            $random_string = Uuid::generate();
                            $file->move(
                                base_path().'/public/dupakFiles/submissionFiles/', $random_string.'.pdf'
                            );
                //create in files
                            File::create([
                                'id' => $itemID[$index],
                                'submission_id' => $idSub,
                                'fileUrl' => 'submissionFiles/'.$random_string.'.pdf',
                                'times' => $timesItem[$index]
                    // 'type'=> 'berkas_butir'
                            ]);

                        }

                    }

                    $userRoles = User::find(auth()->user()->id);
                    $userRoles->update([
                        'status'=>'hold',
                    ]);
                    $arr = [
                        'pj'=> null,
                        'notification_subject'=>'Pengajuan '.$idSub,
                        'notification_content'=>'Telah diterima diSimpan'
                    ];
                    Notification::send($userRoles, new allNotification($arr));
                    return redirect()->route('terampil_create')->with('result_berhasil', 'Pengajuan telah berhasil disimpan');
                }else{
                    return redirect()->route('terampil_create')->with('result_gagal', 'Pengajuan Gagal - Anda dalam tahap pengajuan');
                }

                break;

                //case pengajuan

                case 'Ajukan': 

                $myStats = User::find(auth()->user()->id);
                
                if($myStats->status == 'free'){
                     //status 1 bu

                    $shortid = ShortId::create();
             // $idSub = Uuid::generate();
                    $idSub = $shortid->generate();

                    Submission::create([
                        'id' => $idSub,
                        'nip' => auth()->user()->id,
                        'submission_position' => '1',
                        'submissionType' => 'terampil',
                        'submission_status'=> 'accepted'
                    ]);


                    $administrativeFiles =[];
                    $nameIDFile=['lastSKUpload','skCPNSUpload','karpegUpload','skpUpload','dupakUpload','pakUpload'];
                    $nameFile=['SK Terakhir','SK CPNS','KARPEG','SKP 2 Tahun terakhir','DUPAK','PAK'];
                    if ($request->file('lastSKUpload')) $administrativeFiles[] = $request->file('lastSKUpload');
                    if ($request->file('skCPNSUpload')) $administrativeFiles[] = $request->file('skCPNSUpload');
                    if ($request->file('karpegUpload')) $administrativeFiles[] = $request->file('karpegUpload');
                    if ($request->file('skpUpload')) $administrativeFiles[] = $request->file('skpUpload');
                    if ($request->file('dupakUpload')) $administrativeFiles[] = $request->file('dupakUpload');
                    if ($request->file('pakUpload')) $administrativeFiles[] = $request->file('pakUpload');

                    foreach ($administrativeFiles as $index => $ads)
                    {
                        if(!empty($ads)){
                //move file into directory
                            $random_name = Uuid::generate();
                            $ads->move(
                                base_path().'/public/dupakFiles/administrationFiles/', $random_name.'.pdf'
                            );
                            Administration::create([
                                'name'=> $nameFile[$index],
                                'nameID'=>$nameIDFile[$index],
                                'submission_id' => $idSub,
                                'fileUrl' => 'administrationFiles/'.$random_name.'.pdf'
                            ]);
                        }

                    }
            //For items upload
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
                //move file into directory
                            $random_string = Uuid::generate();
                            $file->move(
                                base_path().'/public/dupakFiles/submissionFiles/', $random_string.'.pdf'
                            );
                //create in files
                            File::create([
                                'id' => $itemID[$index],
                                'submission_id' => $idSub,
                                'fileUrl' => 'submissionFiles/'.$random_string.'.pdf',
                                'times' => $timesItem[$index]
                    // 'type'=> 'berkas_butir'
                            ]);

                        }

                    }


                    $userRoles = User::find(auth()->user()->id);
                    $userRoles->update([
                        'status'=>'hold',
                    ]);
                    $arr = [
                        'pj'=> null,
                        'notification_subject'=>'Pengajuan '.$idSub,
                        'notification_content'=>'Telah diterima di Biro Umum'
                    ];
                    Notification::send($userRoles, new allNotification($arr));
                    return redirect()->route('terampil_create')->with('result_berhasil', 'Pengajuan telah berhasil');
                }else{
                    return redirect()->route('terampil_create')->with('result_gagal', 'Pengajuan Gagal - Anda dalam tahap pengajuan');
                }
                
                break;
            }

            
        } catch (Exception $e) {
            return redirect()->route('terampil_create')->with('result_gagal', 'Pengajuan Gagal');
        }
        
    }

    public function submission_saved(){
        $saved_submissions = DB::table('submissions')
        ->join('users', 'submissions.nip', '=', 'users.id')
        ->select('users.*', 'submissions.*')
        ->where('submission_position', '0')
        ->get();
        // $bu_submission = Submission::all()->where('submission_position','1');
        // foreach ($bu_submission as $submission_nip) {
        //     $users = User::find($submission_nip->nip);
        // }
        return view('pages.user.saved_submissions', compact('saved_submissions'));
    }

    public function createAhli(){
        return view('pages.submission.createAhli');
    }

    public function detail_saved($id){
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
        
        $periods = Period::where('starts', '<=', \Carbon\Carbon::now())
        ->where('ends', '>=', \Carbon\Carbon::now())
        ->get();

        $administration_items = ItemAdministration::all();
        
        $saved_administrations = Administration::all()->where('submission_id',$id);
        $saved_files = File::all()->where('submission_id',$id);
        
        return view('pages.user.saved_detail',compact('butir_terampil1A','butir_terampil1B','butir_terampil2A','butir_terampil2B','butir_terampil2C','butir_terampil3A','butir_terampil3B','butir_terampil3C','butir_terampil3D','butir_terampil4A','butir_terampil4B','butir_terampil4C','butir_terampil5A','butir_terampil5B','butir_terampil5C','butir_terampil5D','butir_terampil5E','butir_terampil5F','periods','saved_files','saved_administrations','administration_items','id'));
    }

    public function delete_saved_administration($id,Request $request){
        try {
            $thisFile = DB::table('administrations')
            ->where('id', $request->name_id)->where('submission_id',$id)->first();
            Storage::delete($thisFile->fileUrl);
            $deleteFile = Administration::findOrFail($request->name_id);
            $deleteFile->delete();
            return back()->with('result_berhasil', 'Berhasil Hapus File');
        } catch (Exception $e) {
            return back()->with('result_gagal', 'Gagal Hapus File');
        }
    }

    public function delete_saved_item($id,Request $request){
        try {
            $thisFile = DB::table('files')
            ->where('id', $request->name_id)->where('submission_id',$id)->first();
            Storage::delete($thisFile->fileUrl);
            $deleteFileItem = File::findOrFail($request->name_id);
            $deleteFileItem->delete();
            return back()->with('result_berhasil', 'Berhasil Hapus File');
        } catch (Exception $e) {
            return back()->with('result_gagal', 'Gagal Hapus File');
        }
    }

    public function save_or_submit_fromSaved($id,Request $request){
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
                        $nameAdministration[] = ItemAdministration::find($item->id);
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
                        $nameAdministration[] = ItemAdministration::find($item->id);
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

            DB::table('submissions')
            ->where('id', $id)
            ->update(['submission_position' => "1"]);
            $userRoles = User::find(auth()->user()->id);
            $userRoles->update([
                'status'=>'hold',
            ]);
            $arr = [
                'pj'=> null,
                'notification_subject'=>'Pengajuan '.$id,
                'notification_content'=>'Telah diterima di Biro Umum'
            ];
            Notification::send($userRoles, new allNotification($arr));
            return redirect()->route('submission_saved')->with('result_berhasil', 'Pengajuan Berhasil');
        } catch (Exception $e) {
            return redirect()->route('submission_saved')->with('result_gagal', 'Pengajuan Gagal');
        }
        break;
    }
    return back()->with('result_berhasil', 'Berhasil Perbarui File');
} catch (Exception $e) {
    return back()->with('result_gagal', 'Gagal Perbarui File');
}
}

}
