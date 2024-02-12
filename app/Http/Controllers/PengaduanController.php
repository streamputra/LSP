<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $custom_id = Str::random(10);
        $pengaduan = Pengaduan::latest()->paginate(3);

        return view('index', compact('custom_id', 'pengaduan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string',
                'kategori' => 'required|string',
                'nama_laporan' => 'required|string',
                'detail' => 'required|string',
                'alamat' => 'required|string',
                'foto' => 'required|image',
            ]);

            $foto = $request->file('foto');
            $fotoFileName = $foto->hashName();
            $foto->storeAs('public/pengaduan', $fotoFileName);

            DB::table('pengaduan')->insert([
                'id_laporan' => $request->id,
                'kategori' => $request->kategori,
                'nama_laporan' => $request->nama_laporan,
                'detail_laporan' => $request->detail,
                'alamat_kejadian' => $request->alamat,
                'foto' => $fotoFileName,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('user.home')->with(['success' => 'Data berhasil disimpan']);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->getMessageBag())->withInput()->with(['failed' => 'Data harus diisi dengan benar']);
        }
    }

    public function searchById(Request $request)
    {
        $id_laporan = $request->input('id_laporan');
        // dd($id_laporan); // Add this line for debugging
        $hasil = DB::table('pengaduan')->where('id_laporan', $id_laporan)->first();

        // menampilkan hasil.blade.php
        // compact untuk mengirim data dari variabel $hasil
        return view('hasil', compact('hasil'));
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
