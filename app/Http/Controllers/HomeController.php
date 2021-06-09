<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use App\Models\Menu_list;
use App\Models\Kategori_menu;
use App\Models\Pelanggan;
// use App\Models\Status_list;
use App\Models\Pemesanan;
use App\Models\Detail_pemesanan;
use App\Models\Pembayaran;
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
        if (Session::get('pelanggans')){
            return redirect()->route('home.pelanggan');
        }
        $menus = Menu_list::orderBy('status')->get();
        $kategoris = Kategori_menu::all();

        return view('frontend.index.index', ['menus' => $menus, 'kategoris' => $kategoris]);
    }

    public function kategori($id){
        if (Session::get('pelanggans')){
            return redirect()->route('home.pelanggan');
        }
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
        if (Session::get('pelanggans')){
            return redirect()->route('home.pelanggan');
        }
        
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
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();

        return view('frontend.pelanggan.index', ['pelanggans' => $pelanggans, 'pemesanans' => $pemesanans]);
    }

    public function pesan(){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $menus = Menu_list::orderBy('status')->get();
        $kategoris = Kategori_menu::all();
        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->get();
        $pesanan = 0;
        $harga = 0;
        foreach ($details as $detail){
            $pesanan += $detail->kuantitas;
            $harga += $detail->menu->harga*$detail->kuantitas;
        }
        $count = ([
            'pesanan' => $pesanan,
            'harga' => $harga,
        ]);

        return view('frontend.pelanggan.pesan', ['pelanggans' => $pelanggans, 'menus' => $menus, 'kategoris' => $kategoris, 'count' => $count, 'details' => $details]);
    }

    public function PesanKategori($id){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $menus = Menu_list::where('id_kategori', $id)->orderBy('status')->get();
        $kategoris = Kategori_menu::all();
        $kategori = Kategori_menu::find($id);
        if (!$kategori){
            abort(404);
        }
        $kategori_name = $kategori->kategori;
        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->get();
        $pesanan = 0;
        $harga = 0;
        foreach ($details as $detail){
            $pesanan += $detail->kuantitas;
            $harga += $detail->menu->harga*$detail->kuantitas;
        }
        $count = ([
            'pesanan' => $pesanan,
            'harga' => $harga,
        ]);
        
        return view('frontend.pelanggan.pesan', ['pelanggans' => $pelanggans, 'menus' => $menus, 'kategoris' => $kategoris, 'kategori_name' => $kategori_name, 'count' => $count, 'details' => $details]);
    }

    public function pesanDo(){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isNotEmpty()){
            return redirect()->route('home.pelanggan.pesan');
        }
        $pemesanans = new Pemesanan;

        $pemesanans->id_pelanggan = $pelanggans->id_pelanggan;
        $pemesanans->tgl_pemesanan = now();
        $pemesanans->id_status = 1;
        $pemesanans->save();

        return redirect()->route('home.pelanggan.pesan');
    }

    public function pesanAdd($id){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $menus = Menu_list::find($id);
        if (!$menus || $menus->status != 0){
            abort(404);
        }
        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->get();
        $pesanan = 0;
        $harga = 0;
        foreach ($details as $detail){
            $pesanan += $detail->kuantitas;
            $harga += $detail->menu->harga*$detail->kuantitas;
        }
        $count = ([
            'pesanan' => $pesanan,
            'harga' => $harga,
        ]);
        $detail = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->where('id_menu', $menus->id_menu)->get();
        if ($detail->isNotEmpty()){
            return view('frontend.pelanggan.pesan_add', ['pelanggans' => $pelanggans, 'menus' => $menus, 'count' => $count, 'detail' => $detail]);
        }

        return view('frontend.pelanggan.pesan_add', ['pelanggans' => $pelanggans, 'menus' => $menus, 'count' => $count]);
    }

    public function pesanAddDo($id, Request $request){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $menus = Menu_list::find($id);
        if (!$menus || $menus->status != 0){
            abort(404);
        }
        $request->validate([
            'kuantitas' => 'required|numeric|min:1|max:500',
        ]);
        $detail = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->where('id_menu', $menus->id_menu)->get();
        if ($detail->isNotEmpty()){
            $details = Detail_pemesanan::find($detail->first()->id_pemesanan_detail);
            Session::flash('message', 'Berhasil mengubah pesanan');
            Session::flash('message-class', 'info');
        }else{
            $details = new Detail_pemesanan;
            Session::flash('message', 'Berhasil menambahkan pesanan');
            Session::flash('message-class', 'success');
        }
        $details->id_pemesanan = $pemesanans->first()->id_pemesanan;
        $details->id_menu = $menus->id_menu;
        $details->kuantitas = $request->kuantitas;
        $details->save();

        return redirect()->route('home.pelanggan.pesan');
    }

    public function pesanDeleteDo($id, Request $request){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $menus = Menu_list::find($id);
        if (!$menus || $menus->status != 0){
            abort(404);
        }
        $detail = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->where('id_menu', $menus->id_menu)->first();
        if (!$detail){
            abort(404);
        }
        Detail_pemesanan::destroy($detail->id_pemesanan_detail);

        Session::flash('message', 'Berhasil menghapus pesanan');
        Session::flash('message-class', 'danger');
        return redirect()->route('home.pelanggan.pesan');
    }

    public function pesanan(){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->get();

        return view('frontend.pelanggan.pesanan', ['pelanggans' => $pelanggans, 'details' => $details]);
    }

    public function pesananDo(){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        $detail = Detail_pemesanan::where('id_pemesanan', $pemesanans->first()->id_pemesanan)->first();
        if (!$detail){
            abort(404);
        }
        $pemesanan = Pemesanan::find($pemesanans->first()->id_pemesanan);
        $pemesanan->id_status = 2;
        $pemesanan->tgl_pemesanan = now();
        $pemesanan->save();

        return redirect()->route('home.pelanggan.checkout', ['id' => $pemesanans->first()->id_pemesanan]);
    }

    public function pesananDeleteDo(){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->where('id_status', 1)->get();
        if ($pemesanans->isEmpty()){
            abort(404);
        }
        Pemesanan::destroy($pemesanans->first()->id_pemesanan);

        Session::flash('message', 'Berhasil menghapus pesanan');
        Session::flash('message-class', 'danger');
        return redirect()->route('home.pelanggan');
    }

    public function checkout($id){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status != 2 || $pemesanans->id_pelanggan != $pelanggans->id_pelanggan){
            abort(404);
        }
        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->id_pemesanan)->get();

        return view('frontend.pelanggan.checkout', ['pelanggans' => $pelanggans, 'pemesanans' => $pemesanans, 'details' => $details]);
    }

    public function checkoutDo($id){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status != 2 || $pemesanans->id_pelanggan != $pelanggans->id_pelanggan){
            abort(404);
        }
        $pemesanans->id_status = 3;
        $pemesanans->save();

        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->id_pemesanan)->get();
        $total_bayar = 0;
        foreach ($details as $detail){
            $total_bayar += $detail->menu->harga*$detail->kuantitas;
        }
        $pembayarans = new Pembayaran;
        $pembayarans->id_pemesanan = $pemesanans->id_pemesanan;
        $pembayarans->total_bayar = $total_bayar;
        $pembayarans->save();

        return redirect()->route('home.pelanggan.bayar', ['id' => $pemesanans->id_pemesanan]);
    }

    public function checkoutDeleteDo($id){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status != 2 || $pemesanans->id_pelanggan != $pelanggans->id_pelanggan){
            abort(404);
        }
        Pemesanan::destroy($pemesanans->id_pemesanan);

        Session::flash('message', 'Berhasil menghapus pesanan');
        Session::flash('message-class', 'danger');
        return redirect()->route('home.pelanggan');
    }

    public function bayar($id){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::find($id);
        if (!$pemesanans || $pemesanans->id_status < 3 || $pemesanans->id_status > 5 || $pemesanans->id_pelanggan != $pelanggans->id_pelanggan){
            abort(404);
        }
        $details = Detail_pemesanan::where('id_pemesanan', $pemesanans->id_pemesanan)->get();

        return view('frontend.pelanggan.bayar', ['pelanggans' => $pelanggans, 'pemesanans' => $pemesanans, 'details' => $details]);
    }

    public function riwayat(){
        $pelanggans = Session::get('pelanggans');
        $pemesanans = Pemesanan::where('id_pelanggan', $pelanggans->id_pelanggan)->get();
        $details = Detail_pemesanan::all();
        $pembayarans = Pembayaran::all();

        return view('frontend.pelanggan.riwayat', ['pelanggans' => $pelanggans, 'pemesanans' => $pemesanans, 'details' => $details, 'pembayarans' => $pembayarans]);
    }

    public function nota($id){
        $pelanggans = Session::get('pelanggans');
        $pembayarans = Pembayaran::where('id_pemesanan', $id)->first();
        if (!$pembayarans || $pembayarans->pemesanan->id_pelanggan != $pelanggans->id_pelanggan || $pembayarans->pemesanan->id_status < 4 || $pembayarans->pemesanan->id_status == 7){
            abort(404);
        }
        $details = Detail_pemesanan::all();

        return view('frontend.pelanggan.nota', ['pelanggans' => $pelanggans, 'pembayarans' => $pembayarans, 'details' => $details]);
    }
}
