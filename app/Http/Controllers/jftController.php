<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Submission;
use App\User;
use App\Log;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class jftController extends Controller
{
	public function jft_new_files(){
		$jft_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('dispositions', 'submissions.id', '=', 'dispositions.submission_id')
		->select('users.*', 'submissions.*','submissions.nip as id_pemohon','dispositions.*')
		->where('submission_position', '4')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();

		//4==jft

		return view('pages.jft.new_files',compact('jft_files'));
	}

	public function jft_forward_files($id){
		try {
    		//catat di log dengan status untuk asesmen
			$submission = Submission::find($id);
			Log::create([
				'submission_id'=> $submission->id,
				'position_log'=> '4',	//jft
				'nip'=> auth()->user()->id
			]);

    	//update status submission buat posisi
			DB::table('submissions')
			->where('id', $id)
			->update(['submission_position' => "5"]); //konseptor prakom

    	//masukkan notifikasi
			$userNotif = User::find($submission->nip);
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Pengajuan '.strtoupper($id),
				'notification_content'=>'Telah diterima di Konseptor Prakom',
				'submission_id' => $id
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('jft_new_files')->with('result_berhasil', 'Berhasil meneruskan ke Konseptor Prakom');
		} catch (Exception $e) {
			return redirect()->route('jft_new_files')->with('result_gagal', 'Gagal meneruskan ke Konseptor Prakom');
		}
	}

	public function jft_all_recap(){
		$allDataRecaps = DB::table('logs')
		->join('submissions', 'submissions.id', '=', 'logs.submission_id')
		->join('users','users.id','=','logs.nip')
		->select('users.nama as pj_name','submissions.*','logs.created_at as forward_date')
		->where('position_log', '4')
		->get();


		return view('pages.jft.allRekapData', compact('allDataRecaps'));
	}
}
