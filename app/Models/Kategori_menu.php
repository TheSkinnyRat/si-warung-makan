<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_menu extends Model
{
    protected $table = 'kategori_menu';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    use HasFactory;
}
