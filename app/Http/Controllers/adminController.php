<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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


	public function manage_informations(){
		$informations = Information::orderBy('created_at', 'DESC')->get();
		return view('pages.admin.informations.manage', compact('informations'));
	}

	public function create_information(){
		return view('pages.admin.informations.create');
	}

	public function submit_information(){
		try {
			$idSub = Uuid::generate();
			Information::create([
				'id' => $idSub,
				'information_title' => request('information_title'),
				'information_content' => request('information_content'),
				'nip' => auth()->user()->id
			]);

			return redirect()->route('manage_informations')->with('result_berhasil', 'Berhasil membuat Informasi');
		} catch (Exception $e) {
			return redirect()->route('manage_informations')->with('result_gagal', 'Gagal membuat Informasi');
		}
	}

}
