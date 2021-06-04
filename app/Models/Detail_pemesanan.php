<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_pemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_pemesanan_detail';
    public $timestamps = false;

    use HasFactory;

    public function pemesanan(){
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function menu(){
        return $this->belongsTo(Menu_list::class, 'id_menu');
    }
}
