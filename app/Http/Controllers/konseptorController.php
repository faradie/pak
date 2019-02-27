<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Submission;
use App\User;
use App\Log;

use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;

class konseptorController extends Controller
{
	public function konseptor_new_files(){
		$konseptor_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->select('users.*', 'submissions.*')->where('submission_position', '5')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->get();

		//5==konseptor

		return view('pages.konseptor.new_files',compact('konseptor_files'));
	}

	public function konseptor_make_supeng($id){
		try {
			$request = request();
			$file_supeng = $request->file('supeng')->store('administrationFiles');
			// tambahkan supeng
			Administration::create([
				'name'=> 'Surat Pengantar',
				'nameID'=> 'supeng',
				'submission_id' => $id,
				'fileUrl' => $file_supeng
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
				'notification_subject'=>'Pengajuan '.$id,
				'notification_content'=>'Telah diterima di Kesekretariatan'
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('konseptor_new_files')->with('result_berhasil', 'Berhasil meneruskan ke Kesekretariatan');
		} catch (Exception $e) {
			return redirect()->route('konseptor_new_files')->with('result_gagal', 'Gagal meneruskan ke Kesekretariatan');
		}
	}

}
