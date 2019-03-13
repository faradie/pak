<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Administration;
use App\Submission;
use App\User;
use App\Log;
use App\TmpScores;
use App\DupakItemScores;
use App\File;
use App\Notifications\allNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Input;

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

		if ($submission->previous_id == $submission->nip) {
			//cek di tmp_scores
			$previous_item_scores = DB::table('tmp_scores')
			->join('items', 'tmp_scores.item_id', '=', 'items.id')
			->select('items.*', 'tmp_scores.*')
			->where('submission_id', $submission->nip)
			->get();
		}else{
			// $previous_item_scores = DupakItemScores::where('submission_id',$submission->previous_id)->where('type','final')->get();
			$previous_item_scores = DB::table('dupak_item_scores')
			->join('items', 'dupak_item_scores.item_id', '=', 'items.id')
			->select('items.*', 'dupak_item_scores.*')
			->where('submission_id', $submission->previous_id)
			->where('type','final')
			->get();
			//cek di dupak item scores where submission id di previous id (submission sebelumnya yg final) itu dan type final
		}
		return view('pages.sekretariat.verify',compact('administrations','submission','files','previous_item_scores'));
	}

	public function sekretariat_verify_files($id,Request $request){
		try {
			switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				$item_administrations = Administration::where('submission_id',$id)->orderBy('id', 'DESC')->get();
				$submission_items = DB::table('files')
				->join('items', 'files.id', '=', 'items.id')
				->select('items.*', 'files.*')
				->where('submission_id', $id)
				->get();
				return view('pages.sekretariat.sekretariat_reject',compact('submission','item_administrations','submission_items'));

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
				'notification_content'=>'Telah diterima di Ketua Tim',
				'submission_id' => $id
			];
			Notification::send($userNotif, new allNotification($arr));
			return redirect()->route('kesekretariatan_new_file')->with('result_berhasil', 'Berhasil meneruskan ke Ketua Tim');
			break;
		}
	} catch (Exception $e) {
		return redirect()->route('kesekretariatan_new_file')->with('result_gagal', 'Gagal meneruskan ke Kesekretariatan');
	}
}

public function sekretariat_reject($id,Request $request){
	try {
		$this_submission = Submission::find($id);
		$this_submission->update([
			'submission_status' => 'hold'
		]);
		$administration_reasons = Input::get('administration_reason');
		$item_reasons = Input::get('item_reason');
		$userRoles = User::find($this_submission->nip);
		if ($administration_reasons != null) {
			foreach ($administration_reasons as $index => $administration_reason) {
				$administration_item = Administration::where('submission_id',$id)
				->where('name',$administration_reason);
				$administration_item->update([
					'data_status' => 'hold'
				]);
				$arr = [
					'pj'=> auth()->user()->id,
					'notification_subject'=>'Pengajuan '.$id.' ditangguhkan',
					'notification_content'=>'Item '.$administration_reason.' tidak sesuai',
					'submission_id' => $id
				];
				Notification::send($userRoles, new allNotification($arr));
			}
		}

		if ($item_reasons != null) {
			foreach ($item_reasons as $index => $item_reason) {
				$item_file = File::where('submission_id',$id)
				->where('id',$item_reason);
				$item_file->update([
					'data_status' => 'hold'
				]);
				$arr = [
					'pj'=> auth()->user()->id,
					'notification_subject'=>'Pengajuan '.$id.' ditangguhkan',
					'notification_content'=>'Item '.$item_reason.' tidak sesuai',
					'submission_id' => $id
				];
				Notification::send($userRoles, new allNotification($arr));
			}
		}

		if(request('reject_content') != null){
			$arr = [
				'pj'=> auth()->user()->id,
				'notification_subject'=>'Informasi Tambahan',
				'notification_content'=> request('reject_content'),
				'submission_id' => $id
			];
			Notification::send($userRoles, new allNotification($arr));
		}
		return redirect()->route('kesekretariatan_new_file')->with('result_berhasil', 'Berhasil menolak');
	} catch (Exception $e) {
		return redirect()->route('kesekretariatan_new_file')->with('result_gagal', 'Gagal menolak');
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
