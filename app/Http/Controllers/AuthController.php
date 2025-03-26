<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){ // Jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function register()
     {
         if (Auth::check()) { 
             return redirect('/');
         }
         $level = LevelModel::select('level_id', 'level_nama')->get();
         
         return view('auth.register', ['level' => $level]);
     }

    public function postlogin(Request $request){
        if($request->ajax() || $request->wantsJson()){
            $credentials = $request->only('username', 'password');

            if(Auth::attempt($credentials)){
                return response()->json([
                    'status' => true,  
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            } 
            
            return response()->json([
                'status' => false, 
                'message' => 'Login Gagal'
            ]); 
        }

        return redirect('login');
    }

    public function postregister(Request $request) {
        // cek request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // false: error/gagal, true: berhasil
                    'message' => $validator->errors()->first(),
                    'msgField' => $validator->errors() // pesan error validasi
                ]);
            }

            UserModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil ditambahkan',
                'redirect' => url('/login'),
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
