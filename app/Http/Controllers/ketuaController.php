<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Submission;
use App\User;
use App\TeamDetail;
use App\Team;
use Webpatser\Uuid\Uuid;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class ketuaController extends Controller
{
	public function ketuatim_new_files(){
		$ketua_new_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->select('users.*', 'submissions.*')->where('submission_position', '7')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();

		return view('pages.ketuatim.new_files',compact('ketua_new_files'));
	}

	public function make_team_for($id){
		$submissions = Submission::find($id);
		$usersTIM = User::role('tim penilai')->get(); 
		return view('pages.ketuatim.define_team',compact('submissions','usersTIM'));
	}

	public function define_team($id,Request $request){
		try{
// $activatedUser = User::find($id);
			switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				return view('pages.tu.tu_reject',compact('submission'));

				break;

				case 'Buat': 

				$team_id = Uuid::generate();
				Team::create([
					'id' => $team_id,
					'status' => 'active'
				]);
				if (request('anggota1')) {$nipTims[] = request('anggota1');}
				if (request('anggota2')) {$nipTims[] = request('anggota2');}
				if (request('anggota3')) {$nipTims[] = request('anggota3');}
				
				foreach ($nipTims as $index => $nipTim) {
					if (!empty($nipTim)) {
						TeamDetail::create([
							'team_id'=> $team_id,
							'nip' => $nipTims[$index],
							'submission_id' => $id,
							'position' => $index+1
						]);
					}
				}
				
				$submission = Submission::find($id);
				
				//update posisi
				DB::table('submissions')
				->where('id', $id)
			->update(['submission_position' => "8"]); //Tim Penilai
			//notifikasi
			$userNotif = User::find($submission->nip);
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Pengajuan '.strtoupper($id),
				'notification_content'=>'Telah diterima Tim Penilai'
			];
			Notification::send($userNotif, new allNotification($arr));

			return redirect()->route('ketuatim_new_files')->with('result_berhasil', 'Berhasil buat tim');
			break;
		}
	}catch(\Exception $e){
		return redirect()->route('ketuatim_new_files')->with('result_gagal', 'Gagal buat tim');
	}
}
}
