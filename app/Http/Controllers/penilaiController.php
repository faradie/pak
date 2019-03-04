<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TeamDetail;

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

		$individual_scores = TeamDetail::all()
		->where('submission_id',$id);
		
    	return view('pages.timpenilai.detail_files',compact('penilaian_files','penilaian_submissions','individual_scores','id'));
    }

    public function submit_individual_score($id, Request $request){
    	try {
    		switch($request->submitbutton) {
				case 'Tolak': 
				$submission = Submission::find($id);
				return view('pages.tu.tu_reject',compact('submission'));

				break;

				case 'Ajukan': 
				$submission = TeamDetail::where('submission_id',$id)->where('nip',auth()->user()->id);
				$submission->update([
					'individual_score' => request('penilaian_individual')
				]);
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
    	return view('pages.timpenilai.final_detail_files',compact('id'));
    }

}
