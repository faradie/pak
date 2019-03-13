<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Submission;
use App\User;
use App\Log;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class asesmenController extends Controller
{
	public function asesmen_new_file(){
		$asesmen_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('dispositions', 'submissions.id', '=', 'dispositions.submission_id')
		->select('users.*', 'submissions.*','submissions.nip as id_pemohon','dispositions.*')
		->where('submission_position', '3')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();
		return view('pages.asesmen.new_files',compact('asesmen_files'));
	}

	public function asesmen_forward_files($id){
		try {
    		//catat di log dengan status untuk asesmen
			$submission = Submission::find($id);
			Log::create([
				'submission_id'=> $submission->id,
				'position_log'=> '3',	//asesmen
				'nip'=> auth()->user()->id
			]);

    	//update status submission buat posisi
			DB::table('submissions')
			->where('id', $id)
			->update(['submission_position' => "4"]); //jft

    	//masukkan notifikasi
			$userNotif = User::find($submission->nip);
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Pengajuan '.strtoupper($id),
				'notification_content'=>'Telah diterima di Jabatan Fungsional Tertentu',
				'submission_id' => $id
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('asesmen_new_file')->with('result_berhasil', 'Berhasil meneruskan ke Jabatan Fungsional Tertentu');

		} catch (Exception $e) {
			return redirect()->route('asesmen_new_file')->with('result_gagal', 'Gagal meneruskan ke Jabatan Fungsional Tertentu');
		}

	}

	public function asesmen_all_recap(){
		$allDataRecaps = DB::table('logs')
		->join('submissions', 'submissions.id', '=', 'logs.submission_id')
		->join('users','users.id','=','logs.nip')
		->select('users.nama as pj_name','submissions.*','logs.created_at as forward_date')
		->where('position_log', '3')
		->get();


		return view('pages.asesmen.allRekapData', compact('allDataRecaps'));
	}

}
