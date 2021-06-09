<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Menu_list;
use App\Models\Kategori_menu;
use App\Models\Pelanggan;
use App\Models\Status_list;
use App\Models\Pemesanan;
use App\Models\Detail_pemesanan;
use App\Models\Pembayaran;
use Session;
use Storage;

class BackendController extends Controller
{
    // Login Section
    public function login(){
        if (Auth::check()){
            $user = Auth::user();
            if ($user->level == '0'){
                return redirect()->route('backend.superadmin');
            } elseif ($user->level == '1'){
                return redirect()->route('backend.admin');
            }
        }
        return view('backend.login.index');
    }

    public function loginDo(Request $request){
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == '0') {
                return redirect()->route('backend.superadmin');
            } elseif ($user->level == '1') {
                return redirect()->route('backend.admin');
            }
            return redirect()->route('home');
        }
        return redirect()->route('backend.login')->with('error',"Username atau password salah");
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.login')->with('error', "Berhasil Logout");
    }

    // SuperAdmin Section
    public function superadmin(){
        $user = Auth::user();

        $users = User::all();
        $menus = Menu_list::all();
        $kategoris = Kategori_menu::all();
        $pelanggans = Pelanggan::all();
        $statuses = Status_list::all();
        $pemesanans = Pemesanan::all();
        $details = Detail_pemesanan::all();
        $pembayarans = Pembayaran::all();

        $count = ([
            'users' => $users->count(),
            'menus' => $menus->count(),
            'kategoris' => $kategoris->count(),
            'pelanggans' => $pelanggans->count(),
            'statuses' => $statuses->count(),
            'pemesanans' => $pemesanans->count(),
            'details' => $details->count(),
            'pembayarans' => $pembayarans->count(),
        ]);

        return view('backend.superadmin.index', ['user' => $user, 'count' => $count]);
    }

    public function user(){
        $user = Auth::user();
        $users = User::all();
        return view('backend.superadmin.user.index', ['user' => $user, 'users' => $users]);
    }

    public function userAdd(){
        $user = Auth::user();
        return view('backend.superadmin.user.form', ['user' => $user]);
    }

    public function userAddDo(Request $request){
        $users = new User;

        $request->validate([
            'username' => 'required|alpha|min:5|max:100|unique:user',
            'password' => ['required', 'confirmed', Password::min(8), 'min:5', 'max:100'],
            'nama' => 'required',
            'level' => 'required|integer',
        ]);

        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        $users->nama = $request->nama;
        $users->level = $request->level;
        $users->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.user');
    }

    public function userEdit($id){
        $user = Auth::user();
        $users = User::find($id);
        if (!$users){
            abort(404);
        }

        return view('backend.superadmin.user.form', ['user' => $user, 'users' => $users]);
    }

    public function userEditDo($id, Request $request){
        $users = User::find($id);
        if (!$users){
            abort(404);
        }

        $request->validate([
            'username' => ['required', 'min:5', 'alpha', 'max:100', Rule::unique('user')->ignore($users)],
            'nama' => 'required',
            'level' => 'required|integer',
        ]);
        if ($request->password){
            $request->validate([
                'password' => ['required', 'confirmed', Password::min(8), 'min:5', 'max:100'],
            ]);
        }

        $users->username = $request->username;
        $users->nama = $request->nama;
        $users->level = $request->level;
        if ($request->password){
            $users->password = bcrypt($request->password);
        }
        $users->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.user');
    }

    public function userDeleteDo($id){
        User::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.user');
    }

    public function menu(){
        $user = Auth::user();
        $menus = Menu_list::all();
        return view('backend.superadmin.menu.index', ['user' => $user, 'menus' => $menus]);
    }

    public function menuAdd(){
        $user = Auth::user();
        $kategoris = Kategori_menu::all();
        return view('backend.superadmin.menu.form', ['user' => $user, 'kategoris' => $kategoris]);
    }

    public function menuAddDo(Request $request){
        $menus = new Menu_list;

        $request->validate([
            'menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:1',
            'kategori' => 'required|integer',
            'img' => 'required|image|max:512',
            'status' => 'required|integer',
        ]);

        $menus->menu = $request->menu;
        $menus->deskripsi = $request->deskripsi;
        $menus->harga = $request->harga;
        $menus->id_kategori = $request->kategori;
        $menus->status = $request->status;

        $imgPath = $request->img->store('/images/frontend/menu', 'local');
        $menus->img = $imgPath;

        $menus->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.menu');
    }

    public function menuEdit($id){
        $user = Auth::user();
        $menus = Menu_list::find($id);
        if (!$menus){
            abort(404);
        }
        $kategoris = Kategori_menu::all();

        return view('backend.superadmin.menu.form', ['user' => $user, 'menus' => $menus, 'kategoris' => $kategoris]);
    }

    public function menuEditDo($id, Request $request){
        $menus = Menu_list::find($id);
        if (!$menus){
            abort(404);
        }

        $request->validate([
            'menu' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:1',
            'kategori' => 'required|integer',
            'status' => 'required|integer',
        ]);
        if ($request->img){
            $request->validate([
                'img' => 'required|image|max:512',
            ]);
        }

        $menus->menu = $request->menu;
        $menus->deskripsi = $request->deskripsi;
        $menus->harga = $request->harga;
        $menus->id_kategori = $request->kategori;
        $menus->status = $request->status;
        if ($request->img){
            Storage::delete($menus->img);
            $imgPath = $request->img->store('/images/frontend/menu', 'local');
            $menus->img = $imgPath;
        }
        $menus->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.menu');
    }

    public function menuDeleteDo($id){
        $menus = Menu_list::find($id);
        Storage::delete($menus->img);

        Menu_list::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.menu');
    }

    public function kategori(){
        $user = Auth::user();
        $kategoris = Kategori_menu::all();
        return view('backend.superadmin.kategori.index', ['user' => $user, 'kategoris' => $kategoris]);
    }

    public function kategoriAdd(){
        $user = Auth::user();
        return view('backend.superadmin.kategori.form', ['user' => $user]);
    }

    public function kategoriAddDo(Request $request){
        $kategoris = new Kategori_menu;

        $request->validate([
            'kategori' => 'required'
        ]);

        $kategoris->kategori = $request->kategori;
        $kategoris->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.kategori');
    }

    public function kategoriEdit($id){
        $user = Auth::user();
        $kategoris = Kategori_menu::find($id);
        if (!$kategoris){
            abort(404);
        }

        return view('backend.superadmin.kategori.form', ['user' => $user, 'kategoris' => $kategoris]);
    }

    public function kategoriEditDo($id, Request $request){
        $kategoris = Kategori_menu::find($id);
        if (!$kategoris){
            abort(404);
        }

        $request->validate([
            'kategori' => 'required'
        ]);

        $kategoris->kategori = $request->kategori;
        $kategoris->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.kategori');
    }

    public function kategoriDeleteDo($id){
        Kategori_menu::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.kategori');
    }

    public function pelanggan(){
        $user = Auth::user();
        $pelanggans = Pelanggan::all();
        return view('backend.superadmin.pelanggan.index', ['user' => $user, 'pelanggans' => $pelanggans]);
    }

    public function pelangganAdd(){
        $user = Auth::user();
        return view('backend.superadmin.pelanggan.form', ['user' => $user]);
    }

    public function pelangganAddDo(Request $request){
        $pelanggans = new Pelanggan;

        $request->validate([
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:pelanggan',
        ]);

        $id_pelanggan = mt_rand(100000000, 999999999);
        $count = 0;
        while(Pelanggan::find($id_pelanggan)){
            $id_pelanggan = mt_rand(100000000, 999999999);
            $count++;
            if($count == 899999999){
                return redirect()->route('error')->withErrors(['type' => '501','message' => 'Jumlah pelanggan sudah mencapai batas maksimal']);
            }
        }

        $pelanggans->id_pelanggan = $id_pelanggan;
        $pelanggans->nama = $request->nama;
        $pelanggans->email = $request->email;
        $pelanggans->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.pelanggan');
    }

    public function pelangganEdit($id){
        $user = Auth::user();
        $pelanggans = Pelanggan::find($id);
        if (!$pelanggans){
            abort(404);
        }

        return view('backend.superadmin.pelanggan.form', ['user' => $user, 'pelanggans' => $pelanggans]);
    }

    public function pelangganEditDo($id, Request $request){
        $pelanggans = Pelanggan::find($id);
        if (!$pelanggans){
            abort(404);
        }

        $request->validate([
            'nama' => 'required|max:50',
            'email' => ['required', 'email', Rule::unique('pelanggan')->ignore($pelanggans)],
        ]);

        $pelanggans->nama = $request->nama;
        $pelanggans->email = $request->email;
        $pelanggans->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.pelanggan');
    }

    public function pelangganDeleteDo($id){
        Pelanggan::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.pelanggan');
    }

    public function status(){
        $user = Auth::user();
        $statuses = Status_list::all();
        return view('backend.superadmin.status.index', ['user' => $user, 'statuses' => $statuses]);
    }

    public function statusAdd(){
        $user = Auth::user();
        return view('backend.superadmin.status.form', ['user' => $user]);
    }

    public function statusAddDo(Request $request){
        $statuses = new Status_list;

        $request->validate([
            'id_status' => 'required|numeric|min:1|unique:status_list',
            'status' => 'required',
        ]);

        $statuses->id_status = $request->id_status;
        $statuses->status = $request->status;
        $statuses->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.status');
    }

    public function statusEdit($id){
        $user = Auth::user();
        $statuses = Status_list::find($id);
        if (!$statuses){
            abort(404);
        }

        return view('backend.superadmin.status.form', ['user' => $user, 'statuses' => $statuses]);
    }

    public function statusEditDo($id, Request $request){
        $statuses = Status_list::find($id);
        if (!$statuses){
            abort(404);
        }

        $request->validate([
            'id_status' => ['required', 'numeric', 'min:1', Rule::unique('status_list')->ignore($statuses)],
            'status' => 'required',
        ]);

        $statuses->id_status = $request->id_status;
        $statuses->status = $request->status;
        $statuses->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.status');
    }

    public function statusDeleteDo($id){
        Status_list::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.status');
    }

    public function pemesanan(){
        $user = Auth::user();
        $pemesanans = Pemesanan::all();
        $details = Detail_pemesanan::all();
        $pembayarans = Pembayaran::all();
        return view('backend.superadmin.pemesanan.index', ['user' => $user, 'pemesanans' => $pemesanans, 'details' => $details, 'pembayarans' => $pembayarans]);
    }

    public function pemesananAdd(){
        $user = Auth::user();
        $pelanggans = Pelanggan::all();
        $statuses = Status_list::all();
        return view('backend.superadmin.pemesanan.form', ['user' => $user, 'pelanggans' => $pelanggans, 'statuses' => $statuses]);
    }

    public function pemesananAddDo(Request $request){
        $pemesanans = new Pemesanan;

        $request->validate([
            'id_pelanggan' => 'required|numeric',
            'tgl_pemesanan' => 'required|date',
            'id_status' => 'required|numeric',
        ]);

        $pemesanans->id_pelanggan = $request->id_pelanggan;
        $pemesanans->tgl_pemesanan = $request->tgl_pemesanan;
        $pemesanans->id_status = $request->id_status;
        $pemesanans->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.pemesanan');
    }

    public function pemesananEdit($id){
        $user = Auth::user();
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans){
            abort(404);
        }
        $pelanggans = Pelanggan::all();
        $statuses = Status_list::all();

        return view('backend.superadmin.pemesanan.form', ['user' => $user, 'pemesanans' => $pemesanans, 'pelanggans' => $pelanggans, 'statuses' => $statuses]);
    }

    public function pemesananEditDo($id, Request $request){
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans){
            abort(404);
        }

        $request->validate([
            'id_pelanggan' => 'required|numeric',
            'tgl_pemesanan' => 'required|date',
            'id_status' => 'required|numeric',
        ]);

        $pemesanans->id_pelanggan = $request->id_pelanggan;
        $pemesanans->tgl_pemesanan = $request->tgl_pemesanan;
        $pemesanans->id_status = $request->id_status;
        $pemesanans->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.pemesanan');
    }

    public function pemesananDeleteDo($id){
        Pemesanan::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.pemesanan');
    }

    public function detail(){
        $user = Auth::user();
        $details = Detail_pemesanan::all();
        return view('backend.superadmin.detail.index', ['user' => $user, 'details' => $details]);
    }

    public function detailAdd(){
        $user = Auth::user();
        $pemesanans = Pemesanan::all();
        $menus = Menu_list::all();
        return view('backend.superadmin.detail.form', ['user' => $user, 'pemesanans' => $pemesanans, 'menus' => $menus]);
    }

    public function detailAddDo(Request $request){
        $details = new Detail_pemesanan;

        $request->validate([
            'id_pemesanan' => 'required|numeric',
            'id_menu' => 'required|numeric',
            'kuantitas' => 'required|numeric|min:1|max:500',
        ]);

        $details->id_pemesanan = $request->id_pemesanan;
        $details->id_menu = $request->id_menu;
        $details->kuantitas = $request->kuantitas;
        $details->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.detail');
    }

    public function detailEdit($id){
        $user = Auth::user();
        $details = Detail_pemesanan::find($id);
        if (!$details){
            abort(404);
        }
        $pemesanans = Pemesanan::all();
        $menus = Menu_list::all();

        return view('backend.superadmin.detail.form', ['user' => $user, 'details' => $details, 'pemesanans' => $pemesanans, 'menus' => $menus]);
    }

    public function detailEditDo($id, Request $request){
        $details = Detail_pemesanan::find($id);
        if (!$details){
            abort(404);
        }

        $request->validate([
            'id_pemesanan' => 'required|numeric',
            'id_menu' => 'required|numeric',
            'kuantitas' => 'required|numeric|min:1|max:500',
        ]);

        $details->id_pemesanan = $request->id_pemesanan;
        $details->id_menu = $request->id_menu;
        $details->kuantitas = $request->kuantitas;
        $details->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.detail');
    }

    public function detailDeleteDo($id){
        Detail_pemesanan::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.detail');
    }

    public function pembayaran(){
        $user = Auth::user();
        $pembayarans = Pembayaran::all();
        return view('backend.superadmin.pembayaran.index', ['user' => $user, 'pembayarans' => $pembayarans]);
    }

    public function pembayaranAdd(){
        $user = Auth::user();
        $pemesanans = Pemesanan::all();
        return view('backend.superadmin.pembayaran.form', ['user' => $user, 'pemesanans' => $pemesanans]);
    }

    public function pembayaranAddDo(Request $request){
        $pembayarans = new Pembayaran;

        $request->validate([
            'id_pemesanan' => 'required|numeric|unique:pembayaran',
            'total_bayar' => 'required|numeric|min:1',
            'tgl_pembayaran' => 'required|date',
        ]);

        $pembayarans->id_pemesanan = $request->id_pemesanan;
        $pembayarans->total_bayar = $request->total_bayar;
        $pembayarans->tgl_pembayaran = $request->tgl_pembayaran;
        $pembayarans->save();
        
        Session::flash('message', 'Berhasil menambahkan data');
        Session::flash('message-class', 'success');
        return redirect()->route('backend.superadmin.pembayaran');
    }

    public function pembayaranEdit($id){
        $user = Auth::user();
        $pembayarans = Pembayaran::find($id);
        if (!$pembayarans){
            abort(404);
        }
        $pemesanans = Pemesanan::all();

        return view('backend.superadmin.pembayaran.form', ['user' => $user, 'pembayarans' => $pembayarans, 'pemesanans' => $pemesanans]);
    }

    public function pembayaranEditDo($id, Request $request){
        $pembayarans = Pembayaran::find($id);
        if (!$pembayarans){
            abort(404);
        }

        $request->validate([
            'id_pemesanan' => ['required', 'numeric', Rule::unique('pembayaran')->ignore($pembayarans)],
            'total_bayar' => 'required|numeric|min:1',
            'tgl_pembayaran' => 'required|date',
        ]);

        $pembayarans->id_pemesanan = $request->id_pemesanan;
        $pembayarans->total_bayar = $request->total_bayar;
        $pembayarans->tgl_pembayaran = $request->tgl_pembayaran;
        $pembayarans->save();
        
        Session::flash('message', 'Berhasil meng-update data');
        Session::flash('message-class', 'warning');
        return redirect()->route('backend.superadmin.pembayaran');
    }

    public function pembayaranDeleteDo($id){
        Pembayaran::destroy($id);
        
        Session::flash('message', 'Berhasil menghapus data');
        Session::flash('message-class', 'danger');
        return redirect()->route('backend.superadmin.pembayaran');
    }

    public function laporan(){
        $user = Auth::user();
        return view('backend.superadmin.laporan.index', ['user' => $user]);
    }

    public function laporanGenerateDo(Request $request){
        $user = Auth::user();

        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
        ]);

        $pembayarans = Pembayaran::all()->where('tgl_pembayaran', '>=', $request->tgl_awal)->where('tgl_pembayaran', '<=', $request->tgl_akhir);
        $details = Detail_pemesanan::all();

        return view('backend.superadmin.laporan.generate', ['user' => $user, 'pembayarans' => $pembayarans, 'details' => $details, 'request' => $request]);
    }

    // Admin Section
    public function admin(){
        $user = Auth::user();
        return view('backend.admin.index', ['user' => $user]);
    }

    public function bayar(){
        $user = Auth::user();

        $pemesanans = Pemesanan::where('id_status', 3)->orderBy('tgl_pemesanan')->get();
        $details = Detail_pemesanan::all();
        $pembayarans = Pembayaran::all();

        return view('backend.admin.bayar.index', ['user' => $user, 'pemesanans' => $pemesanans, 'details' => $details, 'pembayarans' => $pembayarans]);
    }

    public function bayarDo($id){
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status != 3){
            abort(404);
        }

        $pemesanans->id_status = 4;
        $pemesanans->save();

        $pembayarans = Pembayaran::where('id_pemesanan', $pemesanans->id_pemesanan)->first();
        $pembayaran = Pembayaran::find($pembayarans->id_pembayaran);
        $pembayaran->tgl_pembayaran = now();
        $pembayaran->save();
        
        Session::flash('message', 'Berhasil menerima pembayaran dengan id pesanan '.$pemesanans->id_pemesanan);
        Session::flash('message-class', 'success');
        return redirect()->route('backend.admin.bayar');
    }

    public function proses(){
        $user = Auth::user();

        $pemesanans = Pemesanan::where('id_status', 4)->orderBy('tgl_pemesanan')->get();
        $details = Detail_pemesanan::all();

        return view('backend.admin.proses.index', ['user' => $user, 'pemesanans' => $pemesanans, 'details' => $details]);
    }

    public function prosesDo($id){
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status != 4){
            abort(404);
        }

        $pemesanans->id_status = 5;
        $pemesanans->save();
        
        Session::flash('message', 'Berhasil memproses pesanan dengan id pesanan '.$pemesanans->id_pemesanan);
        Session::flash('message-class', 'success');
        return redirect()->route('backend.admin.proses');
    }

    public function selesai(){
        $user = Auth::user();

        $pemesanans = Pemesanan::where('id_status', 5)->orderBy('tgl_pemesanan')->get();
        $details = Detail_pemesanan::all();

        return view('backend.admin.selesai.index', ['user' => $user, 'pemesanans' => $pemesanans, 'details' => $details]);
    }

    public function selesaiDo($id){
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status != 5){
            abort(404);
        }

        $pemesanans->id_status = 6;
        $pemesanans->save();
        
        Session::flash('message', 'Berhasil menyelesaikan pesanan dengan id pesanan '.$pemesanans->id_pemesanan);
        Session::flash('message-class', 'success');
        return redirect()->route('backend.admin.selesai');
    }
}
