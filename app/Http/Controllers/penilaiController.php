<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TeamDetail;
use App\Item;
use App\DupakItemScores;
use App\Submission;

class penilaiController extends Controller
{
	public function timpenilai_new_files(){
		$penilaian_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('team_details', 'submissions.id', '=', 'team_details.submission_id')
		->select('users.*','users.id as id_pemohon', 'submissions.*','team_details.*')
		->where('submission_position', '8')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->where('team_details.nip','=',auth()->user()->id)
		->whereNull('team_details.individual_score')
		->get();

		//8==tim penilai
		
		return view('pages.timpenilai.new_files',compact('penilaian_files'));
	}

	public function detail_penilaian($id){
		$penilaian_submissions = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('team_details', 'submissions.id', '=', 'team_details.submission_id')
		->select('users.*','users.id as id_pemohon', 'submissions.*','team_details.*')
		->where('submissions.id', $id)
		->where('submission_position', '8')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->where('team_details.nip','=',auth()->user()->id)
		->first();

		$penilaian_files = DB::table('files')
		->join('submissions', 'submissions.id', '=', 'files.submission_id')
		->join('items', 'items.id', '=', 'files.id')
		->select('submissions.*','files.*','items.*')
		->where('submissions.id', $id)
		->get();

		// $individual_scores = TeamDetail::all()
		// ->where('submission_id',$id);

		$individual_scores = DB::table('team_details')
		->join('users', 'users.id', '=', 'team_details.nip')
		->select('users.*','team_details.*')
		->where('submission_id', $id)
		->get();
		
		return view('pages.timpenilai.detail_files',compact('penilaian_files','penilaian_submissions','individual_scores','id'));
	}

	public function submit_individual_score($id, Request $request){
		try {
			switch($request->submitbutton) {

				case 'Ajukan': 
				$team = TeamDetail::where('submission_id',$id)->first();
				$items = Item::all();
				foreach ($items as $item) {
					if (request($item->id.'timesPenilai')){
						$itemID[] = $item->id;
						$timesItem[] = request($item->id.'timesPenilai');
						$scoreItem[] = request($item->id.'item_score');
					}
				}
				$total = array();
				foreach ($timesItem as $key=>$times) {
					$total[] = $times * $scoreItem[$key];

					DupakItemScores::create([
						'team_id' =>$team->team_id,
						'_item_id' => $itemID[$key],
						'submission_id' => $id,
						'nip' => auth()->user()->id,
						'item_score' => $scoreItem[$key],
						'times' => $timesItem[$key],
						'type' => 'individual'
					]);
					
				}

				DB::table('team_details')
				->where('team_id',$team->team_id)
				->where('submission_id',$id)
				->where('nip',auth()->user()->id)
				->update(['individual_score' => array_sum($total)]);

				// $submission = TeamDetail::where('submission_id',$id)->where('nip',auth()->user()->id);
				// $submission->update([
				// 	'individual_score' => request('penilaian_individual')
				// ]);

				return redirect()->route('timpenilai_new_files')->with('result_berhasil', 'Berhasil ajukan nilai');

				break;
			}
		} catch (Exception $e) {
			return redirect()->route('timpenilai_new_files')->with('result_gagal', 'Perubahan Gagal');
		}
	}

	public function define_final_score(){
		$penilaian_files = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('team_details', 'submissions.id', '=', 'team_details.submission_id')
		->select('users.*','users.id as id_pemohon', 'submissions.*','team_details.*')
		->where('submission_position', '8')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->where('team_details.nip','=',auth()->user()->id)
		->where('team_details.position','=','1')
		->get();

		//8==tim penilai
		
		return view('pages.timpenilai.final',compact('penilaian_files'));
	}

	public function detail_penilaian_final($id){
		$penilaian_submissions = DB::table('submissions')
		->join('users', 'submissions.nip', '=', 'users.id')
		->join('team_details', 'submissions.id', '=', 'team_details.submission_id')
		->select('users.*','users.id as id_pemohon', 'submissions.*','team_details.*')
		->where('submissions.id', $id)
		->where('submission_position', '8')
		->where('submission_status','=','accepted')
		->where('submissions.nip','!=',auth()->user()->id)
		->where('team_details.nip','=',auth()->user()->id)
		->first();

		$penilaian_files = DB::table('files')
		->join('submissions', 'submissions.id', '=', 'files.submission_id')
		->join('items', 'items.id', '=', 'files.id')
		->select('submissions.*','files.*','items.*')
		->where('submissions.id', $id)
		->get();

		$individual_scores = DB::table('team_details')
		->join('users', 'users.id', '=', 'team_details.nip')
		->select('users.*','team_details.*')
		->where('submission_id', $id)
		->get();

		$check_score_null = DB::table('team_details')
		->join('users', 'users.id', '=', 'team_details.nip')
		->select('users.*','team_details.*')
		->whereNull('individual_score')
		->get();

		$terampil_items = DB::table('items')
		->where('type','terampil')
		->get();

		$ahli_items = DB::table('items')
		->where('type','ahli')
		->get();
		
		return view('pages.timpenilai.final_detail_files',compact('id','penilaian_submissions','penilaian_files','individual_scores','check_score_null','terampil_items','ahli_items'));
	}

	public function submit_final_score($id, Request $request){
		try {
			switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				return view('pages.timpenilai.final_reject',compact('submission'));

				break;

				case 'Ajukan': 
				$items = Item::all();
				$this_submission = DB::table('submissions')
				->join('users', 'submissions.nip', '=', 'users.id')
				->select('users.*','users.id as id_pemohon', 'submissions.*')
				->where('submissions.id',$id)->first();

				foreach ($items as $item) {
					if (request($item->id.'timesPenilai')){
						$itemID[] = $item->id;
						$timesItem[] = request($item->id.'timesPenilai');
						$scoreItem[] = request($item->id.'item_score');
					}

					if(request($item->id.'previousTimes_terampil')){
						$previous_terampilID[] = $item->id;
						$previous_terampilTimes[] = request($item->id.'previousTimes_terampil');
						$previous_terampilScore[] = request($item->id.'previousScore_terampil');
					}

					if (request($item->id.'previousTimes_ahli')) {
						$previous_ahliID[] = $item->id;
						$previous_ahliTimes[] = request($item->id.'previousTimes_ahli');
						$previous_ahliScore[] = request($item->id.'previousScore_terampil');
					}

				}
				return view('pages.timpenilai.detail_pak',compact('this_submission','items'));
				break;
			}
		} catch (Exception $e) {
			return redirect()->route('define_final_score')->with('result_gagal', 'Gagal ajukan nilai akhir sidang');
		}
	}

}
