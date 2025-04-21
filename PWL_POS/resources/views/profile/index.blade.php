@extends('layouts.template')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-body p-4">
            <div class="row align-items-center">

                <!-- Foto Profil dengan Hover Effect -->
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div class="profile-image-container position-relative d-inline-block">
                        <img id="profile-image" 
                             src="{{ $user->foto_profil ? asset('storage/foto/' . $user->foto_profil) : asset('adminlte/dist/img/user4-128x128.jpg') }}"
                             alt="Foto Profil"
                             class="rounded-circle shadow profile-image"
                             style="width: 170px; height: 170px; object-fit: cover; border: 5px solid #f0f0f0;">
                        
                        <div class="profile-image-overlay">
                            <label for="foto-upload" class="btn btn-light rounded-circle p-2 mb-0">
                                <i class="fas fa-camera fa-lg"></i>
                            </label>
                        </div>
                    </div>
                    <!-- Preview message indicator -->
                    <div id="preview-indicator" class="mt-2 text-center" style="display: none;">
                        <span class="badge bg-warning text-dark p-2">
                            <i class="fas fa-exclamation-circle mr-1"></i> Foto dalam mode preview. Klik Simpan untuk mengupload.
                        </span>
                    </div>
                </div>

                <!-- Info Pengguna -->
                <div class="col-md-8">
                    <h4 class="mb-3 text-primary fw-bold">Informasi Pengguna</h4>
                    <hr class="mb-3 bg-primary" style="height: 2px; opacity: 0.7;">

                    <div class="info-section">
                        <div class="mb-3 info-card p-2 rounded shadow-sm">
                            <label class="text-muted mb-1 medium fw-bold">Nama</label>
                            <div class="fw-bold fs-3" id="display-nama" style="letter-spacing: 0.5px;">{{ $user->nama }}</div>
                        </div>

                        <div class="mb-3 info-card p-2 rounded shadow-sm">
                            <label class="text-muted mb-1 medium fw-bold">Username</label>
                            <div class="fw-bold fs-3" style="letter-spacing: 0.5px;">{{ $user->username }}</div>
                        </div>

                        <div class="mb-3 info-card p-2 rounded shadow-sm">
                            <label class="text-muted mb-1 medium fw-bold">Level Pengguna</label>
                            <div class="fw-bold fs-3">
                                <span class="badge bg-primary" style="font-size: 0.7em;">{{ $user->level?->level_nama ?? 'User' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Update Nama + Foto -->
                    <form id="profile-form" action="{{ route('profile.update_photo') }}" method="POST" enctype="multipart/form-data" class="mt-4 p-3 rounded shadow-sm">
                        @csrf
                        <h5 class="mb-3 text-primary">Edit Profil</h5>
                        
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Ubah Nama</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}" 
                                   class="form-control shadow-sm" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto-upload" class="form-label">Ganti Foto (Opsional)</label>
                            <input type="file" name="foto" id="foto-upload" class="form-control shadow-sm" accept="image/*">
                            <div class="form-text text-muted small">Format: JPG, JPEG, PNG (Maks. 2MB)</div>
                        </div>

                        <button type="submit" class="btn btn-success px-4" id="save-button">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Custom Styles for the profile page -->
<style>
    .profile-image-container {
        position: relative;
        width: 160px;
        height: 160px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
    }
    
    .profile-image {
        transition: all 0.3s ease;
    }
    
    .profile-image-container:hover .profile-image {
        filter: brightness(80%);
    }
    
    .profile-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 50%;
    }
    
    .profile-image-container:hover .profile-image-overlay {
        opacity: 1;
    }
    
    .info-card {
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
    }
    
    .info-section {
        max-width: 100%;
    }
    
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: all 0.3s ease;
    }
    
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    
    /* Added animation for the preview indicator */
    @keyframes pulse {
        0% { opacity: 0.7; }
        50% { opacity: 1; }
        100% { opacity: 0.7; }
    }
    
    #preview-indicator {
        animation: pulse 2s infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let photoChanged = false;
        const profileContainer = document.querySelector('.profile-image-container');
        const fileInput = document.getElementById('foto-upload');
        const previewIndicator = document.getElementById('preview-indicator');
        
        // Photo upload via profile image click
        profileContainer.addEventListener('click', function() {
            fileInput.click();
        });
        
        // Preview image when photo is selected
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image').src = e.target.result;
                    photoChanged = true;
                    previewIndicator.style.display = 'block'; // Show preview indicator
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Handle form submission with AJAX
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            uploadPhoto(formData);
        });
        
        // Function to handle photo upload
        function uploadPhoto(formData) {
            const submitBtn = document.getElementById('save-button');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
            
            fetch('{{ route("profile.update_photo") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Perubahan';
                previewIndicator.style.display = 'none'; // Hide preview indicator
                
                if (data.status === 'success') {
                    // Update displayed name
                    document.getElementById('display-nama').textContent = data.nama;
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500,
                        willClose: () => {
                            // Reload the page after the success message closes
                            window.location.reload();
                        }
                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat memperbarui profil'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Perubahan';
                previewIndicator.style.display = 'none'; // Hide preview indicator
                
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat memperbarui profil'
                });
            });
        }
    });
    
    // Show SweetAlert for flash messages (for non-AJAX fallback)
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