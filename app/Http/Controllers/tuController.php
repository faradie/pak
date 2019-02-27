<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Administration;
use App\Submission;
use App\Disposition;
use App\Log;
use App\User;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class tuController extends Controller
{
	public function new_files_tu(){
		$tu_new_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->select('users.*', 'submissions.*')->where('submission_position', '2')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();

		return view('pages.tu.new_files',compact('tu_new_files'));
	}

	public function tu_verification_files($id){
		$administrations = Administration::all()->where('submission_id',$id);
		$submissions = Submission::find($id);
		return view('pages.tu.verify',compact('administrations','submissions'));
	}

	public function verify_file_disposition($id,Request $request){
		try{
// $activatedUser = User::find($id);
			switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				return view('pages.tu.tu_reject',compact('submission'));

				break;

				case 'Disposisi': 
				$submission = Submission::find($id);
				return view('pages.tu.tu_disposition',compact('submission'));

				break;
			}

		}catch(\Exception $e){

		}
	}

	public function tu_disposition($id,Request $request){
		try {
			//catat di log dengan status untuk TU
			$submission = Submission::find($id);
			Log::create([
				'submission_id'=> $submission->id,
				'position_log'=> '2',	//tu
				'nip'=> auth()->user()->id
			]);

			//catat disposisi
			Disposition::create([
				'submission_id'=> $submission->id,
				'nip'=> auth()->user()->id,
				'disposition_content' => request('disposition_content')
			]);
			
			//update posisi
			DB::table('submissions')
			->where('id', $id)
			->update(['submission_position' => "3"]); //asesmen
			//notifikasi
			$userNotif = User::find($submission->nip);
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Pengajuan '.$id,
				'notification_content'=>'Telah diterima di Asesmen dan Bina Pegawai'
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('tu_new_file')->with('result_berhasil', 'Berhasil meneruskan ke Asesmen dan Bina Pegawai');
		} catch (Exception $e) {
			return redirect()->route('tu_new_file')->with('result_gagal', 'Gagal meneruskan ke Asesmen dan Bina Pegawai');
		}

	}

	public function tu_reject($id,Request $request){

	}


	public function tu_recap_files(){
		$allDataRecaps = DB::table('logs')
		->join('submissions', 'submissions.id', '=', 'logs.submission_id')
		->join('users','users.id','=','logs.nip')
		->select('users.nama as pj_name','submissions.*','logs.created_at as forward_date')
		->where('position_log', '2')
		->get();
		return view('pages.tu.recap', compact('allDataRecaps'));
	}

}
