<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Profil',
            'list' => ['Home', 'Profil']
        ];

        $activeMenu = 'profil';

        $profil = ProfilModel::firstOrCreate(['user_id' => Auth::user()->user_id]);

        return view('profil.index', compact('breadcrumb', 'activeMenu', 'profil'));
    }

    public function edit()
    {
        $profil = ProfilModel::firstOrCreate(['user_id' => Auth::user()->user_id]);

        $breadcrumb = (object)[
            'title' => 'Edit Profil',
            'list' => ['Home', 'Profil', 'Edit Profil']
        ];

        $activeMenu = 'profil';

        return view('profil.edit', compact('profil', 'activeMenu', 'breadcrumb'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'role' => 'nullable|string',
        ]);

        // $profil = ProfilModel::firstOrCreate(['user_id' => Auth::user()->user_id]);
        $user = Auth::user();
        $profil = ProfilModel::firstOrCreate(
            ['user_id' => Auth::id()],
            ['foto' => 'default.jpg']
        );

        if ($request->hasFile('foto')) {
            if ($profil->foto && $profil->foto !== 'default.jpg') {
                Storage::delete('public/profil/' . $profil->foto);
            }

            $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/profil', $namaFoto);

            $profil->foto = $namaFoto;
        }

        $user = \App\Models\UserModel::find(Auth::id());
        $user->nama = $request->nama_lengkap;
        $user->save();

        $profil->nama_lengkap = $request->nama_lengkap;
        $profil->email = $request->email;
        $profil->no_hp = $request->no_hp;
        $profil->alamat = $request->alamat;
        $profil->save();
        

        return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbarui');
    }

    public function deleteFoto()
    {
        $profil = ProfilModel::where('user_id', Auth::user()->user_id)->first();

        if ($profil && $profil->foto && $profil->foto != 'default.jpg') {
            Storage::disk('public')->delete('profil/' . $profil->foto);
        }

        $profil->foto = 'default.jpg';
        $profil->save();

        return redirect()->route('profil.index')->with('success', 'Foto profil berhasil dihapus.');
    }
}
