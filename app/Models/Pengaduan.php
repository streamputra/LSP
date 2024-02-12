<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    // public static $rules = [
    //     'id_laporan' => 'required|unique:pengaduan,id_laporan',
    //     'kategori' => 'required|string|max:255',
    //     'nama_laporan'  => 'required|string|max:255',
    //     'isi_laporan' => 'required|string|max:255',
    //     'detail_laporan' => 'required|string|max:255',
    //     'alamat_kejadian' => 'required|string|max:255',
    //     'foto' => 'image|mimes:jpg,jpeg,png',
    // ];

    // protected $fillable = [
    //     'id_laporan',
    //     'kategori',
    //     'nama_laporan',
    //     'isi_laporan',
    //     'detail_laporan',
    //     'alamat_kejadian',
    //     'foto'
    // ];


    protected $guarded = ["id"];
}
