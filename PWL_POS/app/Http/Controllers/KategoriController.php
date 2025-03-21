<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];
    
        $page = (object) [
            'title' => 'Daftar Kategori yang terdaftar di sistem'
        ];
    
        $activeMenu = 'kategori';
        $kategori = KategoriModel::all(); // Ambil data dengan model
    
        return view('kategori.index', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }
    
    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        if ($request->kategori_id) { // Sesuaikan dengan nama filter dari view
            $kategori->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '<a href="' . url('kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> '
                    . '<a href="' . url('kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> '
                    . '<form class="d-inline-block" method="POST" action="' . url('kategori/' . $kategori->kategori_id) . '">'
                    . csrf_field() . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
                    </form>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori Baru'
        ];

        $activeMenu = 'kategori';
        $kategori = KategoriModel::all();

        return view('kategori.create', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_kode' => 'required|string|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100'
        ]);
    
        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);
    
        return redirect('/kategori')->with('success', 'Data user berhasil disimpan');
    }
    

    public function show($id)
    {
      $kategori = KategoriModel::find($id);
      
      $breadcrumb = (object) [
          'title' => 'Detail kategori',
          'list' => ['Home', 'kategori', 'Detail']
      ];
  
      $page = (object) [
          'title' => 'Detail kategori',
      ];
  
      $activeMenu = 'kategori'; //set menu yang sedang aktif
  
      return view('kategori.show', compact('breadcrumb', 'page', 'kategori', 'activeMenu'));
    }

    public function edit($id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit kategori',
            'list' => ['Home', 'kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';
        $kategori = KategoriModel::findOrFail($id);

        return view('kategori.edit', compact('breadcrumb', 'page', 'activeMenu', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_kode' => 'required|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required'
        ]);

        KategoriModel::findOrFail($id)->update($request->all());

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah!');
    }

    public function destroy($id)
    {
        $check = KategoriModel::find($id);
        if (!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try {
           KategoriModel::destroy($id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}


// <!-- <?php

// namespace App\Http\Controllers;

// use DB;
// use Illuminate\Http\Request;

// class KategoriController extends Controller
// {
//     public function index(){
//         $data = [
//             'kategori_kode' => 'SNK',
//             'kategori_nama' => 'Snack/Makanan Ringan',
//             'created_at' => now(),
//         ];
//         DB::table('m_kategori')->insert($data);
//         return 'Insert data baru berhasil ditambahkan';

//         $row = DB::table('m_kategori')->where('kategori_kode','SNK')->update(['kategori_nama' => 'Cemilan']);
//         return "Update data baru berhasil. Jumlah data yang diupdate:" .$row. "baris";

//         $row = DB::table('m_kategori')->where('kategori_kode','SNK')->delete();
//         return "Delete data berhasil. Jumlah data yang dihapus:".$row. "baris";

//         $data = DB::table('m_kategori')->get();
//         return view('kategori', ['data' => $data]);
//     }
// } -->