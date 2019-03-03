<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Administration;
use App\Submission;

use App\User;
use App\Log;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class sekretariatController extends Controller
{
	public function kesekretariatan_new_file(){
		$sekretariat_new_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->select('users.*', 'submissions.*')->where('submission_position', '6')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();

		return view('pages.sekretariat.new_files',compact('sekretariat_new_files'));
	}

	public function sekretariat_verifications($id){
		$administrations = Administration::all()->where('submission_id',$id);
		$files = DB::table('files')
		->join('items', 'files.id', '=', 'items.id')
		->select('items.*', 'files.*')
		->where('submission_id', $id)
		->get();
		$submission = Submission::find($id);
		
		return view('pages.sekretariat.verify',compact('administrations','submission','files'));
	}

	public function sekretariat_verify_files($id,Request $request){
		try {
			switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				return view('pages.tu.tu_reject',compact('submission'));

				break;

				case 'Teruskan': 
				$submission = Submission::find($id);
				Log::create([
					'submission_id'=> $submission->id,
				'position_log'=> '6',	//kesekretariatan
				'nip'=> auth()->user()->id
			]);


			//update posisi
				DB::table('submissions')
				->where('id', $id)
			->update(['submission_position' => "7"]); //ketua tim
			//notifikasi
			$userNotif = User::find($submission->nip);
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Pengajuan '.strtoupper($id),
				'notification_content'=>'Telah diterima di Ketua Tim'
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('kesekretariatan_new_file')->with('result_berhasil', 'Berhasil meneruskan ke Ketua Tim');
			break;
		}
	} catch (Exception $e) {
		return redirect()->route('kesekretariatan_new_file')->with('result_gagal', 'Gagal meneruskan ke Kesekretariatan');
	}
}

public function sekretariat_recap_files(){
	$allDataRecaps = DB::table('logs')
		->join('submissions', 'submissions.id', '=', 'logs.submission_id')
		->join('users','users.id','=','logs.nip')
		->select('users.nama as pj_name','submissions.*','logs.created_at as forward_date')
		->where('position_log', '6')
		->get();
		return view('pages.sekretariat.recap', compact('allDataRecaps'));
}

}
