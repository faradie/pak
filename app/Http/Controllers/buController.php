<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Log;
use App\Submission;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class buController extends Controller
{
	public function new_files_bu(){
		$bu_submission = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->select('users.*', 'submissions.*')->where('submission_position', '1')
		->get();

        // $bu_submission = Submission::all()->where('submission_position','1');
        // foreach ($bu_submission as $submission_nip) {
        //     $users = User::find($submission_nip->nip);
        // }
		return view('pages.bu.new_files', compact('bu_submission'));
	}

	public function forward_files($id){
		try {
			//catat di log dengan status untuk biro umum
		$submission = Submission::find($id);
		Log::create([
			'submission_id'=> $submission->id,
			'position_log'=> '1',
			'nip'=> auth()->user()->id
		]);

    	//update status submission buat posisi
		DB::table('submissions')
		->where('id', $id)
		->update(['submission_position' => "2"]);

    	//masukkan notifikasi
    	$userNotif = User::find($submission->nip);
        $arr = [
            'notification_subject'=>'Pengajuan '.$id,
            'notification_content'=>'Telah diterima di TU Kepegawaian'
        ];
        Notification::send($userNotif, new allNotification($arr));
        return redirect()->route('new_files')->with('result_berhasil', 'Berhasil meneruskan ke TU');
		} catch (Exception $e) {
			return redirect()->route('new_files')->with('result_gagal', 'Gagal meneruskan ke TU');
		}
	}
}
