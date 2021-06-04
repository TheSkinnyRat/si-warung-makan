<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_list extends Model
{
    protected $table = 'menu_list';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    use HasFactory;

    public function kategori(){
        return $this->belongsTo(Kategori_menu::class, 'id_kategori');
    }
}
