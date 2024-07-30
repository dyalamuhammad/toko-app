<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) {
        $title = 'Report Stock';
    //     $filter = $request->filter;
    //     if(empty($filter)) {
    //         $filter = Carbon::now()->format('y-m-d');
    //     } else {
    //     $filter = $request->filter;

    // }
    // // @dd($filter);
    //     $today = Carbon::now()->locale('id_ID')->isoFormat('D MMMM YYYY');
    //     $todayUnformat = Carbon::now();
      
            $barang = Barang::orderBy('nama', 'asc')->get();
      
        // $filterFormated = Carbon::parse($filter)->locale('id_ID')->isoFormat('D MMMM YYYY');
        return view('report-stock.index', compact('title', 'barang',));
    }
    public function storeorupdate(Request $request) {
        $obj = Barang::find($request->id);
        $obj->nama = $request->nama;
        $obj->harga_modal = $request->harga_modal;
        $obj->harga_jual = $request->harga_jual;
        $obj->stock;
        $obj->save();

    }
    public function doValidate($request, $id=null) {
        $model = [
            'nama' => 'required',
            'harga_modal' => 'required',
            'harga_jual' => 'required',
        ];
           
        $request->validate($model);
    }
    public function edit(Request $request) {
        try {
            $this->doValidate($request);
            $this->storeorupdate($request);
    
            return redirect()->back()
            ->with('success', 'Berhasil ubah barang');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal ubah barang. Error: ' . $e->getMessage());
        }
    }

    
}
