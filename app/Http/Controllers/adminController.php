<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Period;
use App\Information;
use Webpatser\Uuid\Uuid;

class adminController extends Controller
{
	public function manage_users(){
		$users = User::all()->where('is_approved','1');
        // $users = DB::table('users')->where('is_approved', '=', 1)->get();
        // dd($users);
		return view('pages.manageusers', compact('users'));
	}

	public function manage_period(){
		$periods = Period::all();
		return view('pages.admin.period.periods', compact('periods'));
	}

	public function create_period(Request $request){
		return view('pages.admin.period.create');
	}

	public function submit_period(){
		try {
			$idSub = Uuid::generate();
			Period::create([
				'id' => $idSub,
				'starts' => request('startDate'),
				'ends' => request('endDate')
			]);
			
			Information::create([
				'id' => $idSub,
				'information_title' => 'Pembukaan Periode Pengajuan '.\Carbon\Carbon::parse(request('startDate'))->format('d/M/Y').' - '.\Carbon\Carbon::parse(request('endDate'))->format('d/M/Y'),
				'information_content' => 'Informasi general untuk pembukaan Periode saja.',
				'nip' => auth()->user()->id
			]);

			return redirect()->route('manage_period')->with('result_berhasil', 'Berhasil membuat Periode');
		} catch (Exception $e) {
			return redirect()->route('manage_period')->with('result_gagal', 'Gagal membuat Periode');
		}
	}

	public function edit_period($id){
		$period = Period::find($id);
		return view('pages.admin.period.edit', compact('period'));
	}

	public function submit_period_edit($id, Request $request){
		try {
			$period =Period::find($id);
			$period->update([
				'starts' => request('startDate'),
				'ends' => request('endDate'),
			]);
			return redirect()->route('manage_period')->with('result_berhasil', 'Berhasil edit Periode');
		} catch (Exception $e) {
			return redirect()->route('manage_period')->with('result_gagal', 'Gagal edit Periode');
		}
	}

	public function destroy(Request $request){
		try {
			$deletePeriod = Period::findOrFail($request->name_id);
			$deletePeriod->delete();
			$deleteInformation = Information::findOrFail($request->name_id);
			$deleteInformation->delete();
			return redirect()->route('manage_period')->with('result_berhasil', 'Berhasil Hapus Periode');
		} catch (Exception $e) {
			return redirect()->route('manage_period')->with('result_gagal', 'Gagal Hapus Periode');
		}

	}

}
