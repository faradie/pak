<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TeamDetail;
use App\Item;
use App\DupakItemScores;
use App\Submission;
use App\PkPosition;
use App\Unit;
use App\File;
use PDF;

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
						'item_id' => $itemID[$key],
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
		->where('submission_id',$id)
		->whereNull('individual_score')
		->get();

		$terampil_items = DB::table('items')
		->where('type','terampil')
		->get();

		$ahli_items = DB::table('items')
		->where('type','ahli')
		->get();

		$score_submission_check = Submission::find($id);

		$check_available_score = DB::table('dupak_item_scores')
		->where('nip',auth()->user()->id)
		->where('submission_id',$id)
		->where('type','final')
		->get();
		
		return view('pages.timpenilai.final_detail_files',compact('id','penilaian_submissions','penilaian_files','individual_scores','check_score_null','terampil_items','ahli_items','score_submission_check','check_available_score'));
	}

	public function submit_final_score($id, Request $request){
		try {
			switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				return view('pages.timpenilai.final_reject',compact('submission'));

				break;

				case 'Ajukan': 
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

				$team = DB::table('team_details')
				->where('submission_id',$id)
				->where('nip',auth()->user()->id)
				->first();

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
						'item_id' => $itemID[$key],
						'submission_id' => $id,
						'nip' => auth()->user()->id,
						'item_score' => $scoreItem[$key],
						'times' => $timesItem[$key],
						'type' => 'final'
					]);
					
				}


				DB::table('submissions')
				->where('id',$id)
				->update([
					'submission_score' => array_sum($total)
				]);

				DB::table('users')
				->where('id',$penilaian_submissions->id_pemohon)
				->update(['lastSubmissionID' => $id]);

				// $submission = TeamDetail::where('submission_id',$id)->where('nip',auth()->user()->id);
				// $submission->update([
				// 	'individual_score' => request('penilaian_individual')
				// ]);

				return redirect()->route('detail_penilaian_final',$id)->with('result_berhasil', 'Berhasil ajukan nilai');
				break;

				case 'Rincian PAK':
				$butir_terampil1A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '1')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil1B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '1')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3)+0 asc')->get();

				$butir_terampil2A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil2B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil2C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();

				$butir_terampil3A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil3B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil3C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil3D = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'D')->orderByRaw('substr(id, 3) asc')->get();

				$butir_terampil4A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil4B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil4C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();

				$butir_terampil5A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5D = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'D')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5E = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'E')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5F = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'F')->orderByRaw('substr(id, 3) asc')->get();

				$this_submission = DB::table('submissions')
				->join('users', 'submissions.nip', '=', 'users.id')
				->select('users.*','users.id as id_pemohon','users.birth_date as tglLahir', 'submissions.*')
				->where('submissions.id',$id)->first();
				$pk_Position = PkPosition::find($this_submission->pkPosition);
				$unit_applicant = Unit::find($this_submission->unit);

				//for baru institusion from submission files
				$get_submission_items = DB::table('files')
				->join('items', 'items.id', '=', 'files.id')
				->select('items.*','files.*')
				->where('files.submission_id',$id)->get();

				// get final score in dupak_item_scores
				$get_final_dupak_scores = DB::table('dupak_item_scores')
				->select('dupak_item_scores.*')
				->where('dupak_item_scores.submission_id',$id)
				->where('type','final')->get();

				//get previous score per items
				if($this_submission->previous_id == $this_submission->nip){
					$get_final_previous_scores = DB::table('tmp_scores')
					->select('tmp_scores.*')
					->where('tmp_scores.submission_id',$this_submission->previous_id)
					->get();

					$get_jml_institusions = DB::table('items')
					->join('files', 'items.id', '=', 'files.id')
					->join('tmp_scores','tmp_scores.item_id','=','items.id')
					->select('items.*','files.*','tmp_scores.*','files.times as files_times','tmp_scores.item_score as dupak_item_scores_item_score')
					->where('tmp_scores.submission_id',$this_submission->previous_id)
					->where('files.submission_id',$id)->get();

					$get_jml_penilai = DB::table('dupak_item_scores')
					->join('tmp_scores','tmp_scores.item_id','=','dupak_item_scores.item_id')
					->select('tmp_scores.*','tmp_scores.item_score as dupak_item_scores_item_score','dupak_item_scores.*')
					->where('tmp_scores.submission_id',$this_submission->previous_id)
					->where('dupak_item_scores.submission_id',$id)
					->where('dupak_item_scores.type','final')->get();

				}else{
					$get_final_previous_scores = DB::table('dupak_item_scores')
					->select('dupak_item_scores.*')
					->where('dupak_item_scores.submission_id',$this_submission->previous_id)
					->where('type','final')
					->get();

					$get_jml_institusions = DB::table('items')
					->join('files', 'items.id', '=', 'files.id')
					->join('dupak_item_scores','dupak_item_scores.item_id','=','items.id')
					->select('items.*','files.*','dupak_item_scores.*','files.times as files_times','dupak_item_scores.item_score as dupak_item_scores_item_score')
					->where('dupak_item_scores.type','final')
					->where('dupak_item_scores.submission_id',$this_submission->previous_id)
					->where('files.submission_id',$id)->get();

					//untuk kedua isi ketika telah ada pengajuan baru
					$get_jml_penilai = DB::table('dupak_item_scores')
					->select('dupak_item_scores.*')
					->where('submission_id',$id)
					->where('type','final')
					->get();

				}

				$pdf = PDF::loadView('pages.timpenilai.detail_pak_terampil',compact('this_submission','pk_Position','unit_applicant','get_submission_items','get_final_dupak_scores','get_final_previous_scores','get_jml_institusions','get_jml_penilai','butir_terampil1A','butir_terampil1B','butir_terampil2A','butir_terampil2B','butir_terampil2C','butir_terampil3A','butir_terampil3B','butir_terampil3C','butir_terampil3D','butir_terampil4A','butir_terampil4B','butir_terampil4C','butir_terampil5A','butir_terampil5B','butir_terampil5C','butir_terampil5D','butir_terampil5E','butir_terampil5F'));
				return $pdf->stream('detail_submission.pdf');
				break;
				case 'Download':
				$butir_terampil1A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '1')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil1B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '1')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3)+0 asc')->get();

				$butir_terampil2A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil2B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil2C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '2')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();

				$butir_terampil3A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil3B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil3C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil3D = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '3')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'D')->orderByRaw('substr(id, 3) asc')->get();

				$butir_terampil4A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil4B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil4C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '4')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();

				$butir_terampil5A = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'A')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5B = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'B')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5C = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'C')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5D = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'D')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5E = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'E')->orderByRaw('substr(id, 3) asc')->get();
				$butir_terampil5F = Item::where('type','terampil')->where(\DB::raw('substr(id, 2, 1)'), '=' , '5')->where(\DB::raw('substr(id, 3, 1)'), '=' , 'F')->orderByRaw('substr(id, 3) asc')->get();

				$this_submission = DB::table('submissions')
				->join('users', 'submissions.nip', '=', 'users.id')
				->select('users.*','users.id as id_pemohon','users.birth_date as tglLahir', 'submissions.*')
				->where('submissions.id',$id)->first();
				$pk_Position = PkPosition::find($this_submission->pkPosition);
				$unit_applicant = Unit::find($this_submission->unit);

				//for baru institusion from submission files
				$get_submission_items = DB::table('files')
				->join('items', 'items.id', '=', 'files.id')
				->select('items.*','files.*')
				->where('files.submission_id',$id)->get();

				// get final score in dupak_item_scores
				$get_final_dupak_scores = DB::table('dupak_item_scores')
				->select('dupak_item_scores.*')
				->where('dupak_item_scores.submission_id',$id)
				->where('type','final')->get();

				//get previous score per items
				if($this_submission->previous_id == $this_submission->nip){
					$get_final_previous_scores = DB::table('tmp_scores')
					->select('tmp_scores.*')
					->where('tmp_scores.submission_id',$this_submission->previous_id)
					->get();

					$get_jml_institusions = DB::table('items')
					->join('files', 'items.id', '=', 'files.id')
					->join('tmp_scores','tmp_scores.item_id','=','items.id')
					->select('items.*','files.*','tmp_scores.*','files.times as files_times','tmp_scores.item_score as dupak_item_scores_item_score')
					->where('tmp_scores.submission_id',$this_submission->previous_id)
					->where('files.submission_id',$id)->get();

					$get_jml_penilai = DB::table('dupak_item_scores')
					->join('tmp_scores','tmp_scores.item_id','=','dupak_item_scores.item_id')
					->select('tmp_scores.*','tmp_scores.item_score as dupak_item_scores_item_score','dupak_item_scores.*')
					->where('tmp_scores.submission_id',$this_submission->previous_id)
					->where('dupak_item_scores.submission_id',$id)
					->where('dupak_item_scores.type','final')->get();

				}else{
					$get_final_previous_scores = DB::table('dupak_item_scores')
					->select('dupak_item_scores.*')
					->where('dupak_item_scores.submission_id',$this_submission->previous_id)
					->where('type','final')
					->get();

					$get_jml_institusions = DB::table('items')
					->join('files', 'items.id', '=', 'files.id')
					->join('dupak_item_scores','dupak_item_scores.item_id','=','items.id')
					->select('items.*','files.*','dupak_item_scores.*','files.times as files_times','dupak_item_scores.item_score as dupak_item_scores_item_score')
					->where('dupak_item_scores.type','final')
					->where('dupak_item_scores.submission_id',$this_submission->previous_id)
					->where('files.submission_id',$id)->get();

					//untuk kedua isi ketika telah ada pengajuan baru
					$get_jml_penilai = DB::table('dupak_item_scores')
					->select('dupak_item_scores.*')
					->where('submission_id',$id)
					->where('type','final')
					->get();
				}

				$pdf = PDF::loadView('pages.timpenilai.detail_pak_terampil',compact('this_submission','pk_Position','unit_applicant','get_submission_items','get_final_dupak_scores','get_final_previous_scores','get_jml_institusions','get_jml_penilai','butir_terampil1A','butir_terampil1B','butir_terampil2A','butir_terampil2B','butir_terampil2C','butir_terampil3A','butir_terampil3B','butir_terampil3C','butir_terampil3D','butir_terampil4A','butir_terampil4B','butir_terampil4C','butir_terampil5A','butir_terampil5B','butir_terampil5C','butir_terampil5D','butir_terampil5E','butir_terampil5F'));
				return $pdf->download($this_submission->id.'.pdf');
				
				break;
			}
		} catch (Exception $e) {
			return redirect()->route('detail_penilaian_final',$id)->with('result_gagal', 'Gagal ajukan nilai akhir sidang');
		}
	}


}
