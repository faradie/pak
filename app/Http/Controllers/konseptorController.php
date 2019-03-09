<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Submission;
use App\User;
use App\Log;
use App\Administration;
use App\ItemAdministration;
use Webpatser\Uuid\Uuid;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class konseptorController extends Controller
{
	public function konseptor_new_files(){
		$konseptor_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('dispositions', 'submissions.id', '=', 'dispositions.submission_id')
		->select('users.*', 'submissions.*','dispositions.*')
		->where('submission_position', '5')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();

		//5==konseptor

		return view('pages.konseptor.new_files',compact('konseptor_files'));
	}

	public function konseptor_make_supeng($id){
		try {
			$request = request();
			$file_supeng = $request->file('supeng');
			$random_name = Uuid::generate();
			$file_supeng->move(
				base_path().'/public/dupakFiles/administrationFiles/', $random_name.'.pdf'
			);

			Administration::create([
				'id'=>'supeng',
				'name'=> 'Surat Pengantar',
				'nameID'=>'supeng',
				'submission_id' => $id,
				'fileUrl' => 'administrationFiles/'.$random_name.'.pdf'
			]);
			
			//catat di log dengan status untuk Konseptor
			$submission = Submission::find($id);
			Log::create([
				'submission_id'=> $submission->id,
				'position_log'=> '5',	//konseptor
				'nip'=> auth()->user()->id
			]);

			
			//update posisi
			DB::table('submissions')
			->where('id', $id)
			->update(['submission_position' => "6"]); //Kesekretariatan
			//notifikasi
			$userNotif = User::find($submission->nip);
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Pengajuan '.strtoupper($id),
				'notification_content'=>'Telah diterima di Kesekretariatan'
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('konseptor_new_files')->with('result_berhasil', 'Berhasil meneruskan ke Kesekretariatan');
		} catch (Exception $e) {
			return redirect()->route('konseptor_new_files')->with('result_gagal', 'Gagal meneruskan ke Kesekretariatan');
		}
	}

	public function konseptor_recap(){
		$allDataRecaps = DB::table('logs')
		->join('submissions', 'submissions.id', '=', 'logs.submission_id')
		->join('users','users.id','=','logs.nip')
		->select('users.nama as pj_name','submissions.*','logs.created_at as forward_date')
		->where('position_log', '5')
		->get();
		return view('pages.konseptor.recap', compact('allDataRecaps'));
	}

}
