<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_list extends Model
{
    protected $table = 'status_list';
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    use HasFactory;
}
