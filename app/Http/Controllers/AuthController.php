<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function index()
    {
        $pengaduan = Pengaduan::latest()->paginate(5);
        return view('auth.index', compact('pengaduan'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'name' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            return redirect('/admin');
        }
        return redirect()->route('login')->with('failed', 'Username atau password salah.');
    }

    // CRUD 
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $post = Pengaduan::findOrFail($id);

        //render view with post
        return view('auth.show', compact('post'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get post by ID
        $post = Pengaduan::findOrFail($id);

        //render view with post
        return view('auth.edit', compact('post'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // dd($request->all());
        $this->validate($request, [
            'status' => 'string',
        ]);

        $status = $request->status;

        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update([
            'status' => $status,
            'umpan_balik' => $request->umpan_balik,
        ]);

        //redirect to index
        return redirect()->route('admin.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */

    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $post = Pengaduan::findOrFail($id);

        //delete image
        Storage::delete('public/pengaduan/' . $post->foto);

        //delete post
        $post->delete();

        //redirect to index
        return redirect('/admin')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function logout()
    {
        // dd('oke');
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu logout');
    }
}
