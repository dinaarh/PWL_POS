@extends('layouts.template')

@section('content')
<div class="d-flex justify-content-center" style="margin-top: 30px;">
    <div class="card shadow p-4" style="width: 350px; border-radius: 20px;">
        <div class="text-center mb-3">
            <img src="{{ $profil->foto ? asset('storage/profil/' . $profil->foto) : asset('storage/profil/default.jpg') }}"
                class="rounded-circle shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        <h4 class="text-center">{{ $profil->nama_lengkap ?? Auth::user()->nama }}</h4>
        <p class="text-muted text-center">{{ Auth::user()->getRoleName() }}</p>

        <hr>

        <div class="text-start mb-2">
            <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
            <p><strong>Email:</strong> {{ $profil->email }}</p>
            <p><strong>No HP:</strong> {{ $profil->no_hp }}</p>
            <p><strong>Alamat:</strong> {{ $profil->alamat }}</p>
        </div>

        <div class="d-grid gap-2">
            <a href="{{ route('profil.edit') }}" class="btn btn-primary">Edit Profil</a>
            
            @if($profil && $profil->foto && $profil->foto !== 'default.jpg')
               <a href="{{ route('profil.deleteFoto') }}" class="btn btn-outline-danger"
                  onclick="return confirm('Yakin ingin menghapus foto profil?')">
                  <i class="fas fa-trash me-1"></i> Hapus Foto Profil
               </a>
           @endif
        </div>
    </div>
</div>
@endsection
