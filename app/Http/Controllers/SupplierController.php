<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SupplierController extends Controller
{
    public function index() {
        $supplier = SupplierModel::all();

        $breadcrumb = (Object) [    
            'title' => 'Daftar supplier',
            'list'  => ['Home', 'supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'supplier';

        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) {
        $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');

        if ($request->supplier_id) {
            $supplier->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                // $btn = '<a href="'.url('/supplier/' .$supplier->supplier_id).'" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="'.url('/supplier/' .$supplier->supplier_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="'.url('/supplier/'.$supplier->supplier_id).'">'
                //      . csrf_field() . method_field('DELETE')
                //      . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\''.url('/supplier/' . $supplier->supplier_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/supplier/' . $supplier->supplier_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/supplier/' . $supplier->supplier_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn; 
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list'  => ['Home', 'supplier', 'Tambah'] 
        ];

        $page = (object) [
            'title' => 'Tambah supplier baru'
        ];

        $activeMenu = 'supplier';

        return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            'supplier_kode'  => 'required|string',
            'supplier_nama'  => 'required|string',
            'supplier_alamat'=> 'required|string',
        ]);

        SupplierModel::create([
            'supplier_kode'  => $request->supplier_kode,
            'supplier_nama'  => $request->supplier_nama,
            'supplier_alamat'=> $request->supplier_alamat,
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil disimpan');
    }

    public function create_ajax() {
        $supplier = SupplierModel::all();

        return view('supplier.create_ajax', ['supplier' => $supplier]);
    }

    public function store_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|min:3|max:6|unique:m_supplier,supplier_kode',
                'supplier_nama' => 'required|string|min:3|max:50',
                'supplier_alamat' => 'required|string|min:10|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false, 
                    'message'  =>'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            SupplierModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data Level berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    public function show(string $id) {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list'  => ['Home', 'supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function show_ajax(string $id) {
        $supplier = SupplierModel::find($id);

        return view('supplier.show_ajax', ['supplier' => $supplier]);
    }

    public function edit(string $id) {
        $supplier = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list'  => ['Home', 'supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id) {

        $request->validate([
            'supplier_kode'    => 'required|unique:m_supplier,supplier_kode',
            'supplier_nama'    => 'required|string',
            'supplier_alamat'  => 'required|string',
        ]);

        SupplierModel::find($id)->update([
            'supplier_kode'    => $request->supplier_kode,
            'supplier_nama'    => $request->supplier_nama,
            'supplier_alamat'  => $request->supplier_alamat
        ]);

        return redirect('/supplier')->with('succes', 'Data supplier berhasil diubah');
    }

    public function edit_ajax(string $id) {
        $supplier = SupplierModel::find($id);

        return view('supplier.edit_ajax', ['supplier' => $supplier]); 
    }

    public function update_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|min:3|max:6',
                'supplier_nama' => 'required|string|min:3|max:50',
                'supplier_alamat' => 'required|string|min:10|max:100',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = SupplierModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function destroy(string $id) {
        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id);

            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function confirm_ajax(string $id) {
        $supplier = SupplierModel::find($id);

        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = SupplierModel::find($id);
            if (!$supplier) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }

            try {
                $supplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
                ]);
            }
        }

        return redirect('/');
    }

    public function import()
     {
         return view('supplier.import');
     } 
 
     public function import_ajax(Request $request) 
     { 
         if($request->ajax() || $request->wantsJson()){ 
             $rules = [ 
                 // validasi file harus xls atau xlsx, max 1MB 
                 'file_supplier' => ['required', 'mimes:xlsx', 'max:1024'] 
             ]; 
  
             $validator = Validator::make($request->all(), $rules); 
             if($validator->fails()){ 
                 return response()->json([ 
                     'status' => false, 
                     'message' => 'Validasi Gagal', 
                     'msgField' => $validator->errors() 
                 ]); 
             } 
  
             $file = $request->file('file_supplier');  // ambil file dari request 
  
             try {
                 $reader = IOFactory::createReader('Xlsx');  // load reader file excel 
                 $reader->setReadDataOnly(true);             // hanya membaca data 
                 $spreadsheet = $reader->load($file->getRealPath()); // load file excel 
                 $sheet = $spreadsheet->getActiveSheet();    // ambil sheet yang aktif 
      
                 $data = $sheet->toArray(null, false, true, true);   // ambil data excel 
      
                 $insert = []; 
                 if(count($data) > 1){ // jika data lebih dari 1 baris 
                     foreach ($data as $baris => $value) { 
                         if($baris > 1){ // baris ke 1 adalah header, maka lewati 
                             $insert[] = [  
                                 'supplier_kode' => $value['A'], 
                                 'supplier_nama' => $value['B'], 
                                 'supplier_alamat' => $value['C'], 
                                 'created_at' => now(), 
                             ]; 
                         } 
                     } 
 
                     if(count($insert) > 0){ 
                         // insert data ke database, jika data sudah ada, maka diabaikan 
                         SupplierModel::insertOrIgnore($insert);    
                     } 
      
                     return response()->json([ 
                         'status' => true, 
                         'message' => 'Data berhasil diimport' 
                     ]); 
                 }else{ 
                     return response()->json([ 
                         'status' => false, 
                         'message' => 'Tidak ada data yang diimport' 
                     ]); 
                 } 
             } catch (\Exception $e) {
                 return response()->json([
                     'status' => false,
                     'message' => 'Gagal membaca file Excel: ' . $e->getMessage(),
                 ]);
             }
 
         } 
         return redirect('/'); 
     }
}
