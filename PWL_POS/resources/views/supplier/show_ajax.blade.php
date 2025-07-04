@empty($supplier)
     <div id="modal-master" class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <div class="alert alert-danger">
                     <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                     Data yang anda cari tidak ditemukan
                 </div>
                 <a href="{{ url('/supplier') }}" class="btn btn-warning">Kembali</a>
             </div>
         </div>
     </div>
 @else
     <div id="modal-master" class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Detail Data Supplier</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             </div>
             <div class="modal-body">
                 <table class="table table-bordered table-striped table-hover table-sm">
                     <tr>
                         <th>ID</th>
                         <td>{{ $supplier->supplier_id }}</td>
                     </tr>
                     <tr>
                         <th>Nama</th>
                         <td>{{ $supplier->supplier_nama }}</td>
                     </tr>
                     <tr>
                         <th>Alamat</th>
                         <td>{{ $supplier->supplier_alamat }}</td>
                     </tr>
                     <tr>
                         <th>Telepon</th>
                         <td>{{ $supplier->supplier_kontak }}</td>
                     </tr>
                     <tr> 
                        <th>Email</th> 
                        <td>{{$supplier->supplier_email}}</td> 
                    </tr> 
                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
             </div>
         </div>
     </div>
 @endempty