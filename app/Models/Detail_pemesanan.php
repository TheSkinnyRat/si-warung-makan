<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_pemesanan extends Model
{
    protected $table = 'detail_pemesanan';
    protected $primaryKey = 'id_pemesanan_detail';

    use HasFactory;
}
