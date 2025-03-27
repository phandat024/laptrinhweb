<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NguoiDung extends Model
{
    use HasFactory;

    protected $table = 'nguoi_dung'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'ten_tk',
        'email',
        'password',
    ];

    public $timestamps = false; 
}
