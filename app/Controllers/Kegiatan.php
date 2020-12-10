<?php namespace App\Controllers;
use CodeIgniter\I18n\Time;

class Kegiatan extends BaseController
{
    public function kegiatan()
	{
		$today = Time::now('Asia/Jakarta', 'id_ID');
		$data = [
			'title' => 'Kegiatan | KOSAN',
			'kegiatan' => $this->ModelKegiatan->orderBy('id', 'desc')->paginate(8),
			'pager' => $this->ModelKegiatan->pager,
			'av_event' => $this->ModelKegiatan->where('tanggal >', $today)->findAll(),
			'today' => Time::now('Asia/Jakarta', 'id_ID'),
			'user' => $this->ModelUser->findAll()
		];
		return view('Kosan/kegiatan', $data);
	}
// -----------------------------------------------------------------------------------------
	public function kegiatanLama()
	{
		$today = Time::now('Asia/Jakarta', 'id_ID');
		$data = [
			'title' => 'Kegiatan | KOSAN',
			'kegiatan' => $this->ModelKegiatan->orderBy('id', 'asc')->paginate(8),
			'pager' => $this->ModelKegiatan->pager,
			'av_event' => $this->ModelKegiatan->where('tanggal >', $today)->findAll(),
			'today' => Time::now('Asia/Jakarta', 'id_ID'),
			'user' => $this->ModelUser->findAll()
		];
		return view('Kosan/kegiatan', $data);
	}
// -----------------------------------------------------------------------------------------	
	public function kegiatanAktif()
	{
		$today = Time::now('Asia/Jakarta', 'id_ID');
		$data = [
			'title' => 'Kegiatan | KOSAN',
			'kegiatan' => $this->ModelKegiatan->where('tanggal >', $today)->orderBy('id', 'desc')->paginate(8),
			'pager' => $this->ModelKegiatan->pager,
			'av_event' => $this->ModelKegiatan->where('tanggal >', $today)->findAll(),
			'today' => Time::now('Asia/Jakarta', 'id_ID')
		];
		return view('Kosan/kegiatan', $data);
	}
// -----------------------------------------------------------------------------------------
	public function kegiatanPasif()
	{
		$today = Time::now('Asia/Jakarta', 'id_ID');
		$data = [
			'title' => 'Kegiatan | KOSAN',
			'kegiatan' => $this->ModelKegiatan->where('tanggal <', $today)->orderBy('id', 'desc')->paginate(8),
			'pager' => $this->ModelKegiatan->pager,
			'av_event' => $this->ModelKegiatan->where('tanggal >', $today)->findAll(),
			'today' => Time::now('Asia/Jakarta', 'id_ID')
		];
		return view('Kosan/kegiatan', $data);
    }
// -----------------------------------------------------------------------------------------
    public function detail($id)
    {
		if(! session()->is_loggedin)
		{
			session()->setFlashData('pesan', 'Silahkan login untuk melihat detail kegiatan');
			return redirect()->to('/login');
		}else{
			$data = [
				'title' => 'Detail Kegiatan | KOSAN',
				'kg' => $this->ModelKegiatan->find($id)
			];
			return view('Kosan/detailKegiatan', $data);
		}
	}
	
	// -----------------------------------------------------------------------------------------
    public function kegiatanku()
    {
		$data = [
			'title' => 'Kegiatanku | KOSAN',
			'kegiatan' => $this->ModelKegiatan->orderBy('id', 'desc')->where('created_by', session()->id)->paginate(8),
			'pager' => $this->ModelKegiatan->pager,
			'user' => $this->ModelUser->find(session()->id)
		];
		if(session()->is_loggedin){
			return view('Auth/kegiatanku', $data);
		}else{
			session()->setFlashData('pesan', 'Silahkan login terlebih dahulu');
			return redirect()->to('/login');
		}
	}
	
	// -----------------------------------------------------------------------------------------
	public function kegiatanbaru()
	{
		$data = [
			'title' => 'Kegiatan Baru | KOSAN',
			'user' => $this->ModelUser->find(session()->id),
			'validation' => \Config\Services::validation()
		];
		if(session()->is_loggedin){
			return view('Auth/kegiatanbaru', $data);
		}else{
			session()->setFlashData('pesan', 'Silahkan login terlebih dahulu');
			return redirect()->to('/login');
		}
	}

	// -----------------------------------------------------------------------------------------
	public function kegiatanbaruAct()
	{
		
		if(! $this->validate([
			'judul' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Judul tidak boleh kosong',
					'min_length' => 'Minimal 3 karakter'
				]
			],
			'deskripsi' => [
				'rules' => 'required|min_length[5]',
				'errors' => [
					'required' => 'Deskripsi tidak boleh kosong',
					'min_length' => 'Minimal 5 karakter'
				]
			],
			'tujuan' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Tujuan tidak boleh kosong',
					'min_length' => 'Minimal 3 karakter'
				]
			],
			'titik_kumpul' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Tujuan tidak boleh kosong',
					'min_length' => 'Minimal 3 karakter'
				]
			],
			'tanggal' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'Tanggal tidak boleh kosong',
					'valid_date' => 'Format tanggal tidak sesuai'
				]
			],
			'jam' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Jam tidak boleh kosong'
				]
			],
			'biaya' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Biaya tidak boleh kosong',
					'numeric' => 'Hanya boleh angka'
				]
			]
		])){
			$validation = \Config\Services::validation();
			return redirect()->to('/kegiatanbaru')->withInput()->with('validation', $validation);
		}

		$gambar = $this->request->getFile('kgimage');

		if($gambar->isValid() && ! $gambar->hasMoved()){
			$newname = $gambar->getRandomName();
			if(! $this->validate([
				'kgimage' => [
					'rules' => 'max_size[kgimage,5000]|mime_in[kgimage,image/png,image/jpg,image/jpeg,image/svg,image/webp]',
					'errors' => [
						'max_size' => 'Maksimal 5 MB',
						'mime_in' => 'Hanya boleh PNG, JPG, SVG, WeBP'
					]
				]
			])){
				session()->setFlashData('pesan', 'Ukuran gambar maksimal 5 MB dengan format PNG/JPG/SVG/WeBP');
				return redirect()->to('/kegiatanbaru');
			}else{
				// get form input
				$data = [
					'judul' => $this->request->getVar('judul'),
					'deskripsi' => $this->request->getVar('deskripsi'),
					'tujuan' => $this->request->getVar('tujuan'),
					'titik_kumpul' => $this->request->getVar('titik_kumpul'),
					'tanggal' => $this->request->getVar('tanggal'),
					'jam' => $this->request->getVar('jam'),
					'biaya' => $this->request->getVar('biaya'),
					'gambar' => $newname,
					'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
					'created_by' => session()->id
				];
				$gambar->move('./img/kegiatan', $newname);
				$this->ModelKegiatan->insert($data);
				session()->setFlashData('pesan', 'Kegiatan berhasil ditambahkan');
				return redirect()->to('/kegiatanku');
			}
		}else{
			// get form input
			$data = [
				'judul' => $this->request->getVar('judul'),
				'deskripsi' => $this->request->getVar('deskripsi'),
				'tujuan' => $this->request->getVar('tujuan'),
				'titik_kumpul' => $this->request->getVar('titik_kumpul'),
				'tanggal' => $this->request->getVar('tanggal'),
				'jam' => $this->request->getVar('jam'),
				'biaya' => $this->request->getVar('biaya'),
				'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
				'created_by' => session()->id
			];
			$this->ModelKegiatan->insert($data);
			session()->setFlashData('pesan', 'Kegiatan berhasil ditambahkan');
			return redirect()->to('/kegiatanku');
		}
	}

	// --------------------------------------------------------------------------------

	public function hapuskegiatan($id)
	{
		$kg = $this->ModelKegiatan->find($id);

		if(session()->is_loggedin && $kg['created_by'] == session()->id)
		{
            if($kg['gambar'] !== NULL && $kg['gambar'] !== '')
            {
                $jalur = './img/kegiatan/'.$kg['gambar'];
                unlink($jalur);
			}
			
			$this->ModelKegiatan->delete($id);
			session()->setFlashData('pesan', 'Kegiatan berhasil dihapus');
			return redirect()->to('/kegiatanku');

		}else{
			session()->setFlashData('pesan-f', 'Kegiatan tidak dapat dihapus');
			return redirect()->to('/');
		}
	}

	// -----------------------------------------------------------------------------

	public function editkegiatan($id)
	{
		$data = [
			'title' => 'Edit Kegiatan | KOSAN',
			'user' => $this->ModelUser->find(session()->id),
			'kg' => $this->ModelKegiatan->find($id),
			'validation' => \Config\Services::validation()
		];

		return view('Auth/kegiatanedit', $data);
	}

	// -----------------------------------------------------------------------------

	public function editkegiatanAct($id)
	{

		if(! $this->validate([
			'judul' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Judul tidak boleh kosong',
					'min_length' => 'Minimal 3 karakter'
				]
			],
			'deskripsi' => [
				'rules' => 'required|min_length[5]',
				'errors' => [
					'required' => 'Deskripsi tidak boleh kosong',
					'min_length' => 'Minimal 5 karakter'
				]
			],
			'tujuan' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Tujuan tidak boleh kosong',
					'min_length' => 'Minimal 3 karakter'
				]
			],
			'titik_kumpul' => [
				'rules' => 'required|min_length[3]',
				'errors' => [
					'required' => 'Tujuan tidak boleh kosong',
					'min_length' => 'Minimal 3 karakter'
				]
			],
			'tanggal' => [
				'rules' => 'required|valid_date',
				'errors' => [
					'required' => 'Tanggal tidak boleh kosong',
					'valid_date' => 'Format tanggal tidak sesuai'
				]
			],
			'jam' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Jam tidak boleh kosong'
				]
			],
			'biaya' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Biaya tidak boleh kosong',
					'numeric' => 'Hanya boleh angka'
				]
			]
		])){
			$validation = \Config\Services::validation();
			return redirect()->to('./editkegiatan/'.$id)->withInput()->with('validation', $validation);
		}
		// ambil data gambar dari form
		$gambar1 = $this->request->getFile('kgimage1');
		$gambar2 = $this->request->getFile('kgimage2');
		$gambar3 = $this->request->getFile('kgimage3');
		$gambar4 = $this->request->getFile('kgimage4');

		// ambil data gambar dari database
		$kegiatan = $this->ModelKegiatan->find($id);
		$img1 = $kegiatan['gambar'];
		$img2 = $kegiatan['gambar1'];
		$img3 = $kegiatan['gambar2'];
		$img4 = $kegiatan['gambar3'];

		// validasi gambar
		if($gambar1->isValid()){
			if(! $this->validate([
				'kgimage1' => [
					'rules' => 'max_size[kgimage1,5000]|mime_in[kgimage1,image/png,image/jpg,image/jpeg,image/svg,image/webp]',
					'errors' => [
						'max_size' => 'Maksimal 5 MB',
						'mime_in' => 'Hanya boleh PNG, JPG, SVG, WeBP'
					]
				]
			])){
				session()->setFlashData('pesan', 'Ukuran gambar maksimal 5 MB dengan format PNG/JPG/SVG/WeBP');
				return redirect()->to('./editkegiatan/'.$id);
			}else{
				// hapus gambar jika ada
				if($img1 !== NULL && $img1 !== ''){
					$jalur = './img/kegiatan/'.$img1;
					unlink($jalur);
				}
				// pindahkan gambar
				$newname = $gambar1->getRandomName();
				$gambar1->move('./img/kegiatan', $newname);
				// update ke database
				$this->ModelKegiatan->update($id, ['gambar' => $newname]);
			}
		}
		
		if($gambar2->isValid()){
			if(! $this->validate([
				'kgimage2' => [
					'rules' => 'max_size[kgimage2,5000]|mime_in[kgimage2,image/png,image/jpg,image/jpeg,image/svg,image/webp]',
					'errors' => [
						'max_size' => 'Maksimal 5 MB',
						'mime_in' => 'Hanya boleh PNG, JPG, SVG, WeBP'
					]
				]
			])){
				session()->setFlashData('pesan', 'Ukuran gambar maksimal 5 MB dengan format PNG/JPG/SVG/WeBP');
				return redirect()->to('./editkegiatan/'.$id);
			}else{
				// hapus gambar jika ada
				if($img2 !== NULL && $img2 !== ''){
					$jalur = './img/kegiatan/'.$img2;
					unlink($jalur);
				}
				// pindahkan gambar
				$newname = $gambar2->getRandomName();
				$gambar2->move('./img/kegiatan', $newname);
				// update ke database
				$this->ModelKegiatan->update($id, ['gambar1' => $newname]);
			}
		}
		
		if($gambar3->isValid()){
			if(! $this->validate([
				'kgimage3' => [
					'rules' => 'max_size[kgimage3,5000]|mime_in[kgimage3,image/png,image/jpg,image/jpeg,image/svg,image/webp]',
					'errors' => [
						'max_size' => 'Maksimal 5 MB',
						'mime_in' => 'Hanya boleh PNG, JPG, SVG, WeBP'
					]
				]
			])){
				session()->setFlashData('pesan', 'Ukuran gambar maksimal 5 MB dengan format PNG/JPG/SVG/WeBP');
				return redirect()->to('./editkegiatan/'.$id);
			}else{
				// hapus gambar jika ada
				if($img3 !== NULL && $img3 !== ''){
					$jalur = './img/kegiatan/'.$img3;
					unlink($jalur);
				}
				// pindahkan gambar
				$newname = $gambar3->getRandomName();
				$gambar3->move('./img/kegiatan', $newname);
				// update ke database
				$this->ModelKegiatan->update($id, ['gambar2' => $newname]);
			}
		}
		
		if($gambar4->isValid()){
			if(! $this->validate([
				'kgimage4' => [
					'rules' => 'max_size[kgimage4,5000]|mime_in[kgimage4,image/png,image/jpg,image/jpeg,image/svg,image/webp]',
					'errors' => [
						'max_size' => 'Maksimal 5 MB',
						'mime_in' => 'Hanya boleh PNG, JPG, SVG, WeBP'
					]
				]
			])){
				session()->setFlashData('pesan', 'Ukuran gambar maksimal 5 MB dengan format PNG/JPG/SVG/WeBP');
				return redirect()->to('./editkegiatan/'.$id);
			}else{
				// hapus gambar jika ada
				if($img4 !== NULL && $img4 !== ''){
					$jalur = './img/kegiatan/'.$img4;
					unlink($jalur);
				}
				// pindahkan gambar
				$newname = $gambar4->getRandomName();
				$gambar4->move('./img/kegiatan', $newname);
				// update ke database
				$this->ModelKegiatan->update($id, ['gambar3' => $newname]);
			}
		}

		// get form input
		$data = [
			'judul' => $this->request->getVar('judul'),
			'deskripsi' => $this->request->getVar('deskripsi'),
			'tujuan' => $this->request->getVar('tujuan'),
			'titik_kumpul' => $this->request->getVar('titik_kumpul'),
			'tanggal' => $this->request->getVar('tanggal'),
			'jam' => $this->request->getVar('jam'),
			'biaya' => $this->request->getVar('biaya'),
			'updated_at' => Time::now('Asia/Jakarta', 'id_ID')
		];

		$this->ModelKegiatan->update($id, $data);
		session()->setFlashData('pesan-s', 'Data kegiatan berhasil diubah');
		return redirect()->to('./editkegiatan/'.$id);
	}
}