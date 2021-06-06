<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;
use App\Models\Menu_list;
use App\Models\Kategori_menu;
// use App\Models\Pelanggan;
// use App\Models\Status_list;
use App\Models\Pemesanan;
// use App\Models\Detail_pemesanan;
// use App\Models\Pembayaran;

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
}
