@extends('layouts.template') 

@section('content') 
    <div class="card card-outline card-primary"> 
        <div class="card-header"> 
            <h3 class="card-title">{{ $page->title }}</h3> 
            <div class="card-tools"></div> 
        </div> 
        <div class="card-body"> 
            @if (!$supplier) 
                <div class="alert alert-danger alert-dismissible"> 
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5> 
                    Data yang Anda cari tidak ditemukan. 
                </div> 
            @else 
                <table class="table table-bordered table-striped table-hover table-sm"> 
                    <tr> 
                        <th>ID</th> 
                        <td>{{ $supplier->supplier_id }}</td> 
                    </tr> 
                    <tr> 
                        <th>Nama Supplier</th> 
                        <td>{{ $supplier->supplier_nama }}</td> 
                    </tr> 
                    <tr> 
                        <th>Alamat Supplier</th> 
                        <td>{{ $supplier->supplier_alamat }}</td> 
                    </tr> 
                    <tr> 
                        <th>Kontak Supplier</th> 
                        <td>{{ $supplier->supplier_kontak }}</td> 
                    </tr> 
                    <tr> 
                        <th>Email Supplier</th> 
                        <td>{{ $supplier->supplier_email }}</td> 
                    </tr> 
                </table> 
            @endif 
            <a href="{{ url('supplier') }}" class="btn btn-sm btn-default mt-2">Kembali</a> 
        </div> 
    </div> 
@endsection 

@push('css') 
@endpush 

@push('js') 
@endpush
