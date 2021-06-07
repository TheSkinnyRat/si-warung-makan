<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use App\Models\Menu_list;
use App\Models\Kategori_menu;
use App\Models\Pelanggan;
// use App\Models\Status_list;
use App\Models\Pemesanan;
// use App\Models\Detail_pemesanan;
// use App\Models\Pembayaran;
use Session;

class HomeController extends Controller
{
    public function error(){
        $errors = session()->get('errors', app(ViewErrorBag::class));
        if ($errors->isEmpty()){
            return view('errors.index')->withErrors(['type' => '404','message' => 'Page Not Found']);
        }
        return view('errors.index');
    }

    public function index(){
        $menus = Menu_list::orderBy('status')->get();
        $kategoris = Kategori_menu::all();
        return view('frontend.index.index', ['menus' => $menus, 'kategoris' => $kategoris]);
    }

    public function kategori($id){
        $menus = Menu_list::where('id_kategori', $id)->orderBy('status')->get();
        $kategoris = Kategori_menu::all();
        $kategori = Kategori_menu::find($id);
        if (!$kategori){
            abort(404);
        }
        $kategori_name = $kategori->kategori;
        return view('frontend.index.index', ['menus' => $menus, 'kategoris' => $kategoris, 'kategori_name' => $kategori_name]);
    }

    public function status(){
        $pemesanans = Pemesanan::where('id_status', '>=', 4)->where('id_status', '<=', 5)->orderBy('tgl_pemesanan')->get();
        return view('frontend.status.index', ['pemesanans' => $pemesanans]);
    }

    public function register(){
        return view('frontend.register.index');
    }

    public function registerDo(Request $request){
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
        
        return view('frontend.register.success', ['id_pelanggan' => $id_pelanggan]);
    }

    public function login(){
        return view('frontend.login.index');
    }

    public function loginDo(Request $request){
        $request->validate([
            'id_pelanggan' => 'required|numeric|digits:9',
        ]);

        $pelanggans = Pelanggan::find($request->id_pelanggan);
        if (!$pelanggans){
            Session::flash('message', 'ID Pelanggan tidak ditemukan');
            Session::flash('message-class', 'warning');
            return redirect()->route('home.login');
        }
        
        $request->session()->put('pelanggans', $pelanggans);
        return redirect()->route('home.pelanggan');
    }

    public function logout(Request $request){
        $request->session()->forget('pelanggans');
        return redirect()->route('home');
    }

    public function pelanggan(){
        $pelanggans = Session::get('pelanggans');
        return view('frontend.pelanggan.index', ['pelanggans' => $pelanggans]);
    }
}
