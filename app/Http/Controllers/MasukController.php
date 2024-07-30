<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class MasukController extends Controller
{
    public function index(Request $request) {
        $title = 'Barang Masuk';
        $filter = $request->filter;
        $barang = Barang::all();
        if($filter) {
            $barangMasuk = BarangMasuk::whereDate('updated_at', $filter)->orderBy('updated_at', 'asc')->get();
        } else {
            $barangMasuk = BarangMasuk::orderBy('updated_at', 'asc')->get();
        }
        return view('barang-masuk.index', compact('title', 'barang', 'barangMasuk', 'filter'));
    }

    // out barang start
    public function storeorupdate(Request $request, $id = null) {
        $obj = $id === null ? new BarangMasuk() : BarangMasuk::find($id);
        $obj->id_barang = $request->id_barang;
        $obj->jumlah = $request->jumlah;
        $obj->save();
        
        $barang = Barang::where('id', $request->id_barang)->first();
        $barang->stock += $request->jumlah;
        $barang->save();

    }
    public function doValidate($request, $id=null) {
        $model = [
            'id_barang' => 'required',
            'jumlah' => 'required',
        ];
           
        $request->validate($model);
    }
    public function in(Request $request) {
        try {
            $this->doValidate($request);
            $this->storeorupdate($request);
            
            $jumlah = $request->jumlah;
            $namaBarang = Barang::where('id', $request->id_barang)->value('nama');

            return redirect()->back()
                ->with('success', $jumlah . ' buah ' . $namaBarang . ' berhasil masuk');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memasukkan barang. Error: ' . $e->getMessage());
        }
    }
    // out barang ends

    // add barang start
    public function storeBarangBaru(Request $request, $id = null) {
        $obj = $id === null ? new Barang() : Barang::find($id);
        $obj->nama = $request->nama;
        $obj->harga_jual = $request->harga_jual;
        $obj->harga_modal = $request->harga_modal;
        $obj->stock += $request->stock;
  
        $obj->save();

        $barangMasuk = new BarangMasuk();
       $barangMasuk->id_barang = $obj->id;
       $barangMasuk->jumlah = $request->stock;
       $barangMasuk->save();


    }
    public function validateBarangBaru($request, $id=null) {
        $model = [
            'nama' => 'required',
            'harga_jual' => 'required',
            'harga_modal' => 'required',
            'stock' => 'required',
        ];
           
        $request->validate($model);
    }
    public function add(Request $request) {
        try {
            $this->validateBarangBaru($request);
            $this->storeBarangBaru($request);
    
            return redirect()->back()
                ->with('success', 'Berhasil menambahkan barang');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan barang. Error: ' . $e->getMessage());
        }
    }
    // add barang ends

    // hapus barang masuk
    public function softDelete($id) {
        $obj = BarangMasuk::find($id);
        $obj->save();
    	$obj->delete();
        return redirect()->back()->with('success', 'Berhasil hapus barang keluar');
    }
}
