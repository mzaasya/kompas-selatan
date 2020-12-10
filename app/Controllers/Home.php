<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home | KOSAN'
		];
		return view('Kosan/home', $data);
	}

	//--------------------------------------------------------------------

	public function tentang()
	{
		$data = [
			'title' => 'Tentang Kami | KOSAN'
		];
		return view('Kosan/tentang', $data);
	}

	//--------------------------------------------------------------------

	public function berita()
	{
		$data = [
			'title' => 'Berita | KOSAN'
		];
		return view('Kosan/berita', $data);
	}

	//--------------------------------------------------------------------

	public function ekstra()
	{
		$data = [
			'title' => 'Ekstra | KOSAN'
		];
		return view('Kosan/ekstra', $data);
	}

	//--------------------------------------------------------------------
	
}
