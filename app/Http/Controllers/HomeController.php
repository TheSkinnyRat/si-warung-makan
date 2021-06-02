<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ViewErrorBag;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.index.index');
    }

    public function error(){
        $errors = session()->get('errors', app(ViewErrorBag::class));
        if ($errors->isEmpty()){
            return view('errors.index')->withErrors(['type' => '404','message' => 'Page Not Found']);
        }
        return view('errors.index');
    }
}