@extends('layouts.template')

@section('content')
<div class="container py-5">
    <div class="card shadow rounded-lg border-0">
        <div class="card-body p-4">
            <div class="row align-items-center">

                <!-- Foto Profil -->
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <form action="{{ url('profile/update_photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="position-relative d-inline-block">
                            <img src="{{ Auth::user()->foto_profil ? asset('storage/foto/' . Auth::user()->foto_profil) : asset('adminlte/dist/img/user4-128x128.jpg') }}"
                                 alt="Foto Profil"
                                 class="rounded-circle shadow"
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #f0f0f0;">
                            
                            <label class="btn btn-sm btn-outline-primary mt-3">
                                Ganti Foto <input type="file" name="foto" class="d-none" accept="image/*" onchange="this.form.submit()">
                            </label>
                        </div>
                    </form>
                </div>

                <!-- Info Pengguna -->
                <div class="col-md-8">
                    <h4 class="mb-3 text-primary">Informasi Pengguna</h4>
                    <hr class="mb-4">

                    <div class="mb-3">
                        <label class="text-muted mb-1">Nama</label>
                        <div class="fw-bold fs-5">{{ $user->nama }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted mb-1">Username</label>
                        <div class="fw-bold fs-5">{{ $user->username }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted mb-1">Level Pengguna</label>
                        <div class="fw-bold fs-5">{{ $user->level?->level_nama ?? '-' }}</div>
                    </div>

                    <!-- Form Update Nama + Foto -->
                    <form action="{{ route('profile.update_photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama">Ubah Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" class="form-control shadow-sm" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto">Ganti Foto (Opsional)</label>
                            <input type="file" name="foto" id="foto" class="form-control shadow-sm" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session("error") }}'
        });
    @endif
</script>
@endsection
