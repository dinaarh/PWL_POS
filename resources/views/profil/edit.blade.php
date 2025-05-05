@extends('layouts.template')

@section('content')
<div class="container pt-4" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Profil</h5>
        </div>
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Foto Profil --}}
                <div class="text-center mb-4">
                    <img src="{{ $profil->foto ? asset('storage/profil/' . $profil->foto) : asset('storage/profil/default.jpg') }}"
                        class="rounded-circle shadow-sm"
                        style="width: 150px; height: 150px; object-fit: cover;">
                </div>

                {{-- Upload Foto --}}
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                {{-- Username (readonly) --}}
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->username }}" readonly>
                </div>

                {{-- Role --}}
                <div class="mb-3">
                    <label class="form-label">Role / Jabatan</label>
                    <input type="text" class="form-control" 
                           value="{{ Auth::user()->getRoleName() }}" readonly>
                </div>

                {{-- Nama Lengkap --}}
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap"
                        value="{{ old('nama_lengkap', Auth::user()->nama) }}">
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $profil->email) }}">
                </div>

                {{-- No HP --}}
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $profil->no_hp) }}">
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', $profil->alamat) }}</textarea>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('profil.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
