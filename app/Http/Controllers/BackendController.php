<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Menu_list;
use App\Models\Kategori_menu;
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
        return view('backend.superadmin.index', ['user' => $user]);
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
            'username' => 'required|min:5|max:100|unique:user',
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
            'username' => ['required', 'min:5', 'max:100', Rule::unique('user')->ignore($users)],
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

    // Admin Section
    public function admin(){
        $user = Auth::user();
        return view('backend.admin.index', ['user' => $user]);
    }
    
}
