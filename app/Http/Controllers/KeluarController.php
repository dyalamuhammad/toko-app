<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class KeluarController extends Controller
{
    public function index(Request $request) {
        $title = 'Barang Keluar';
        $filter = $request->filter;
        $barang = Barang::all();
        if($filter) {
            $barangKeluar = BarangKeluar::whereDate('updated_at', $filter)->orderBy('updated_at', 'asc')->get();
        } else {
            $barangKeluar = BarangKeluar::orderBy('updated_at', 'asc')->get();
        }
        return view('barang-keluar.index', compact('title', 'barang', 'barangKeluar', 'filter'));
    }

    // out barang start
    public function storeorupdate(Request $request, $id = null) {
        $obj = $id === null ? new BarangKeluar() : BarangKeluar::find($id);
        $obj->id_barang = $request->id_barang;
        $obj->jumlah = $request->jumlah;
        $obj->save();

        $barang = Barang::where('id', $request->id_barang)->first();
        $barang->stock -= $request->jumlah;
        $barang->save();
    }
    public function doValidate($request, $id=null) {
        $model = [
            'id_barang' => 'required',
            'jumlah' => 'required',
        ];
           
        $request->validate($model);
    }
    public function out(Request $request) {
        try {
            $this->doValidate($request);
            $this->storeorupdate($request);
            $jumlah = $request->jumlah;
            $namaBarang = Barang::where('id', $request->id_barang)->value('nama');

            return redirect()->back()
                ->with('success', $jumlah . ' buah ' . $namaBarang . ' berhasil keluar');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengeluarkan barang. Error: ' . $e->getMessage());
        }
    }
    // out barang ends

    // hapus barang keluar
    public function softDelete($id) {
        $obj = BarangKeluar::find($id);
        $obj->save();
    	$obj->delete();
        return redirect()->back()->with('success', 'Berhasil hapus barang keluar');
    }

}
