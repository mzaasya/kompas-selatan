<?php namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Auth extends BaseController
{
    
    public function index()
	{
		$data = [
            'title' => 'Login | KOSAN',
            'validation' => \Config\Services::validation()
        ];
        if(session()->is_loggedin)
        {
            return redirect()->to('/profil');
        }else{
            return view('Auth/login', $data);
        }
    }
    // Login attempt --------------------------------------------------------------------
    public function loginAct(){
        if(!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Format email tidak sesuai'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/login')->withInput()->with('validation', $validation);
        }else{
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $user = $this->ModelUser->where('email', $email)->first();
            
            if($user){
                if($user['is_active'] == 1){
                    if(password_verify($password, $user['password'])){
                        $data = [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'is_loggedin' => true
                        ];
                        session()->set($data);
                        session()->setFlashData('pesan', 'Halo kak '.session()->name.', Selamat datang di <b>KOMPAS SELATAN</b> :)');
                        return redirect()->to('/');
                    }else{
                        session()->setFlashData('pesan', 'Password yang anda masukkan salah!');
                        return redirect()->to('/login')->withInput();
                    }
                }else{
                    session()->setFlashData('pesan', 'Kita gak tau email ini punya kamu atau bukan :( Cek emailmu yuk untuk konfirmasi');
                    return redirect()->to('/login');
                }
            }else{
                session()->setFlashData('pesan', 'Tidak ada anggota dengan email tersebut!');
                return redirect()->to('/login');
            }
        }
    }

    //--------------------------------------------------------------------
    // Buka view daftar
	public function daftar()
	{
        if(session()->is_loggedin){
            return redirect()->to('/profil');
        }else{
            $data = [
                'title' => 'Daftar | KOSAN',
                'validation' => \Config\Services::validation()
            ];
            return view('Auth/daftar', $data);
        }
    }
    // ---------------------------------------------------------------
    // Attempt Daftar
    public function daftarAct()
	{
        if(!$this->validate([
            'name' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'min_length' => 'Minimal 3 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Format email tidak sesuai',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'pass1' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ],
            'pass2' => [
                'rules' => 'required_with[pass1]|matches[pass1]',
                'errors' => [
                    'required_with' => 'Konfirmasi kata sandi',
                    'matches' => 'Kata sandi tidak sama'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/daftar')->withInput()->with('validation', $validation);
        }else{
            $email = $this->request->getVar('email');
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'is_active' => 0,
                'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
                'password' => password_hash($this->request->getVar('pass2'), PASSWORD_DEFAULT)
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->ModelUser->insert($data);
            $this->ModelToken->insert($user_token);
            $this->sendConfirm($token, 'verify');

            session()->setFlashData('pesan', 'Akun berhasil dibuat, silahkan cek email '.$this->request->getVar('email').' untuk mengaktifkan akunmu');
            return redirect()->to('/daftar');
        }
    }

    public function logout()
    {
        $data = ['id', 'name', 'email', 'is_loggedin'];
        session()->remove($data);
        session()->setFlashData('pesan', 'Kamu sudah berhasil logout!');
        return redirect()->to('/login');
    }

    // ------------------------------------------------------------------------
    // Beritaku
    public function beritaku()
    {
        $data = [
            'title' => 'Beritaku | KOSAN',
            'user' => $this->ModelUser->find(session()->id) 
        ];

        if(session()->is_loggedin){
            return view('Auth/beritaku', $data);
        }else{
            session()->setFlashData('pesan', 'Silahkan login untuk melihat fitur berita');
            return redirect()->to('/login');
        }
    }

    // ------------------------------------------------------------------------
    // Ekstraku
    public function ekstraku()
    {
        $data = [
            'title' => 'Ekstraku | KOSAN',
            'user' => $this->ModelUser->find(session()->id) 
        ];

        if(session()->is_loggedin){
            return view('Auth/ekstraku', $data);
        }else{
            session()->setFlashData('pesan', 'Silahkan login untuk melihat fitur lainnya');
            return redirect()->to('/login');
        }
    }
    
    // Pengumuman
    // -----------------------------------------------------------------
    public function pengumuman()
    {
        $data = [
            'title' => 'Pengumuman | KOSAN',
            'user' => $this->ModelUser->find(session()->id),
            'pengumuman' => $this->ModelPengumuman->findAll()
        ];

        if(session()->is_loggedin){
            return view('Auth/pengumuman', $data);
        }else{
            session()->setFlashData('pesan', 'Silahkan login untuk melihat fitur lainnya');
            return redirect()->to('/login');
        }
    }
    // buat pengumuman
    // ------------------------------------------------------------------
    public function pengumumanAct()
    {
        if(!$this->validate([
            'pengumuman' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Penerima pesan tidak boleh kosong',
                    'min_length' => 'Minimal 5 karakter'
                ]
            ]
        ])){
            session()->setFlashData('pesan-f', 'Pengumuman tidak boleh kosong & minimal 5 karakter');
            return redirect()->to('/pengumuman');
        }else{
            $data = [
                'pesan' => $this->request->getVar('pengumuman'),
                'created_at' => Time::now('Asia/Jakarta', 'id_ID')
            ];
            $this->ModelPengumuman->insert($data);
            session()->setFlashData('pesan', 'Pengumuman berhasil dibuat');
            return redirect()->to('/pengumuman');
        }
    }

    // hapus pengumuman
    // -----------------------------------------------------------------
    public function hapuspengumuman($id)
    {
        if(! session()->is_loggedin){
            session()->setFlashData('pesan', 'Silahkan login terlebih dahulu');
            return redirect()->to('/login');
        }else{
            $this->ModelPengumuman->delete($id);
            session()->setFlashData('pesan', 'Data berhasil dihapus!');
            return redirect()->to('/pengumuman');
        }
    }

    // kirim pesan
    // -------------------------------------------------------------------------------
    public function kirimpesan()
    {
        $query = [
            'id !=' => session()->id,
            'is_active' => 1
        ];

        if(session()->is_loggedin){
            $data = [
                'title' => 'Kirim Pesan | KOSAN',
                'user' => $this->ModelUser->find(session()->id),
                'alluser' => $this->ModelUser->where($query)->orderBy('name', 'ASC')->findAll()
            ];
            return view('Auth/kirimpesan', $data);
        }else{
            return redirect()->to('/login');
        }
    }
    // kirim pesan ke anggota
    // -------------------------------------------------------------------------------
    public function kirimpesanAct()
    {
        $name = $this->request->getVar('penerima');
        $user = $this->ModelUser->where('name', $name)->first();
        if($user){
            if(!$this->validate([
                'penerima' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Penerima pesan tidak boleh kosong'
                    ]
                ],
                'pesan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pesan tidak boleh kosong'
                    ]
                ]
            ])){
                session()->setFlashData('pesan-f', 'Pesan ataupun penerima pesan tidak boleh kosong');
                return redirect()->to('/kirimpesan');
            }else{
                $data = [
                    'pesan' => $this->request->getVar('pesan'),
                    'created_for' => $user['id'],
                    'created_by' => session()->id,
                    'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
                    'status' => 0
                ];
                $this->ModelPesan->insert($data);
                session()->setFlashData('pesan', 'Pesan telah terkirim');
                return redirect()->to('/kirimpesan');
            }
        }else{
            session()->setFlashData('pesan-f', 'Tidak ada anggota dengan nama '.$name);
            return redirect()->to('/kirimpesan');
        }
    }

    // Pesan masuk
    // -----------------------------------------------------------------------------
    public function pesanmasuk()
    {
        $data = [
            'title' => 'Pesan Masuk | KOSAN',
            'pesan' => $this->ModelPesan->where('created_for', session()->id)->orderBy('created_at', 'DESC')->paginate(20),
            'pager' => $this->ModelPesan->pager
        ];

        if(session()->is_loggedin){
            return view('Auth/pesanmasuk', $data);
        }else{
            session()->setFlashData('pesan', 'Silahkan login untuk melihat fitur lainnya');
            return redirect()->to('/login');
        }
    }
    
    // Pesan masuk
    // -----------------------------------------------------------------------------
    public function pesankeluar()
    {
        $data = [
            'title' => 'Pesan Keluar | KOSAN',
            'pesan' => $this->ModelPesan->where('created_by', session()->id)->orderBy('created_at', 'DESC')->paginate(20),
            'pager' => $this->ModelPesan->pager
        ];

        if(session()->is_loggedin){
            return view('Auth/pesankeluar', $data);
        }else{
            session()->setFlashData('pesan', 'Silahkan login untuk melihat fitur lainnya');
            return redirect()->to('/login');
        }
    }

    // detail pesan
    // -----------------------------------------------
    public function detailpesan($id)
    {
        $data = [
            'title' => 'Detail Pesan | KOSAN',
            'detail' => $this->ModelPesan->find($id)
        ];
        if(session()->is_loggedin){
            $this->ModelPesan->update($id, ['status' => 1]);
            return view('Auth/detailpesan', $data);
        }else{
            session()->setFlashData('pesan', 'Silahkan login untuk melihat fitur lainnya');
            return redirect()->to('/login');
        }
    }

    // Profil ------------------------------------------------------------
    public function profil(){
        $aktif = [
            'created_by' => session()->id,
            'tanggal >' => Time::now('Asia/Jakarta', 'id_ID')
        ];
        $data = [
            'title' => 'Profil | KOSAN',
            'user' => $this->ModelUser->find(session()->id),
            'kg_all' => $this->ModelKegiatan->where('created_by', session()->id)->countAllResults(),
            'kg_aktif' => $this->ModelKegiatan->where($aktif)->countAllResults()
        ];
        
        if(! session()->is_loggedin){
            return redirect()->to('/login');
        }else{
            return view('Auth/profile', $data);
        }
    }

    public function myprofile(){
        
        $data = [
            'title' => 'My Profile | KOSAN',
            'user' => $this->ModelUser->find(session()->id),
            'validation' => \Config\Services::validation(),
            'user' => $this->ModelUser->find(session()->id)
        ];
        
        if(! session()->is_loggedin){
            return redirect()->to('/login');
        }else{
            return view('Auth/myprofile', $data);
        }
    }

    public function editprofile()
    {
        // validate name
        if(! $this->validate([
            'editName' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'min_length' => 'Minimal 3 karakter'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/myprofile')->withInput()->with('validation', $validation);
        }

        // validate Address
        $address = $this->request->getVar('editAddress');
        if(! empty($address) && ! $this->validate([
            'editAddress' => [
                'rules' => 'min_length[5]',
                'errors' => [
                    'min_length' => 'Minimal 5 karakter atau kosongkan'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/myprofile')->withInput()->with('validation', $validation);
        }

        // validate phone
        $phone = $this->request->getVar('editPhone');
        if(! empty($phone) && ! $this->validate([
            'editPhone' => [
                'rules' => 'min_length[9]|numeric',
                'errors' => [
                    'min_length' => 'Minimal 9 angka atau kosongkan',
                    'numeric' => 'Hanya boleh angka'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/myprofile')->withInput()->with('validation', $validation);
        }
        // validate image
        $gambar = $this->request->getFile('editImage');
        if($gambar->isValid() && ! $this->validate([
            'editImage' => [
                'rules' => 'mime_in[editImage,image/png,image/jpg,image/jpeg,image/svg,image/webp]|max_size[editImage,5000]',
                'errors' => [
                    'mime_in' => 'Hanya boleh PNG, JPG, SVG, WeBP',
                    'max_size' => 'Ukuran maksimal 5 MB'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashData('pesan-f', 'Max 5 MB dengan format PNG/JPG/SVG/WeBP');
            return redirect()->to('/myprofile');
        }

        // Proses data if validation success
        if($gambar->isValid() && ! $gambar->hasMoved())
        {
            //hapus gambar lama jika ada
            $user = $this->ModelUser->find(session()->id);
            $imgUser = $user['image'];
            if($imgUser !== NULL && ! $imgUser == '')
            {
                $jalur = './img/user/'.$imgUser;
                unlink($jalur);
            }

            //simpan gambar baru
            $newname = $gambar->getRandomName();
            $gambar->move('./img/user', $newname);
            //masukkan data ke database
            $this->ModelUser->update(session()->id, ['image' => $newname]);

        }
        // get form input
        $data = [
            'name' => $this->request->getVar('editName'),
            'birth' => $this->request->getVar('editBirth'),
            'address' => $this->request->getVar('editAddress'),
            'phone' => $this->request->getVar('editPhone'),
            'updated_at' => Time::now('Asia/Jakarta', 'id_ID')
        ];
        // masukkan data ke database
        $this->ModelUser->update(session()->id, $data);
        session()->setFlashData('pesan', 'Data profil berhasil diubah');
        return redirect()->to('/myprofile');
        
    }

    // --------------------------------------------------------------------------
    // ubah password
    public function ubahpassword()
    {
        if(! session()->is_loggedin)
        {
            session()->setFlashData('pesan', 'Silahkan login terlebih dahulu');
            return redirect()->to('/login');
        }else{
            $data = [
                'title' => 'Ubah Password | KOSAN',
                'user' => $this->ModelUser->find(session()->id),
                'validation' => \Config\Services::validation()
            ];
            return view('Auth/ubahpass', $data);
        }
    }

    public function ubahpassAct()
    {
        if(! $this->validate([
            'cupass' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ],
            'newpass' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ],
            'repass' => [
                'rules' => 'required|min_length[8]|matches[newpass]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter',
                    'matches' => 'Password baru tidak sama'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/ubahpassword')->withInput()->with('validation', $validation);
        }else{
            // get data from database & form
            $user = $this->ModelUser->find(session()->id);
            $cupass = $this->request->getVar('cupass');
            // check matches password
            if(password_verify($cupass, $user['password']))
            {
                $newpass = password_hash($this->request->getVar('repass'), PASSWORD_DEFAULT);
                $this->ModelUser->update(session()->id, ['password' => $newpass]);
                
                $data = ['id', 'name', 'is_loggedin'];
                session()->remove($data);
                session()->setFlashData('pesan-s', 'Password berhasil diubah! silahkan login dengan password baru');
                return redirect()->to('/login');
            }else{
                session()->setFlashData('pesan', 'Password yang anda masukkan salah, silahkan coba lagi atau masuk ke menu lupa password');
                return redirect()->to('/ubahpassword');
            }
            
        }
    }

    // Lupa password
    // -------------------------------------------------------------------------------
    public function forgot()
    {
        $data = [
            'title' => 'Lupa Password | KOSAN',
            'user' => $this->ModelUser->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('Auth/forgot', $data);
    }

    public function forgotAct()
    {
        if(! $this->validate([
            'lupaEmail' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Format email tidak sesuai'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/forgot')->withInput()->with('validation', $validation);
        }

        // cek any user
        $email = $this->request->getVar('lupaEmail');
        $user = $this->ModelUser->where('email', $email)->first();
        $userToken = $this->ModelToken->where('email', $email)->first();

        if($user){
            if($userToken){
                session()->setFlashData('pesan', 'Email sudah dikirim ke '.$email.' Silahkan cek inbox email anda.');
                return redirect()->to('/forgot');
            }else{
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];
                $this->ModelToken->insert($user_token);
                $this->sendConfirm($token, 'forgot');
    
                session()->setFlashData('pesan-s', 'Email Reset Password berhasil dikirim. Silahkan cek email');
                return redirect()->to('/forgot');
            }
        }else{
            session()->setFlashData('pesan', 'Tidak ada anggota dengan email '.$email);
            return redirect()->to('/forgot');
        }
    }

    // ------------------------------------------------------------------------
    // verifikasi email
    public function verifyPass()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $user = $this->ModelUser->where('email', $email)->first();
        
        if($user){

            $user_token = $this->ModelToken->where('token', $token)->first();
            
            if($user_token){

                if(time() - $user_token['date_created'] < (60*60*24)){
                    
                    $data = [
                        'title' => 'Atur Ulang Password | KOSAN',
                        'email' => $email
                    ];
                    return view('Auth/resetPassword', $data);

                }else{
                    $this->ModelToken->where('email', $email)->delete();

                    session()->setFlashData('pesan', 'sudah melebihi batas Reset Password selama 24 jam, reset ulang yuk!');
                    return redirect()->to('/forgot');
                }

            }else{
                session()->setFlashData('pesan', 'Token reset password tidak ditemukan, silahkan kirim ulang!');
                return redirect()->to('/forgot');
            }          
        }else{
            session()->setFlashData('pesan', 'Tidak ada anggota dengan email '.$email);
            return redirect()->to('/forgot');
        }
    }

    // atur ulang sandi
    // ---------------------------------------------------------------------
    public function verifyPassAct()
    {
        $email = $this->request->getVar('email');

        if(! $this->validate([
            'pass1' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Kata sandi tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter'
                ]
            ],
            'pass2' => [
                'rules' => 'required|min_length[8]|matches[pass1]',
                'errors' => [
                    'required' => 'Kata sandi tidak boleh kosong',
                    'min_length' => 'Minimal 8 karakter',
                    'matches' => 'Kata sandi tidak sama'
                ]
            ]
        ])){
            session()->setFlashData('pesan', 'Password minimal 8 karakter dan kedua password harus sama');
            $data = [
                'title' => 'Atur Ulang Password | KOSAN',
                'email' => $email
            ];
            return view('Auth/resetPassword', $data);
        }else{
            $password = $this->request->getVar('pass2');
            $this->ModelUser->where('email', $email)->set(['password' => password_hash($password, PASSWORD_DEFAULT)])->update();
            $this->ModelToken->where('email', $email)->delete();
            session()->setFlashData('pesan-s', 'Password berhasil diatur ulang, silahkan login dengan password baru');
            return redirect()->to('/login');
        }
    }

    // ------------------------------------------------------------------------
    // Send Email
    private function sendConfirm($token, $type)
    {
        $email = \Config\Services::email();

        $email->setFrom('info@kompas-selatan.com', 'KOMPAS SELATAN');

        // send confirm for account verifying
        if($type == 'verify'){
            $email->setTo($this->request->getVar('email'));
            $email->setSubject('Konfirmasi Email Anggota');
            $email->setMessage('<h2 style="color:#151515;text-align:center;">Halo Kak <mark>'.$this->request->getVar('name').'</mark>, Selamat Datang di Pendaftaran Anggota Baru Kompas Selatan</h2>
            <p style="color:#151515;text-align:center;">Ini adalah email konfirmasi untuk mengaktifkan akunmu agar bisa login di website kompas selatan.</p>
            <p style="color:#151515;text-align:center;">Klik link berikut untuk konfirmasi email kamu.</p> 
            <p style="text-align:center;"><a style="font-size:1.1rem;text-decoration:none;color:green;" href="'.base_url().'/auth/verify?email='.$this->request->getVar('email').'&token='.urlencode($token).'"><b>Aktifkan Email</b></a></p>
            <p style="color:#151515;text-align:center;">Silahkan klik link berwarna hijau diatas untuk mengaktifkan akunmu.</p>
            <p style="color:#151515;text-align:center;">Salam hangat dari KOMPAS SELATAN.</p>');
        }

        // send email for forgot password
        if($type == 'forgot'){
            $email->setTo($this->request->getVar('lupaEmail'));
            $email->setSubject('Lupa Password Kompas Selatan');
            $email->setMessage('<h2 style="color:#151515;text-align:center;">Lupa Password Anggota Kompas Selatan</h2>
            <p style="color:#151515;text-align:center;">Sepertinya kamu lupa password akun Kompas Selatanmu.</p>
            <p style="color:#151515;text-align:center;">Jika kamu merasa tidak lupa password dan mengunakan fitur lupa password maka abaikan link dibawah.</p> 
            <p style="text-align:center;"><a style="font-size:1.1rem;text-decoration:none;color:green;" href="'.base_url().'/auth/verifyPass?email='.$this->request->getVar('lupaEmail').'&token='.urlencode($token).'"><b>Atur Ulang Password</b></a></p>
            <p style="color:#151515;text-align:center;">Silahkan klik link berwarna hijau diatas untuk mengatur ulang password kamu.</p>
            <p style="color:#151515;text-align:center;">Salam hangat dari KOMPAS SELATAN.</p>');
        }

        $email->send();
    }
    // ------------------------------------------------------------------------
    // verifikasi email
    public function verify()
    {
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');

        $user = $this->ModelUser->where('email', $email)->first();
        
        if($user){

            $user_token = $this->ModelToken->where('token', $token)->first();
            
            if($user_token){

                if(time() - $user_token['date_created'] < (60*60*24)){
                    $this->ModelUser->where('email', $email)->set(['is_active' => 1])->update();
                    $this->ModelToken->where('email', $email)->delete();
                    $data = [
                        'pesan' => 'Selamat datang di KOMPAS SELATAN. Kenalan yuk sama anggota lainnya, kamu bisa kirim pesan ke anggota lainnya lewat menu pesan, kamu juga bisa lengkapin data profil kamu di menu profil.',
                        'created_for' => $user['id'],
                        'created_by' => 55,
                        'created_at' => Time::now('Asia/Jakarta', 'id_ID'),
                        'status' => 0
                    ];
                    $this->ModelPesan->insert($data);

                    session()->setFlashData('pesan-s', 'Selamat bergabung di KOMPAS SELATAN. Akun dengan email '.$email.' berhasil diaktifkan, silahkan login!');
                    return redirect()->to('/login');
                }else{
                    $this->ModelToken->where('email', $email)->delete();
                    $this->ModelUser->where('email', $email)->delete();

                    session()->setFlashData('pesan-f', 'Yah emailmu gagal di aktifkan :( sudah melebihi batas aktifasi selama 24 jam, kirim lagi yuk email aktifasinya');
                    return redirect()->to('/daftar');
                }

            }else{
                session()->setFlashData('pesan-f', 'Yah emailmu gagal di aktifkan :( token aktifasinya gak ketemu atau mungkin akunmu sudah aktif.');
                return redirect()->to('/daftar');
            }          
        }else{
            session()->setFlashData('pesan-s', 'Yah emailnya gak ketemu :( coba daftar lagi yuk!');
            return redirect()->to('/login');
        }
    }
}